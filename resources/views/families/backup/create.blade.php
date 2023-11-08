@extends('layouts.app') {{-- Assuming you have a layout set up --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Family Information Form</h2>
            <form method="POST" action="{{ route('families.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Head of the Family -->
                <h3>Head of the Family</h3>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name')}}">
                     @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname')}}">
                    @if ($errors->has('surname'))
                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ old('birthdate')}}">
                    @if ($errors->has('birthdate'))
                        <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="mobile_no">Mobile No:</label>
                    <input type="tel" name="mobile_no" id="mobile_no" class="form-control" value="{{ old('mobile_no')}}">
                    @if ($errors->has('mobile_no'))
                        <span class="text-danger">{{ $errors->first('mobile_no') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <textarea name="address" id="address" class="form-control">{{ old('address')}}</textarea>
                    @if ($errors->has('address'))
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="state">State:</label>
                    <select name="state" id="state" class="form-control">
                        <option value="state1">State 1</option>
                        <option value="state2">State 2</option>
                        <!-- Add more state options here -->
                    </select>
                    @if ($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <select name="city" id="city" class="form-control">
                        <option value="city1">City 1</option>
                        <option value="city2">City 2</option>
                        <!-- Add more city options here -->
                    </select>
                    @if ($errors->has('city'))
                        <span class="text-danger">{{ $errors->first('city') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="pincode">Pincode:</label>
                    <input type="text" name="pincode" id="pincode" class="form-control" value="{{ old('pincode')}}">
                    @if ($errors->has('pincode'))
                        <span class="text-danger">{{ $errors->first('pincode') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="marital_status">Marital Status:</label>
                    <select name="marital_status" id="marital_status" class="form-control">
                        <option value="married">Married</option>
                        <option value="unmarried">Unmarried</option>
                    </select>
                    @if ($errors->has('marital_status'))
                        <span class="text-danger">{{ $errors->first('marital_status') }}</span>
                    @endif
                </div>

                <div class="form-group" id="wedding_date" style="display: none;">
                    <label for="wedding_date">Wedding Date:</label>
                    <input type="date" name="wedding_date" id="wedding_date" class="form-control" value="{{ old('wedding_date')}}">
                </div>

                <div class="form-group">
                    <label for="hobbies">Hobbies:</label>
                    <div id="hobbies-container">
                        <input type="text" name="hobbies[]" class="form-control" value="{{ old('hobbies[]')}}">
                    </div>
                    <button type="button" id="add-hobby" class="btn btn-secondary">Add Hobby</button>
                </div>

                <div class="form-group">
                    <label for="photo">Photo:</label>
                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                </div>

                <!-- Family Members -->
                <h3>Family Members</h3>
                <div id="family-members">
                    <!-- Loop through family members and display fields for each member -->
                    @foreach ($familyMembers as $key => $familyMember)
                        <div class="family-member">
                            <h4>Family Member</h4>
                            <label for="family_name">Name:</label>
                            <input type="text" name="family_name[]" class="form-control" value="{{ old('family_name.' . $key) }}">
                            
                            <!-- Display error message for family_name -->
                            @if ($errors->has("family_name.$key"))
                                <span class="text-danger">{{ $errors->first("family_name.$key") }}</span>
                            @endif
                            
                            <!-- Repeat the above pattern for other family member fields -->
                            
                            <!-- Example for family_birthdate -->
                            <label for="family_birthdate">Birthdate:</label>
                            <input type="date" name="family_birthdate[]" class="form-control" value="{{ old('family_birthdate.' . $key) }}">
                            
                            @if ($errors->has("family_birthdate.$key"))
                                <span class="text-danger">{{ $errors->first("family_birthdate.$key") }}</span>
                            @endif
                            
                            <!-- Continue for other family member fields -->
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-family-member" class="btn btn-secondary">Add Family Member</button>

                <!-- Education and Education Photos -->
                <!-- You can add fields for education and education photos in a similar manner -->

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Add Hobby Button Click Event
    document.getElementById('add-hobby').addEventListener('click', function () {
        var hobbiesContainer = document.getElementById('hobbies-container');
        var input = document.createElement('input');
        input.type = 'text';
        input.name = 'hobbies[]';
        input.className = 'form-control';
        hobbiesContainer.appendChild(input);
    });

    // Marital Status Change Event
    document.getElementById('marital_status').addEventListener('change', function () {
        var weddingDate = document.getElementById('wedding_date');
        if (this.value === 'married') {
            weddingDate.style.display = 'block';
        } else {
            weddingDate.style.display = 'none';
        }
    });

    // Add Family Member Button Click Event
    document.getElementById('add-family-member').addEventListener('click', function () {
        var familyMembers = document.getElementById('family-members');
        var familyMemberDiv = document.createElement('div');
        familyMemberDiv.className = 'family-member';

        // Add Family Member Fields Here
        familyMemberDiv.innerHTML = `
            <h4>Family Member</h4>
            <label for="family_name">Name:</label>
            <input type="text" name="family_name[]" class="form-control">
            
            <label for="family_birthdate">Birthdate:</label>
            <input type="date" name="family_birthdate[]" class="form-control">
            
            <label for="family_marital_status">Marital Status:</label>
            <select name="family_marital_status[]" class="form-control">
                <option value="married">Married</option>
                <option value="unmarried">Unmarried</option>
            </select>
            
            <div class="form-group family-wedding-date" style="display: none;">
                <label for="family_wedding_date">Wedding Date:</label>
                <input type="date" name="family_wedding_date[]" class="form-control">
            </div>
            
            <label for="family_education">Education:</label>
            <input type="text" name="family_education[]" class="form-control">
            
            <label for="family_photo">Photo:</label>
            <input type="file" name="family_photo[]" class="form-control" accept="image/*">
        `;

        familyMembers.appendChild(familyMemberDiv);
    });
</script>
@endsection
