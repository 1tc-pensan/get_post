<?php
try {
    if (isset($_POST["submit"]) && isset($_FILES["kep"])) {
        $uploadFolder = "uploads/";
        $fileName = basename($_FILES["kep"]["name"]);
        $tempFileName = $_FILES["kep"]["tmp_name"];
        $fileSize = $_FILES["kep"]["size"];
        $error = $_FILES["kep"]["error"];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFile = $uploadFolder . $fileName;

        // 1. Hibaellenőrzés
        if ($error) {
            throw new Exception("Hiba történt a feltöltés során: $error");
        }

        // 2. Feltöltési mappa létezése
        if (!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
            throw new Exception("Az $uploadFolder mappa nem létezik vagy nem írható");
        }

        // 3. Már létezik-e?
        if (file_exists($targetFile)) {
            throw new Exception("Az $targetFile már létezik");
        }

        // 4. Fájl méret ellenőrzés
        if ($fileSize > 5000000) {
            throw new Exception("Túl nagy a fájl (max 5 MB)");
        }

        // 5. Fájl típus ellenőrzés
        if (!in_array($fileType, ["jpg", "jpeg", "png", "gif"])) {
            throw new Exception("Nem megfelelő a fájl típusa (csak jpg, jpeg, png, gif)");
        }

        // 6. Fájl áthelyezése
        if (move_uploaded_file($tempFileName, $targetFile)) {
            echo "✅ Sikeresen feltöltve: $targetFile";
        } else {
            throw new Exception("Hiba történt a fájl áthelyezésekor");
        }
    }
} catch (Exception $ex) {
    echo "❌ Hiba történt: {$ex->getMessage()}";
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fájl feltöltése</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple-v1.css">
</head>
<body>
    <h2>Fájl feltöltése</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="kep">Válassz egy képet a feltöltéshez</label>
        <input type="file" name="kep" id="kep">
        <button type="submit" name="submit">Feltöltése</button>
    </form>
</body>
</html>