<?php
$first_input = fgets( STDIN );

if ( $first_input === false ) {
	fwrite( STDERR, "Введите, пожалуйста, число\n" );
	exit( 1 );
}

$first_input = trim( $first_input );

$second_input = fgets( STDIN );

if ( $second_input === false ) {
	fwrite( STDERR, "Введите, пожалуйста, число\n" );
	exit( 1 );
}

$second_input = trim( $second_input );

if ( ! is_numeric( $first_input ) || $first_input != (int) $first_input ) {
	fwrite( STDERR, "Введите, пожалуйста, число\n" );
	exit( 1 );
}

if ( ! is_numeric( $second_input ) || $second_input != (int) $second_input ) {
	fwrite( STDERR, "Введите, пожалуйста, число\n" );
	exit( 1 );
}

$first_number  = (int) $first_input;
$second_number = (int) $second_input;

if ( $second_number === 0 ) {
	fwrite( STDERR, "Делить на 0 нельзя\n" );
	exit( 1 );
}

$result = $first_number / $second_number;
echo $result . "\n";
exit( 0 );
