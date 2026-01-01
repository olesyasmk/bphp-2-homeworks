<?php
$text = isset( $_GET[ 'text' ] ) ? $_GET[ 'text' ] : 'Текст по умолчанию';

header( 'Content-Type: text/plain' );
header( 'Content-Disposition: attachment; filename="downloaded_text.txt"' );

echo $text;