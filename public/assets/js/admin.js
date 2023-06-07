//dataTables js for the supperAdmin
$(document).ready(function(){
    $('#example').DataTable();
});
$(document).ready(function(){
    var table = $('#supperAdminDataTable').DataTable({
        buttons: ['pdf', 'excel',
            {
                "text": "Delete",
                "className": "btn btn-danger",
                "action": function ( e, dt, node, config ) {
                    if (confirm("Are you sure you want to delete this data?")) {
                        var data = dt.rows({selected:true}).data();
                        var ids = data.map(function(d) { return d.id; }); // Assumes your data has an "id" property
                        $.ajax({
                            url: "/delete-data",
                            type: "POST",
                            data: {ids: ids},
                            success: function(response) {
                                // Handle success response here
                                dt.ajax.reload(); // Reload the data table
                            },
                            error: function(xhr, status, error) {
                                // Handle error response here
                            }
                        });
                        console.log(ids);
                    }
                }
            },
        ],
        select: {
            style: "multi",
            selector: "tr",
        },
        columnDefs: [{
            orderable: false,
            className: "select-checkbox",
            targets: 0,
        }],

        "rowCallback": function (){
            $(".test").html("");
        }
    });
    table.buttons().container().appendTo('#supperAdminExample');
});
//dataTables js for the supperAdmin

$(document).ready(function(){
    var table = $('#dataTableListUsers').DataTable({
        buttons: ['pdf', 'excel',
        ],
    });
    table.buttons().container().appendTo('#DataTableListUsers');
});
$(document).ready(function(){
    var table = $('#manageUsers').DataTable({
        buttons: ['pdf', 'excel',
        ],
    });
    table.buttons().container().appendTo('#ManageUsers');
});

// charts js for the supperAdmin

$(document).ready(function() {
    const ctx = document.getElementById('myChart').getContext('2d')
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Match', 'April', 'May', 'June'],
            datasets: [{
                label: 'Shares history',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                }
            }
        }
    });

    $(document).ready(function () {
        const adminBar = document.getElementById('myChartTwo').getContext('2d');
        if (adminBar) {
            const adminChart = new Chart(adminBar, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Match', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'Six months transaction history',
                        data: [12, 19, 3, 5, 6, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        fill: false,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    }
                }
            });
        }
    });
});








