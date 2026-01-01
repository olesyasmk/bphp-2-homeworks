<?php
echo "Введите имя: ";
$first_name = trim( fgets( STDIN ) );

echo "Введите фамилию: ";
$last_name = trim( fgets( STDIN ) );

echo "Введите отчество: ";
$patronymic = trim( fgets( STDIN ) );


$full_name = ucfirst( $last_name ) . ' ' . ucfirst( $first_name ) . ' ' . ucfirst( $patronymic );

$surname_and_initials =
	ucfirst( $last_name ) . ' ' .
	mb_strtoupper( mb_substr( $first_name, 0, 1 ) ) . '.' .
	mb_strtoupper( mb_substr( $patronymic, 0, 1 ) ) . '.';

$fio =
	mb_strtoupper( mb_substr( $last_name, 0, 1 ) ) .
	mb_strtoupper( mb_substr( $first_name, 0, 1 ) ) .
	mb_strtoupper( mb_substr( $patronymic, 0, 1 ) );

echo "\nПолное имя: '{$full_name}'\n";
echo "Фамилия и инициалы: '{$surname_and_initials}'\n";
echo "Аббревиатура: '{$fio}'\n";
