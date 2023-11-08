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
        //dd($families);
                // echo '<pre>';
                // print_r($families);
                // die;
        if(request()->ajax()) {
                $query = Family::withCount('familyMembers')
                    ->select('id','name', 'surname', 'birthdate', 'mobile_no', 'address', 'state', 'city', 'pincode','marital_status','wedding_date','hobbies','photo');

                return datatables()->of($query)
                    ->addColumn('family_members_count', function ($family) {
                        return $family;
                    })
                    ->addColumn('action', 'families.action')
                    ->rawColumns(['action'])
                    ->addIndexColumn()
                    ->escapeColumns([])
                    ->make(true);
            }

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
