<?php
function __autoload($class_name) {
	require_once ('./cls/' . strtolower ( $class_name ) . '.cls.php');
}
include './inc/config.inc.php';
$text = isset($_POST['text'])?$_POST['text']:"";
$infile = fopen("input.txt", "w") or die("Unable to open file!");
fwrite($infile, $text);
fclose($infile);
exec('vnTokenizer.bat -i input.txt -o output.txt');
$myfile = fopen("output.txt", "r") or die("Unable to open file!");
$text = fread($myfile,filesize("output.txt"));
fclose($myfile);
//
$words = explode(" ", $text);
$ob = new Dictionary();
$response = "";
$index = 0;
$total = count($words);
if($total)
foreach($words as $value)
{
	$value = str_replace("_"," ",$value);
	$response .= $ob->getword(trim($value));
	$response .= " ";
}
echo $response;
?>