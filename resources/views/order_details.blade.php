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
        <h2>Order Details</h2>
        <table class="table table-bordered order-data-table">
        </table>
    </div>
</body>
   
<script type="text/javascript">
  $( () => {
    let dataset = [];
    let results = {!! json_encode($result) !!};
        results = results.original.data;

    for (let item of results) {
      dataset.push([item.id, item.name, item.quantity, item.price]);
    }
    console.log(dataset);

    $('.order-data-table').DataTable({
      data: dataset,
      columns: [
        {title: 'Product ID'},
        {title: 'Name'},
        {title: 'Quantity'},
        {title: 'Price'},
      ]
    });
  });
</script>
</html>