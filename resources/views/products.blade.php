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
        <h2>Product List</h2>
        <table class="table table-bordered product-data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>In Stock</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <br><br><br>
    </div>
</body>
   
<script type="text/javascript">
    $( () => {

        $('.product-data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('product.list') }}",
            rowCallback: function( row, data ) {
                if (data['in_stock'] === "Yes")
                  $(row).css('background-color', '#fdced6');
                else
                  $(row).css('background-color', '#84fd7f');
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'in_stock', name: 'in stock'},
            ]
        });
    });
</script>
</html>