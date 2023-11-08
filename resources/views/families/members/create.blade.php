@extends('layouts.app') <!-- Include your layout file if you have one -->

@section('content')
    <div class="container">
        <h1>Add/Edit Family Member</h1>

        @if(isset($familyMember))
            <form method="POST" action="{{ route('family-members.update', $familyMember->id) }}">
                @method('PATCH')
        @else
            <form method="POST" action="{{ route('family-members.store') }}">
        @endif
            @csrf
            <input type="hidden" name="family_id" id="family_id" class="form-control" value="{{$id}}">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="{{ isset($familyMember) ? $familyMember->name : '' }}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" name="birthdate" class="form-control" value="{{ isset($familyMember) ? $familyMember->birthdate : '' }}">
                @if ($errors->has('birthdate'))
                    <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="marital_status">Marital Status:</label>
                <select name="marital_status" class="form-control">
                    <option value="married" {{ (isset($familyMember) && $familyMember->marital_status == 'married') ? 'selected' : '' }}>Married</option>
                    <option value="unmarried" {{ (isset($familyMember) && $familyMember->marital_status == 'unmarried') ? 'selected' : '' }}>Unmarried</option>
                </select>
                @if ($errors->has('marital_status'))
                    <span class="text-danger">{{ $errors->first('marital_status') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="wedding_date">Wedding Date (if Married):</label>
                <input type="date" name="wedding_date" class="form-control" value="{{ isset($familyMember) ? $familyMember->wedding_date : '' }}">
            </div>

            <div class="form-group">
                <label for="education">Education:</label>
                <input type="text" name="education" class="form-control" value="{{ isset($familyMember) ? $familyMember->education : '' }}">
                @if ($errors->has('education'))
                    <span class="text-danger">{{ $errors->first('education') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
