<?php
$name = '';
$pass = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['pass'])) {
        $pass = $_POST['pass'];
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['name'])) {
    $name = $_GET['name'];
}
?>
<html>
<head>
    <title>Űrlap</title>
</head>
<body>
    <p><a href="?name=admin">Kattints ide a üdvözléshez</a></p>
    <h1>Űrlap</h1>
    <form action="" method="post">
        <label for="name">Név:</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="pass">Jelszó:</label>
        <input type="password" name="pass" id="pass">
        <br>
        <button type="submit">Submit</button>
    </form>
    <?php if ($name): ?>
        <p>Hello, <?php echo htmlspecialchars($name); ?>!</p>
    <?php endif; ?>
    <?php if ($pass): ?>
        <p>Your password is: <?php echo htmlspecialchars($pass); ?></p>
    <?php endif; ?>
</body>
</html>