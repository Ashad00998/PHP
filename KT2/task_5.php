<?php
/**
 * ЗАДАНИЕ 5: Форма авторизации с капчей
 */

// 1. Запускаем сессию в начале
session_start();

$ошибка = '';
$показать_форму = true;

// Выход
if (isset($_GET['logout'])) {
    // Очищаем сессию
    $_SESSION = [];
    session_destroy();
    // Перенаправляем на форму входа
    header('Location: task_05.php');
    exit;
}

// Если уже авторизован и не запрошен выход — показать «кабинет»
if (!empty($_SESSION['user'])) {
    $показать_форму = false;
}

// Генерация капчи (при первой загрузке или по ?new_captcha=1)
if (!isset($_SESSION['captcha_code']) || isset($_GET['new_captcha'])) {
    $код = '';
    for ($i = 0; $i < 5; $i++) {
        $код .= (string)random_int(0, 9);
    }
    $_SESSION['captcha_code'] = $код;
}

// Обработка отправки формы входа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $показать_форму) {
    $логин = trim($_POST['login'] ?? '');
    $пароль = $_POST['password'] ?? '';
    $ввод_капчи = trim($_POST['captcha_input'] ?? '');
    $ожидаемая_капча = $_SESSION['captcha_code'] ?? '';

    // Проверяем капчу
    if ($ввод_капчи !== $ожидаемая_капча) {
        $ошибка = 'Неверный код с картинки';
        // Удаляем использованную капчу из сессии
        unset($_SESSION['captcha_code']);
    } else {
        // Капча верна, удаляем её из сессии
        unset($_SESSION['captcha_code']);
        
        // Проверяем логин и пароль
        if ($логин === 'admin' && $пароль === '12345') {
            // Успешная авторизация
            $_SESSION['user'] = $логин;
            
            // Генерируем новую капчу на будущее
            $новый_код = '';
            for ($i = 0; $i < 5; $i++) {
                $новый_код .= (string)random_int(0, 9);
            }
            $_SESSION['captcha_code'] = $новый_код;
            
            // Перенаправляем на эту же страницу (чтобы избежать повторной отправки формы)
            header('Location: task_05.php');
            exit;
        } else {
            $ошибка = 'Неверный логин или пароль';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 5: Авторизация с капчей</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        h1 { color: #333; }
        .error { color: #c00; margin: 10px 0; }
        .form-block { background: #fff; padding: 20px; border-radius: 8px; margin: 15px 0; }
        label { display: block; margin-top: 12px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 8px; box-sizing: border-box; margin-top: 4px; }
        .captcha-code { font-size: 24px; letter-spacing: 4px; padding: 10px; background: #eee; margin: 10px 0; }
        button { margin-top: 15px; padding: 10px 20px; background: #4CAF50; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .btn-logout { background: #c00; color: #fff; padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Задание 5: Авторизация с капчей</h1>

    <?php if ($показать_форму): ?>
        <p>Войдите: логин <strong>admin</strong>, пароль <strong>12345</strong>. Введите также код капчи.</p>
        <?php if ($ошибка): ?>
            <p class="error"><?= htmlspecialchars($ошибка) ?></p>
        <?php endif; ?>

        <div class="form-block">
            <p>Код капчи: <span class="captcha-code"><?= htmlspecialchars($_SESSION['captcha_code'] ?? '') ?></span></p>
            <p><a href="task_05.php?new_captcha=1">Обновить капчу</a></p>

            <form method="POST">
                <label>Логин: <input type="text" name="login" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>" autocomplete="username"></label>
                <label>Пароль: <input type="password" name="password" autocomplete="current-password"></label>
                <label>Код капчи: <input type="text" name="captcha_input" autocomplete="off" maxlength="10"></label>
                <button type="submit">Войти</button>
            </form>
        </div>
    <?php else: ?>
        <div class="form-block">
            <h2>Личный кабинет</h2>
            <p>Вы вошли как <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>.</p>
            <a href="task_05.php?logout=1" class="btn-logout">Выйти</a>
        </div>
    <?php endif; ?>

    <p style="margin-top: 20px;"><a href="task_04.php">← Предыдущее задание</a> | <a href="task_06.php">Следующее задание →</a></p>
</body>
</html>
