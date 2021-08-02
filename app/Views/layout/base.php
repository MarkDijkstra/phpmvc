<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Main page</title>
    <link rel="stylesheet" href="public/assets/css/core.css">
</head>
<body>
    <nav id="nav">
       <ul>
           <li>
               <!-- TODO -->
               <a href="/phpmvc/">Home</a>
           </li>
           <li>
               <a href="about">About</a>
           </li>
       </ul>
    </nav>
    <div id="main">
        <?php require_once $content; ?>
    </div>
</body>
</html>