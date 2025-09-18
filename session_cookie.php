<?php
// Session indítása
session_start();

// Session beállítása
if (isset($_POST['session_name']) && !empty($_POST['session_name'])) {
    $_SESSION['name'] = $_POST['session_name'];
    echo "Session beállítva: " . $_SESSION['name'];
}
// Cookie beállítása
$cookie_name='felhasznalo';
$cookie_value='Tibi';
$cookie_time=time() + (86400 * 30); // 30 nap
if(isset($_POST["cookie_value"]) && !empty($_POST["cookie_value"]))
    {
        setcookie($cookie_name ,$_POST["cookie_value"], $cookie_time, "/");
        echo "Cookie beállítva: " . $_COOKIE['felhasznalo'];
    }
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session_Cookie</title>
</head>
<body>
    <h2>Session</h2>
    <form action="" method="post">
        <label for="session_name">Add meg a neved a sessionhoz: </label>
        <input type="text" name="session_name" id="session_name">
        <button type="submit">Session beállítása</button>
    </form>
    <?php
    if (isset($_SESSION['name'])) 
    {
        echo "Üdvözöllek, <strong>" . $_SESSION['name'] . "</strong>!";
    } else 
    {
        echo "Nincs beállítva session.";
    }
    ?>
    <br>
    <a href="?torles">Session Törlése</a>

    <?php
    if (isset($_GET['torles'])) 
    {
        session_unset();
        session_destroy();
        echo "<br>Session törölve.";
    }
    ?>
    <hr>
    <form action="" method="post">
        <label for="cookie_value">Add meg a neved a cookiehoz</label>
        <input type="text" name="cookie_value" id="cookie_value">
        <button type="submit">Cookie beállítása</button>
    </form>
    <?php
    if (isset($_COOKIE[$cookie_name])) 
    {
        echo "Üdvözöllek, <strong>" . $_COOKIE[$cookie_name] . "</strong>!";
    } else 
    {
        echo "Nincs beállítva cookie.";
    }
    ?>
    <br>
    <a href="?cookie_torles">Cookie Törlése</a>
    <?php
    if (isset($_GET['cookie_torles'])) 
    {
        setcookie($cookie_name, "", time() - 3600, "/");
        echo "<br>Cookie törölve.";
    }
    ?>
    <hr>
</body>
</html>
