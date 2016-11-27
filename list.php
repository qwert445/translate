<?php
function __autoload($class_name) {
	require_once ('./cls/' . strtolower ( $class_name ) . '.cls.php');
}
include './inc/config.inc.php';
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
	<!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">
	<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.min.js"></script>
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
                    <h2 style="margin-top:-15px">Từ điển Việt - Anh</h2>
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
                <h2>Danh sách từ điển</h2>
            </div>
			<div class="col-lg-12">
			<ul class="nav navbar-nav pull-right" style="margin-bottom:20px;">
				<li>
					<a href="add.php" class="btn btn-primary">Thêm mới</a>
                </li>               
            </ul>
			</div>
			<div class="col-lg-12">
				<table cellspacing="0" class="table table-striped table-bordered scroll" id="dictionary"> 
					<thead> 
						<tr> 
							<th class="header" width="10">ID</th> 
							<th class="header">Tiếng Việt</th> 
							<th class="header">Tiếng Anh</th> 
							<th class="header"></th>				
							<th class="header"></th>
						</tr> 
					</thead> 
					<tbody>
						<?php
							$ob = new Dictionary();
							$list = $ob->getList();
							foreach($list as $row)
							{
								echo "<tr>";
								echo "<td>".$row['id']."</td>";
								echo "<td>".$row['vietnamese']."</td>";
								echo "<td>".$row['firstword']."</td>";
								echo "<td><a href='edit.php?id=".$row['id']."'>Edit</td>";
								echo "<td><a href='delete.php?id=".$row['id']."' onclick=\"return confirm('Bạn có chắc xóa từ này không?');\">Delete</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
        </div>
    </div>
    <!-- /.container -->
	<script type="text/javascript">
		// A $( document ).ready() block.
		$(document).ready(function() {
			$("#dictionary").DataTable();
		});
	</script>
</body>
</html>