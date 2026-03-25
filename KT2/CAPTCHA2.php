<?php
session_start();

$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = isset($_POST['captcha']) ? trim($_POST['captcha']) : '';
    if (!empty($_SESSION['captcha_text']) && $userInput === $_SESSION['captcha_text']) {
        $result = '<span style="color:green;">✅ Корректно! Капча введена верно.</span>';
        // Очищаем сессию, чтобы нельзя было использовать старую капчу повторно
        unset($_SESSION['captcha_text']);
    } else {
        $result = '<span style="color:red;">❌ Не корректно. Попробуйте снова.</span>';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>CAPTCHA на PHP</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .captcha-img { margin: 20px; border: 1px solid #ccc; }
        input { padding: 8px; font-size: 16px; margin: 10px; }
        button { padding: 8px 15px; font-size: 16px; cursor: pointer; }
        .result { margin: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Проверка CAPTCHA</h1>
    <form method="post">
        <div>
            <img src="captcha.php" alt="CAPTCHA" class="captcha-img">
        </div>
        <div>
            <label for="captcha">Введите текст с картинки:</label><br>
            <input type="text" name="captcha" id="captcha" required autocomplete="off">
        </div>
        <button type="submit">Проверить</button>
    </form>

    <?php if ($result !== null): ?>
        <div class="result"><?php echo $result; ?></div>
    <?php endif; ?>
</body>
</html>
