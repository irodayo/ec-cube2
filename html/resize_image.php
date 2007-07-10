<?php

$include_dir = realpath(dirname( __FILE__));
require_once($include_dir . "/define.php");

require_once($include_dir . HTML2DATA_DIR. "lib/gdthumb.php");
require_once($include_dir . HTML2DATA_DIR. "conf/conf.php");

$objThumb = new gdthumb();

$file = NO_IMAGE_DIR;

// NO_IMAGE_DIR以外のファイル名が渡された場合、ファイル名のチェックを行う
if ( isset($_GET['image']) && $_GET['image'] !== NO_IMAGE_DIR) {
    
    //不正なファイル名が渡された場合は終了させる
    if ( lfCheckFileName() !== true ) {
        exit();
    }
    
    $file = IMAGE_SAVE_DIR . $_GET['image'];
}

if(file_exists($file)){
    $objThumb->Main($file, $_GET["width"], $_GET["height"], "", true);
}else{
    $objThumb->Main(NO_IMAGE_DIR, $_GET["width"], $_GET["height"], "", true);
}

// ファイル名の形式をチェック
function lfCheckFileName() {
    //$pattern = '|^[0-9]+_[0-9a-z]+\.[a-z]{3}$|';
    $pattern = '|\.\./|';
    $file    = trim($_GET["image"]);
    if ( preg_match_all($pattern, $file, $matches) ) {
        return false;
    } else {
        return true;
    }
}

?>
