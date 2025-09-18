<?php
// Session indítása
session_start();

// Session beállítása
if (isset($_POST['session_name']) && !empty($_POST['session_name'])) {
    $_SESSION['name'] = $_POST['session_name'];
    echo "Session beállítva: " . $_SESSION['name'] . "<br>";
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
    <br>
    <?php
    if (isset($_SESSION['name'])) 
    {
        echo "Üdvözöllek, <strong>" . $_SESSION['name'] . "</strong>!";
    } else 
    {
        echo "Nincs beállítva session.";
    }
    ?>
</body>
</html>
