<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
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
        <h1>Shop Manager</h1>
        <h2>Order List</h2>
        <table class="table table-bordered order-data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Invoice Number</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <!-- <th width="100px">Action</th> -->
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
   
<script type="text/javascript">
    $( () => {

        $('.order-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('order.list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'customer_id', name: 'customer id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'invoice_number', name: 'invoice number'},
                {data: 'total_amount', name: 'total amount'},
                {
                  data: 'status',
                  name: 'status',
                  render: (data, type, row, meta) => {
                    let params = {
                      id: row.id,
                      name: row.name,
                      email: row.email,
                    };

                    console.log(params);
                    let url = `{{ route('order.details') }}`;
                        url = url + `?id=${params.id}&name="${params.name}"&email="${params.email}"`;
                    console.log(url);
                    data = `<a href='${url}' target='_blank'> ${data}</a>`;
                    return data;
                  }
                },
                // {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
</html>