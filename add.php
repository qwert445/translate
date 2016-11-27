<?php
function __autoload($class_name) {
	require_once ('./cls/' . strtolower ( $class_name ) . '.cls.php');
}
include './inc/config.inc.php';
if(isset($_POST['submit']))
{
	$vietnamese = isset($_POST['vietnamese'])?$_POST['vietnamese']:'';
	$english = isset($_POST['english'])?$_POST['english']:'';
	$ob = new Dictionary();
	if($ob->insert($vietnamese,$english))
		header('Location: list.php');
	
}
?>
<!DOCTYPE html>
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
                <a class="navbar-brand" href="index.php" style="margin-top:30px">
                    <h2 style="margin-top:-15px">Từ điển</h2>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        
                    </li>               
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Thêm mới</h2>
            </div>
			<div class="col-lg-9">
				<form action="add.php" method="POST">
				  <div class="form-group">
					<label>Từ tiếng Việt</label>
					<input type="text" name="vietnamese" class="form-control" placeholder="Từ tiếng việt">					
				  </div>
				  <div class="form-group">
					<label>Nghĩa tiếng Anh</label>
					<input type="text" name="english" class="form-control" placeholder="Nghĩa tiếng anh">
				  </div>
				  <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
				</form>
			</div>
        </div>
    </div>
    <!-- /.container -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<script src="myscript.js"></script>
</body>
</html>