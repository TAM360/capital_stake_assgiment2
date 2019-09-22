<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>User Admin</h1>
        <table class="table table-bordered user-data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <!-- <th>Updated At</th> -->
                    <!-- <th width="100px">Action</th> -->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <br><br><br>
        <table class="table table-bordered customer-data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
   
<script type="text/javascript">


    $( () => {
        let usersTable = $('.user-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ route('customers.list') }}",
                "dataSrc": function (data) {
                    return data[0].original.data;
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created at'},
                // {data: 'created_at', name: 'updated at'},
                // {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
        let customerTable = $('.customer-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url":"{{ route('customers.list') }}",
                "dataSrc": function (data) {
                    return data[1].original.data;
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'created_at', name: 'created at'},
            ]
        })
    });
</script>
</html>