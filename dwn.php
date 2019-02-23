<?php

$url = $_GET['url'];
$file = basename($url);
 
$fp = fopen($file, 'w');
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_FILE, $fp);
 
$data = curl_exec($ch);
 
curl_close($ch);
fclose($fp);
 
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($file));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
ob_clean();
flush();
readfile($file);
unlink($file);
exit;
?>
