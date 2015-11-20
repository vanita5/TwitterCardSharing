<?php

require_once 'config.php';

$param = $_GET['p'];

if (!preg_match('([^\.\s\\\/]+(\.(?i)(jpg|jpeg|png|gif))$)', $param)) {
    die('Image not found.');
}

$img = IMAGE_DIR . $param;

if (strlen(strstr($_SERVER['HTTP_USER_AGENT'], "Twitterbot")) <= 0) {
    $data = file_get_contents($img);

    header('Content-type: image/png');
    die($data);
}

echo '<!DOCTYPE html>
<html>
    <head>
        <title>pic.vanit.as</title>

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="'.TWITTER_SITE.'">
        <meta name="twitter:creator" content="'.TWITTER_CREATOR.'">
        <meta name="twitter:title" content="Image shared via pic.vanit.as">
        <meta name="twitter:description" content="This image has been shared via a self-hosted service on vanit.as">
        <meta name="twitter:image" content="'.BASE_URL.$img.'">
    </head>
    <body>
        <img src="'.$img.'">
    </body>
</html>';