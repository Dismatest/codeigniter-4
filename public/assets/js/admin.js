//dataTables js for the supperAdmin

$(document).ready(function(){
    var table = $('#supperAdminDataTable').DataTable({
        buttons: ['copy', 'csv', 'pdf', 'print']
    });
    table.buttons().container().appendTo('#supperAdminExample');
});