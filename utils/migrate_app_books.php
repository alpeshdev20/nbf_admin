<?php
$servername = "localhost";
$mysqluser = "root";
$mysqlpassword = "Iamsocool99";
$mysqldbname = "ebook";
error_reporting(E_ALL);
ini_set("display_errors", 1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$con = mysqli_connect($servername, $mysqluser, $mysqlpassword, $mysqldbname);
if (mysqli_connect_errno()) {
    echo "Error Connecting";
    die();
}

$sql2 = "SELECT * from app_publishers";

$data2 = binder(mysqli_query($con, $sql2));

$i = 1;
foreach($data2 as $insData) {
    $id = $insData['id'];
    $publisher = $insData['publisher'];
    $sql = "UPDATE books set publisher = $id where publisher='$publisher'";
    echo $sql;
    $result=mysqli_query($con,$sql);
    $i++;
}

function attachQuote($v)
{
  return "`" . $v . "`";
}

function attachFullQuote($v)
{
  return "'" . $v . "'";
}

function sql_direct($con, $sql) {
	$result=mysqli_query($con,$sql);
}

function binder($result) {
	$l= array();
	$loop = 0;
	while ($row = mysqli_fetch_assoc($result)) {
		$l[$loop] = $row;
		$loop = $loop + 1;
	}
	return $l;
}

?>
