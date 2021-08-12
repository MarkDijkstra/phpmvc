<?php

use Core\Url;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Main page</title>
    <link rel="stylesheet" href="<?= Url::resource('assets/css/core.css');?>">
</head>
<body>
    <nav id="nav">
       <ul>
           <li>
               <a href="<?= Url::home();?>">Home</a>
           </li>
           <li>
                <a href="<?= Url::to('/products');?>">Products</a>
           </li>
           <li>
                <a href="<?= Url::to('/products/cars');?>">Cars</a>
           </li>
           <li>
                <a href="<?= Url::to('/products/2');?>">BMW X3</a>
           </li>
       </ul>
    </nav>
    <div id="main">
        <?php require_once $content; ?>
    </div>
</body>
</html>