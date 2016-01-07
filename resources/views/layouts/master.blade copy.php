<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Farmbook</title>

    <!-- Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.1.0/css/select.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.0/css/buttons.dataTables.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->
            <style>
            body {
               background-color:#f4f9ff;
            }


            </style>
        </head>
        <body>

            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">FarmBook</a>
              </div>
              <div class="nav navbar-nav navbar-right">
                <li><a href=" {{   url('/') }}">Home</a></li>
                <li><a href="{{ route('datatables') }}">Users</a></li>
            </div>
        </div>
    </nav>


    <div class="container">
        @yield('content')
    </div>

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
    <script src=" https://cdn.datatables.net/select/1.1.0/js/dataTables.select.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>

    <!-- App scripts -->
    @stack('scripts')
</body>
</html>