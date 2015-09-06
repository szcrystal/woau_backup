<?php
//print_r($_FILES);
//print_r($_POST);

//パス
//$fPath = 'images/temps/11804/女性監査役HP構成.xlsx';
$fPath = $_POST['fPath'];
//$fPath = $_GET['fPath'];
//ファイル名
//$fName = '女性監査役HP構成.xlsx';
$fName = $_POST['fName'];
//$fName = $_GET['fName'];

if( strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') || strpos($_SERVER['HTTP_USER_AGENT'], 'Edge') ) {
	$fName = mb_convert_encoding($fName, 'SJIS-win', 'UTF-8');
}

$mime = 'application/octet-stream';

header('Content-Type: "'. $mime .'"');
header('Content-Disposition: attachment; filename="'. $fName.'"');
//header('Content-Disposition', 'attachment; filename*=UTF-8\'\''.rawurlencode($fName));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Pragma: no-cache');

header('Content-Length: '. filesize($fPath));

readfile($fPath);

exit();
//echo $fName;

