<?php
function __autoload($class_name) {
	require_once ('./cls/' . strtolower ( $class_name ) . '.cls.php');
}
include './inc/config.inc.php';
if(isset($_POST['submit']))
{
	$id = isset($_POST['id'])?$_POST['id']:'';
	$vietnamese = isset($_POST['vietnamese'])?$_POST['vietnamese']:'';
	$english = isset($_POST['english'])?$_POST['english']:'';
	$ob = new Dictionary();
	if($ob->edit($id,$vietnamese,$english))
		header('Location: list.php');
	
}
$id = isset($_GET['id'])?$_GET['id']:'';
if($id!='')
{
	$ob = new Dictionary();
	$row = $ob->getListById($id);
}
else{
	echo 'Bạn có không quyền truy cập trang này!';
	return;
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
                <a class="navbar-brand" href="index.php">
                    <h2 style="margin-top:10px">Từ điển</h2>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav pull-right">
                    <li>
                        <a href="#" class="btn btn-default">Quản lý từ điển</a>
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
                <h2>Cập nhật</h2>
            </div>
			<div class="col-lg-9">
				<form action="edit.php" method="POST">
				  <div class="form-group">
					<label>Từ tiếng Việt</label>
					<input type="text" name="vietnamese" class="form-control" placeholder="Từ tiếng việt" value="<?php echo $row['vietnamese'];?>">
				  </div>
				  <div class="form-group">
					<label>Nghĩa tiếng Anh</label>
					<input type="text" name="english" class="form-control" placeholder="Nghĩa tiếng anh"  value="<?php echo $row['firstword'];?>">
				  </div>
				  <input type="hidden" name="id" value="<?php echo $row['id'];?>">
				  <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
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