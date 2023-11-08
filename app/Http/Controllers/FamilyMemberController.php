<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyMember;
use App\Http\Requests\SaveFamilyMemberRequest;

class FamilyMemberController extends Controller
{
    public function index()
    {
        // Logic to retrieve a list of family members.
    }

    public function create($id)
    {
        return view('families.members.create',compact('id'));
    }

    public function store(SaveFamilyMemberRequest $request)
    {
        try{
            $input = $request->all();
            $families = FamilyMember::create($input);

        } catch (\Exception $e) {
            return redirect()->back()->with('error_message_catch', $e->getMessage());
        }
        return redirect('families')->with('status', 'Family member added successfully.!');
    }

}
