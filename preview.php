<?php
ini_set("display_errors", 0);

$thumbdir = 'clip/';
$uuid = uniqid();
$start = floatval($_GET['t']) - 0.9;
$duration = 3;
$anilistID = rawurldecode($_GET['anilist_id']);
$file = rawurldecode($_GET['file']);
$filepath = str_replace('`', '\`', '/mnt/data/anilist/'.$anilistID.'/'.$file);
$thumbpath = $thumbdir.$uuid.'.mp4';

if(file_exists($filepath)){
    exec("/usr/bin/ffmpeg -y -ss ".$start." -i \"$filepath\" -to ".$duration." -vf scale=640:-1 -c:v libx264 -preset fast ".$thumbpath);
}

header('Content-type: video/mp4');
readfile($thumbpath);
unlink($thumbpath);
?>
