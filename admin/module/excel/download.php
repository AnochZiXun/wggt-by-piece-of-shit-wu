<?
header("Content-Type: application/vnd.ms-excel;");
header("Content-Disposition: attachment; filename=contant_ch.xls");
header("Pragma: no-cache");
header("Expires: 0");
readfile("contant_ch.xls");
?>