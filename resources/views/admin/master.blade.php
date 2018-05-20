<?php
if(!isset($_SESSION))
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin - Khoa Phạm</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{url('admin/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('admin/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('admin/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{url('admin/bower_components/datatables-responsive/css/dataTables.responsive.css') }}" rel="stylesheet">

    <link href="{{url('css/myStyle.css') }}" rel="stylesheet">


	<script>
      var baseURL = "{!! url('/') !!}";
    </script>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin Area - Khoa Phạm</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i>{!! Auth::user()->username !!}</a>
                        </li>

                        <li class="divider"></li>
                        <li><a href="{!! route('getLogout') !!}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                             <!--<a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>-->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Category<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('admin/admin-content/cate/getListCate') !!}">List Category</a>
                                </li>
                                <li>
                                    <a href="{!! url('admin/admin-content/cate/getAddCate') !!}">Add Category</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i> Product<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('admin/admin-content/product/getListPrd') !!}">List Product</a>
                                </li>
                                <li>
                                    <a href="{!! url('admin/admin-content/product/getAddPrd') !!}">Add Product</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('admin/admin-content/user/getListUser') !!}">List User</a>
                                </li>
                                <li>
                                    <a href="{!! url('admin/admin-content/user/getAddUser') !!}">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">@yield('pageHeader')
                            <small>@yield('function')</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <!------ Main Content ------->
						@yield('content')
					<!------ End Main Content ------->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{url('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('admin/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('admin/dist/js/sb-admin-2.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{url('admin/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{url('admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

	<script type="text/javascript" src="{{url('admin/js/myScript.js') }}"></script>

	<!---------------- Put CKEditor and CKFinder link--------------------------->
	<script src="{{url('templateEditor/ckeditor/ckeditor.js')}}"></script>
    <script src="{{url('templateEditor/ckfinder/ckfinder.js')}}"></script>

	<!---------------- Put CKEditor and CKFinder into page --------------------------->
	<script>
        var editor = CKEDITOR.replace('editor1', {
         filebrowserBrowseUrl: baseURL+'/templateEditor/ckfinder/ckfinder.html',
         filebrowserImageBrowseUrl: baseURL+'/templateEditor/ckfinder/ckfinder.html?type=Images',
         filebrowserFlashBrowseUrl: baseURL+'/templateEditor/ckfinder/ckfinder.html?type=Flash',
         filebrowserUploadUrl: baseURL+'/templateEditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
         filebrowserImageUploadUrl: baseURL+'/templateEditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
         filebrowserFlashUploadUrl: baseURL+'/templateEditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
     } );
    </script>

    <script>
        var editor2 = CKEDITOR.replace('editor2', {
         filebrowserBrowseUrl: baseURL+'/templateEditor/ckfinder/ckfinder.html',
         filebrowserImageBrowseUrl: baseURL+'/templateEditor/ckfinder/ckfinder.html?type=Images',
         filebrowserFlashBrowseUrl: baseURL+'/templateEditor/ckfinder/ckfinder.html?type=Flash',
         filebrowserUploadUrl: baseURL+'/templateEditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
         filebrowserImageUploadUrl: baseURL+'/templateEditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
         filebrowserFlashUploadUrl: baseURL+'/templateEditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
     } );
    </script>
</body>

</html>
