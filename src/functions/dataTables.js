$(document).ready(function () {
    $('#final-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        colReorder: true,
        scrollX: true
    });
});