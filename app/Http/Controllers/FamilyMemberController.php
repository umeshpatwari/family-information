<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Http\Requests\SaveFamilyMemberRequest;

class FamilyMemberController extends Controller
{
    public function index($id)
    {
        $family_member = FamilyMember::where('family_id',$id)->get();
        return view('families.members.index', compact('family_member','id'));
    }

    public function create($id)
    {
        return view('families.members.create',compact('id'));
    }

    public function store(SaveFamilyMemberRequest $request)
    {
        try{
            $input = $request->all();
            if ($photo = $request->file('photo')) {
                $destinationPath = 'images/family/';
                $profileImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
                $photo->move($destinationPath, $profileImage);
                $input['photo'] = "$profileImage";
            }
            $families = FamilyMember::create($input);

        } catch (\Exception $e) {
            return redirect()->back()->with('error_message_catch', $e->getMessage());
        }
        return redirect('families')->with('status', 'Family member added successfully.!');
    }

}
