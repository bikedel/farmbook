<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Farmbooks</title>

    <!-- Bootstrap CSS -->


    <link async href="{{ asset('/css/all.css') }}" rel="stylesheet">
    <!-- Fonts -->



</head>
<body>



    <body>


        <nav class="navbar  navbar-fixed-top navbar-inverse" >
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                    <a class="navbar-brand" href="#"></a>

                    <img id="logo" src="{{ asset('images/farmbook.png') }}" class="pull-left" alt="Smiley face" height="42" width="42">



                </div>


                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                       
                        <li><a href="{{ url('/') }}">Quick View</a></li>
                        <li><a href="{{ url('/freeholds') }}">Grid View</a></li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>

                        @else
                        <li><a href="{{ url('/suburb') }}">{{ Auth::user()->getDatabase() }}</a></li>
                   
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class=""></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>

                                @if (Auth::user()->isAdmin())
                                <hr>
                                <li><a href="{{ url('/datatables') }}">Admin</a></li>
  
                                @endif
                            </ul>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>





        <div class="container-fluid">
            @yield('content')
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>


        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>

        <script src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
        <script src=" https://cdn.datatables.net/select/1.1.0/js/dataTables.select.min.js"></script>
        <script src=" https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js"></script>
        <script src=" https://cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js"></script>
        <script src=" //cdn.datatables.net/buttons/1.1.0/js/buttons.colVis.min.js"></script>


        <script type="text/javascript">
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
       });
        </script>

  

        <!-- App scripts -->
        @stack('scripts')
    </body>
    </html>