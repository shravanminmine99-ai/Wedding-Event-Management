<!DOCTYPE html>
<html>
<head>
    <title>Payment Table</title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <h2>Payment Details</h2>
    <?php include('print_payments.php'); ?>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script>

</body>
</html>