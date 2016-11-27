﻿<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="NTTINH">
    <meta name="author" content="NTTINH">
    <title>Từ điển</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/logo-nav.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="margin-top:30px">
                    <h2 style="margin-top:-15px">Từ điển Việt - Anh</h2>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling 
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="list.php" class="btn btn-default">Quản lý từ điển</a>
                    </li>               
                </ul>
            </div> -->
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Nhập cụm từ cần dịch</h2>
            </div>
			<div class="col-lg-9">
				<div class="input-group">
				  <input type="text" id="text" class="form-control" placeholder="Search for...">
				  <span class="input-group-btn">
					<button id="search" class="btn btn-secondary" type="button">Tìm</button>
				  </span>
				</div>
			</div>
        </div>
		<div class="col-lg-12">
                <h2>Dịch</h2>
            </div>
			<div class="col-lg-9">
				<div class="alert alert-info" id="content">
					
				</div>
			</div>
        </div>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script src="js/myscript.js"></script>
</body>
</html>
