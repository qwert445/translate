<?php
function __autoload($class_name) {
	require_once ('./cls/' . strtolower ( $class_name ) . '.cls.php');
}
include './inc/config.inc.php';
	$id = isset($_GET['id'])?$_GET['id']:'';
	if($id != '')
	{
		$ob = new Dictionary();
		if($ob->del($id))
			header('Location: list.php');
	}
?>