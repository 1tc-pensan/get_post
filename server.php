<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple-v1.css">
    <title>SERVER szuperglobális</title>
</head>
<body>
    <h2>SERVER valami</h2>
    <ul>
        <li><strong>Kérés módja:</strong> <?php echo $_SERVER['REQUEST_METHOD']; ?></li>
        <li><strong>Kért URL:</strong> <?php echo $_SERVER['REQUEST_URI']; ?></li>
        <li><strong>Szkript neve:</strong> <?php echo $_SERVER['SCRIPT_NAME']; ?></li>
        <li><strong>QUERY string:</strong><?php
         if (empty($_SERVER['QUERY_STRING'])) {
            echo " Nincs query string";
         }
         else {
            echo " " . $_SERVER['QUERY_STRING'];
         }
         ?></li>
    </ul>
</body>
</html>
