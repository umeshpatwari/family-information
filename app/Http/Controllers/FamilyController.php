<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;

class FamilyController extends Controller
{
   public function index()
    {
        $families = Family::all();
        return view('families.index', compact('families'));
    }

    public function create()
    {
        return view('families.create');
    }

    public function store(Request $request)
    {
        // Validation and storing family data
    }

    public function show($id)
    {
        $family = Family::find($id);
        return view('families.show', compact('family'));
    }
}
