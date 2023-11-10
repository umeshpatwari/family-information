$(document).ready(function () {
        // Add Hobby Button Click Event
        $(document).on('click','#add-hobby',function(){    
            var hobbiesContainer = $('#hobbies-container');
            var input = $('<input>').attr({
                type: 'text',
                name: 'hobbies[]',
                class: 'form-control'
            });
            hobbiesContainer.append(input);
        });

        // Marital Status Change Event
        $(document).on('change','#marital_status',function(){
            var weddingDate = $('#wedding_date');
            if ($(this).val() === 'married') {
                weddingDate.show();
            } else {
                weddingDate.hide();
            }
        });

        // Add Family Member Button Click Event
        $(document).on('click','#add-family-member',function(){
            var familyMembers = $('#family-members');
            var familyMemberDiv = $('<div>').addClass('family-member');

            // Add Family Member Fields Here
            familyMemberDiv.html(`
                <h4>Family Member</h4>
                <label for="family_name">Name:</label>
                <input type="text" name="family_name[]" class="form-control" required>
                
                <label for="family_birthdate">Birthdate:</label>
                <input type="date" name="family_birthdate[]" class="form-control" required>
                
                <label for="family_marital_status">Marital Status:</label>
                <select name="family_marital_status[]" class="form-control marital-status">
                    <option value="">Select Marital Status</option>
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
            `);

            familyMembers.append(familyMemberDiv);

            familyMemberDiv.find('.marital-status').change(function() {

                var weddingDateField = familyMemberDiv.find('.family-wedding-date input');
                // Toggle the visibility of the Wedding Date field based on the selected option
               if ($(this).val() === 'married') {
                    weddingDateField.closest('.family-wedding-date').show();
                    weddingDateField.prop('required', true);
                } else {
                    weddingDateField.closest('.family-wedding-date').hide();
                    weddingDateField.prop('required', false);
                }
                //weddingDateField.toggle($(this).val() === 'married');
            });
        });

        $('#familyTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "http://localhost/family-information/public/families/datatable",
            columns: [
                { data: 'name', name: 'name' },
                { data: 'image', name: 'image' },
                { data: 'surname', name: 'surname' },
                { data: 'birthdate', name: 'birthdate' },
                { data: 'family_members_count', name: 'family_members_count' },
                // Add any additional columns here
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        //Validation Code
        $("#store_family").validate({
            rules: {
                // Define validation rules here
                name: "required",
                surname: "required",
                birthdate: {
                    required: true,
                    date: true
                },
                mobile_no: {
                    required: true,
                    digits: true
                },
                address: "required",
                state: "required",
                city: "required",
                pincode: {
                    required: true,
                    digits: true
                },
                marital_status: "required",
                wedding_date: {
                    required: function(element) {
                        return $("#marital_status").val() === "married";
                    },
                    date: true
                },
                "hobbies[]": "required",
                photo: {
                    required: true,
                    accept: "image/*"
                }
                // Add rules for family member fields, education, and education photos
            },
            messages: {
                // Define error messages here
                name: "Please enter your name",
                surname: "Please enter your surname",
                birthdate: {
                    required: "Please enter your birthdate",
                    date: "Please enter a valid date"
                },
                mobile_no: {
                    required: "Please enter your mobile number",
                    digits: "Please enter a valid mobile number"
                },
                address: "Please enter your address",
                state: "Please select your state",
                city: "Please select your city",
                pincode: {
                    required: "Please enter your pincode",
                    digits: "Please enter a valid pincode"
                },
                marital_status: "Please select your marital status",
                wedding_date: {
                    required: "Please enter your wedding date",
                    date: "Please enter a valid date"
                },
                "hobbies[]": "Please enter at least one hobby",
                photo: {
                    required: "Please upload a photo",
                    accept: "Please upload a valid image file"
                }
                // Add messages for family member fields, education, and education photos
            }
        });
});

jQuery(document).ready(function($) {
    $(".alert-success").delay(5000).slideUp(300);
    $(".alert-danger").delay(5000).slideUp(300);


    
    $('#datatable-head-families').DataTable({
        
        responsive: true,
    });

    $('#datatable-family-member').DataTable({
        
        responsive: true,
    });

});
