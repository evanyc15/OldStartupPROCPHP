<?php
$file_name = $_GET['image'];
$full_path = "../../../assets/images/" . $file_name;

$file_info = getimagesize($full_path);
$file_size = filesize($full_path);

header("Content-Type: {$file_info['mime']}\n");
header("Content-Disposition: inline; filename=\"$file_name\"\n");
header("Content-Length: $file_size\n");

readfile($full_path);
?>