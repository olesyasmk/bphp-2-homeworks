<?php
if ( $_SERVER[ 'REQUEST_METHOD' ] !== 'POST' ) {
	header( 'Location: index.html' );
	exit;
}

if ( empty( $_POST[ 'file_name' ] ) || trim( $_POST[ 'file_name' ] ) === '' ) {
	header( 'Location: index.html' );
	exit;
}

if ( ! isset( $_FILES[ 'content' ] ) || $_FILES[ 'content' ][ 'error' ] === UPLOAD_ERR_NO_FILE ) {
	header( 'Location: index.html' );
	exit;
}

if ( $_FILES[ 'content' ][ 'error' ] !== UPLOAD_ERR_OK ) {
	die( 'Ошибка при загрузке файла. Код ошибки: ' . $_FILES[ 'content' ][ 'error' ] );
}

function format_file_size( $bytes ) {
	$units = [ 'байт', 'КБ', 'МБ', 'ГБ', 'ТБ' ];
	$bytes = max( $bytes, 0 );
	$pow   = floor( ( $bytes ? log( $bytes ) : 0 ) / log( 1024 ) );
	$pow   = min( $pow, count( $units ) - 1 );
	$bytes /= pow( 1024, $pow );
	
	return round( $bytes, 2 ) . ' ' . $units[ $pow ];
}


$file_name = trim( $_POST[ 'file_name' ] );

$upload_dir = 'upload/';

if ( ! is_dir( $upload_dir ) ) {
	mkdir( $upload_dir, 0755, true );
}

$full_path = $upload_dir . basename( $file_name );

if ( move_uploaded_file( $_FILES[ 'content' ][ 'tmp_name' ], $full_path ) ) {
	$file_size           = filesize( $full_path );
	$file_size_formatted = format_file_size( $file_size );
	$absolute_path       = realpath( $full_path );
	
	?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Файл загружен</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #f5f5f5;
            }

            .success-container {
                background: white;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #4CAF50;
                margin-bottom: 20px;
            }

            .info-block {
                background-color: #e8f5e9;
                padding: 15px;
                border-left: 4px solid #4CAF50;
                margin: 20px 0;
                border-radius: 4px;
            }

            .info-row {
                margin: 10px 0;
            }

            .label {
                font-weight: bold;
                color: #555;
            }

            .value {
                color: #333;
                word-break: break-all;
            }

            .back-link {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #2196F3;
                color: white;
                text-decoration: none;
                border-radius: 4px;
            }

            .back-link:hover {
                background-color: #1976D2;
            }
        </style>
    </head>
    <body>
    <div class="success-container">
        <h1>✓ Файл успешно загружен!</h1>

        <div class="info-block">
            <div class="info-row">
                <span class="label">Полный путь к файлу:</span><br>
                <span class="value"><?php echo htmlspecialchars( $absolute_path ); ?></span>
            </div>

            <div class="info-row">
                <span class="label">Относительный путь:</span><br>
                <span class="value"><?php echo htmlspecialchars( $full_path ); ?></span>
            </div>

            <div class="info-row">
                <span class="label">Размер файла:</span><br>
                <span class="value"><?php echo htmlspecialchars( $file_size_formatted ); ?> (<?php echo number_format( $file_size ); ?> байт)</span>
            </div>

            <div class="info-row">
                <span class="label">Имя файла:</span><br>
                <span class="value"><?php echo htmlspecialchars( $file_name ); ?></span>
            </div>
        </div>

        <a href="index.php" class="back-link">← Загрузить еще один файл</a>
    </div>
    </body>
    </html>
	<?php
}
else {
	die( 'Ошибка при сохранении файла на сервер.' );
}