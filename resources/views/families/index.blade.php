@extends('layouts.app') 
@section('content')
    <h1>Family List</h1>

    <ul>
        @foreach($families as $family)
            <li>
                <a href="{{ route('families.show', $family->id) }}">{{ $family->Name }}</a>
            </li>
        @endforeach
    </ul>
    
    <a href="{{ route('families.create') }}">Create New Family</a>
@endsection
