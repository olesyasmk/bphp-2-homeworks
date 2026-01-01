<?php
session_start();

if ( ! isset( $_SESSION[ 'page_count' ] ) ) {
	$_SESSION[ 'page_count' ] = 0;
}

$_SESSION[ 'page_count' ]++;

if ( $_SESSION[ 'page_count' ] % 3 === 0 ) {
	header( 'Location: page4.php' );
	exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница 3</title>
</head>
<body>
    <h1>Страница с подсчётом открытий</h1>
    <p>Эта страница была открыта <strong><?php echo $_SESSION[ 'page_count' ]; ?></strong> раз(а).</p>
    <p>При открытии количество раз кратное трём, вы будете перенаправлены на страницу 4.</p>
    <p><a href="page3.php">Обновить страницу</a> | <a href="index.php">Вернуться на главную</a></p>
</body>
</html>
