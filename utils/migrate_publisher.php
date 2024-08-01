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

$sql = "SELECT DISTINCT `publisher` FROM `books` WHERE 1";

$data = binder(mysqli_query($con, $sql));

foreach($data as $insData) {
    $columns = array_map("attachQuote",array_keys($insData));
    $columns = implode(", ",$columns);
    $values = array_map("attachFullQuote",array_values($insData));
    $values  = implode(", ", $values);
    $sql = "INSERT INTO `app_publishers`($columns, `created_at`, `updated_at`) VALUES ($values, '2020-06-01 13:06:36', '2020-06-01 13:06:36')";
    $result=mysqli_query($con,$sql);
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
