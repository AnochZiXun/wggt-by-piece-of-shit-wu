<?
header("Content-Type: application/vnd.ms-excel;");
header("Content-Disposition: attachment; filename=".$_GET['table'].".xls");
header("Pragma: no-cache");
header("Expires: 0");
readfile("".$_GET['table'].".xls");
?>