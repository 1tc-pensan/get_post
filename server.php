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
    <h2>Szerver adati</h2>
        <ul>
            <li>Szerver neve : <?php echo $_SERVER['SERVER_NAME']; ?></li>
            <li>Szerver IP címe : <?php echo $_SERVER['SERVER_ADDR']; ?></li>
        </ul>
        <h3>Felhasznnáló adatai</h3>
        <ul>
            <li>Felhasználó IP címe : <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
            <li>Felhasználó böngészője : <?php echo $_SERVER['HTTP_USER_AGENT']; ?></li>
            <li>Felhasználó nyelve : <?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></li>
            <li>Felhasználó host neve : <?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?></li>
         <br>
         <a href="?Patrik=mozso&age=12">
         <p>Kattints ide egy paraméterezett GET kéréshez</p>
         </a>
    </ul>
</body>
</html>
