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
