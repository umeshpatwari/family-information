@extends('layouts.app') {{-- Assuming you have a layout set up --}}

@section('content')
<div class="container">
    <div class="row">
         @if(session('error_message_catch'))
          <div class="alert alert-danger">
              {{ session('error_message_catch') }}
          </div>
        @endif
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

</script>
@endsection
