<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\FamilyMember;
use App\Http\Requests\SaveFamilyRequest;
use App\Http\Requests\SaveFamilyMemberRequest;
use Datatables;
use Carbon\Carbon;



class FamilyController extends Controller
{
   public function index()
    {
        $families = Family::withCount('familyMembers')->get();
       
        return view('families.index', compact('families'));
    }

    public function create()
    {
        $familyMembers = FamilyMember::all();
        return view('families.create',compact('familyMembers'));
    }

    public function store(SaveFamilyRequest $request)
    {
        
         try{
            $input = $request->all();

            if ($photo = $request->file('photo')) {
                $destinationPath = 'images/family/';
                $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
                $photo->move($destinationPath, $profileImage);
                $input['photo'] = "$profileImage";
            }

            $input['hobbies'] = json_encode($input['hobbies']);
            $input['updated_at'] = Carbon::now(); 
           //dd($input['hobbies']);
            $families = Family::create($input);

        } catch (\Exception $e) {
            return redirect()->back()->with('error_message_catch', $e->getMessage());
        }
        return redirect('families')->with('status', 'Family Head created successfully.!');

    }

    public function show($id)
    {
        $family = Family::find($id);
        return view('families.show', compact('family'));
    }
}
