jQuery(document).ready(function($) {
    $(".alert-success").delay(5000).slideUp(300);
    $(".alert-danger").delay(5000).slideUp(300);
    
    $('#datatable-head-families').DataTable({
        serverSide: true,
        ajax: 'families',
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'surname',
                name: 'surname'
            },
            {
                data: 'birthdate',
                name: 'birthdate'
            },
            {
                data: 'family_members_count',
                name: 'family_members.family_members_count'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            },
        ],
        responsive: true,
    });

});
