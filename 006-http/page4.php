<?php
session_start();

$count = isset( $_SESSION[ 'page_count' ] ) ? $_SESSION[ 'page_count' ] : 0;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница 4</title>
</head>
<body>
	<h1>Результат подсчёта</h1>
	<p>Третья страница была открыта <strong><?php echo $count; ?></strong> раз(а).</p>
	<p>Вы были перенаправлены сюда, потому что количество открытий кратно трём!</p>
	<p><a href="page3.php">Открыть страницу 3 снова</a> | <a href="index.php">Вернуться на главную</a></p>
</body>
</html>