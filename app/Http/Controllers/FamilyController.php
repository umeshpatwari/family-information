<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Http\Requests\SaveFamilyRequest;
use App\Http\Requests\SaveFamilyMemberRequest;
use DataTables;
class FamilyController extends Controller
{
   public function index()
    {
        return view('families.index');
    }

    public function datatable()
    {
        $families = Family::withCount('familyMembers');

        return DataTables::of($families)
            ->addColumn('image', function ($family) {
                $imagePath = public_path('images/' . $family->photo);

                if (file_exists($imagePath)) {
                    return '<img src="' . asset('images/' . $family->photo) . '" alt="Family Image" width="50" height="50">';
                } else {
                    return 'No Image';
                }
            })
            ->addColumn('family_members_count', function ($family) {
                return '<a href="' . route('family-members.index', $family->id) . '">' . $family->family_members_count . '</a>';
            })
            ->addColumn('action', function ($family) {
                // Add any additional columns you need
                return '<a href="' . route('family-members.create', $family->id) . '" class="add btn btn-sm btn-warning">Add Family Member</a>';
            })
            ->rawColumns(['family_members_count', 'action'])
            ->make(true);
    }

    public function create()
    {
        return view('families.create');
    }

    public function store(SaveFamilyRequest $request)
    {

        try{

            $rules = [
                'family_name.*' => 'required',
                'family_birthdate.*' => 'required|date',
                'family_marital_status.*' => 'required|in:married,unmarried',
                'family_wedding_date.*' => 'nullable|date',
                // Add rules for other fields as needed
            ];

            $messages = [
                'required' => 'The :attribute field is required.',
                'date' => 'The :attribute field must be a valid date.',
                'in' => 'The selected :attribute is invalid.',
            ];

            $this->validate($request, $rules, $messages);
            
            // Create Family
            $family = new Family();
            $family->name = $request->input('name');
            $family->surname = $request->input('surname');
            $family->birthdate = $request->input('birthdate');
            $family->mobile_no = $request->input('mobile_no');
            $family->address = $request->input('address');
            $family->state = $request->input('state');
            $family->city = $request->input('city');
            $family->pincode = $request->input('pincode');
            $family->marital_status = $request->input('marital_status');
            $family->wedding_date = $request->input('wedding_date');
            $family->hobbies = json_encode($request->input('hobbies'));

            // Handle photo upload for Family
            $family->photo = $this->uploadFile($request->file('photo'));

            $family->save();

            // Create Family Members
            $familyMembersData = $this->processFamilyMembersData($request->only([
                'family_name', 'family_birthdate', 'family_marital_status',
                'family_wedding_date', 'family_education', 'family_photo'
            ]));

            foreach ($familyMembersData as $familyMemberData) {
                $familyMember = new FamilyMember();
                $familyMember->family_id = $family->id;
                $familyMember->name = $familyMemberData['name'];
                $familyMember->birthdate = $familyMemberData['birthdate'];
                $familyMember->marital_status = $familyMemberData['marital_status'];
                $familyMember->wedding_date = $familyMemberData['wedding_date'];
                $familyMember->education = $familyMemberData['education'];

                // Convert hobbies array to string for Family Members
                //$familyMember->hobbies = implode(',', $familyMemberData['hobbies']);

                // Handle photo upload for Family Member
                $familyMember->photo = $this->uploadFile($familyMemberData['photo']);

                $familyMember->save();
            }
         } catch (\Exception $e) {
            return redirect()->back()->with('error_message_catch', $e->getMessage());
        }
        return redirect('families')->with('status', 'Family Head created successfully.!');

    }

    private function uploadFile($file)
    {
        $photo = $file;
         $destinationPath = 'images/family/';
                $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
                $photo->move($destinationPath, $profileImage);

        // Logic to handle file upload, save to storage, and return the file path
        // Example: $path = $file->store('photos', 'public');
        // Adjust based on your file storage configuration

        // For now, return the file name as a placeholder
        return $profileImage;
    }
    private function processFamilyMembersData($familyMembersData)
    {
        $result = [];

        foreach ($familyMembersData['family_name'] as $key => $familyMemberName) {
            $result[] = [
                'name' => $familyMemberName,
                'birthdate' => $familyMembersData['family_birthdate'][$key],
                'marital_status' => $familyMembersData['family_marital_status'][$key],
                'wedding_date' => $familyMembersData['family_wedding_date'][$key],
                'education' => $familyMembersData['family_education'][$key],
                'photo' => $familyMembersData['family_photo'][$key],
            ];
        }

        return $result;
    }
    public function show($id)
    {
        $family = Family::find($id);
        return view('families.show', compact('family'));
    }
}
