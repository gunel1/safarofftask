<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Safaroff | Task </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>-->



    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="{{URL::to('admin')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>dmin</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b></span>
        </a>

    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->



            <ul class="sidebar-menu" data-widget="tree">

                <li>
                    <a href="{{ URL::to('admin/employee') }}">
                        <i class="fa fa-th"></i> <span>Emloyee</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('admin/service') }}">
                        <i class="fa fa-list" aria-hidden="true"></i> <span>Service</span>
                        <span class="pull-right-container">
               </span>
                    </a>
                </li>

                <li>
                    <a href="{{ URL::to('admin/ourwork') }}">
                        <i class="fa fa-chevron-down" aria-hidden="true"></i> <span>Ourworks</span>
                        <span class="pull-right-container">
               </span>

                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('admin/blog') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Blog</span>

                        <span class="pull-right-container">
               </span>

                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('admin/category') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Parent Categories</span>

                        <span class="pull-right-container">
               </span>

                    </a>
                </li>
                <li>
                    <a href="{{ URL::to('admin/subcategory') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Sub Categories</span>

                        <span class="pull-right-container">
               </span>

                    </a>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            @yield('main_content')
        </section>



    </div>
    <!-- ./wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</div>
</body>
</html>
