<?php
	function __autoload($class_name) {
		require_once ('./cls/' . strtolower ( $class_name ) . '.cls.php');
	}
	include 'config.inc.php';
?>