let table;
const initUsersTable = function(route, csrf_token) {
    table = $('#users_table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: route,
            type: "POST",
            data: {
                "_token": csrf_token,
            }
        },
        columns: [
            {
                data: 'actions',
                name: 'actions',
            },
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'role',
                name: 'role',
            },
        ],
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                searchable: false,
            },
        ],
        order:[
            [1, 'asc']
        ],
    });
};

$('#search_user').on('input', function(e) {
    table.search($(this).val()).draw();
});
