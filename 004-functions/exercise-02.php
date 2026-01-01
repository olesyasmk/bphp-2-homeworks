<?php

// объявление констант и переменных
// объявление созданных функций

const OPERATION_EXIT   = 0;
const OPERATION_ADD    = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT  = 3;

$operations = [
	OPERATION_EXIT   => OPERATION_EXIT . '. Завершить программу.',
	OPERATION_ADD    => OPERATION_ADD . '. Добавить товар в список покупок.',
	OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
	OPERATION_PRINT  => OPERATION_PRINT . '. Отобразить список покупок.',
];

$items = [];

function printShoppingList( array $items ): void {
	if ( count( $items ) ) {
		echo 'Ваш список покупок: ' . PHP_EOL;
		echo implode( "\n", $items ) . "\n";
	}
	else {
		echo 'Ваш список покупок пуст.' . PHP_EOL;
	}
}

function getOperationNumber( array $items, array $operations ): int {
	do {
		system( 'clear' );
		
		printShoppingList( $items );
		
		echo 'Выберите операцию для выполнения: ' . PHP_EOL;
		echo implode( PHP_EOL, $operations ) . PHP_EOL . '> ';
		
		$operationNumber = trim( fgets( STDIN ) );
		
		if ( ! array_key_exists( $operationNumber, $operations ) ) {
			system( 'clear' );
			
			echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
			echo 'Нажмите enter для продолжения';
			
			fgets( STDIN );
		}
	}
	while ( ! array_key_exists( $operationNumber, $operations ) );
	
	return (int) $operationNumber;
}

function addItem( array &$items ): void {
	echo "Введение название товара для добавления в список: \n> ";
	
	$itemName = trim( fgets( STDIN ) );
	$items[]  = $itemName;
}

function deleteItem( array &$items ): void {
	echo 'Текущий список покупок:' . PHP_EOL;
	
	printShoppingList( $items );
	
	echo 'Введение название товара для удаления из списка:' . PHP_EOL . '> ';
	$itemName = trim( fgets( STDIN ) );
	
	if ( in_array( $itemName, $items, true ) !== false ) {
		while ( ( $key = array_search( $itemName, $items, true ) ) !== false ) {
			unset( $items[ $key ] );
		}
	}
}

function printItemsWithPause( array $items ): void {
	printShoppingList( $items );
	
	echo 'Всего ' . count( $items ) . ' позиций. ' . PHP_EOL;
	echo 'Нажмите enter для продолжения';
	
	fgets( STDIN );
}

do {
	$operationNumber = getOperationNumber( $items, $operations );
	
	echo 'Выбрана операция: ' . $operations[ $operationNumber ] . PHP_EOL;
	
	switch ( $operationNumber ) {
		case OPERATION_ADD:
			addItem( $items );
			break;
		
		case OPERATION_DELETE:
			deleteItem( $items );
			break;
		
		case OPERATION_PRINT:
			printItemsWithPause( $items );
			break;
	}
	
	echo "\n ----- \n";
} while ( $operationNumber > 0 );

echo 'Программа завершена' . PHP_EOL;
