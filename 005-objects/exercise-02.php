<?php

function generate_work_schedule( $year, $month ) {
	$days_in_month = cal_days_in_month( CAL_GREGORIAN, $month, $year );
	
	$month_names = [
		1  => 'Январь',
		2  => 'Февраль',
		3  => 'Март',
		4  => 'Апрель',
		5  => 'Май',
		6  => 'Июнь',
		7  => 'Июль',
		8  => 'Август',
		9  => 'Сентябрь',
		10 => 'Октябрь',
		11 => 'Ноябрь',
		12 => 'Декабрь'
	];
	
	$month_name = $month_names[ $month ];
	
	$work_days = [];
	
	$days_since_last_work = 2;
	
	for ( $day = 1; $day <= $days_in_month; $day++ ) {
		$date        = "$year-$month-$day";
		$day_of_week = date( 'N', strtotime( $date ) );
		
		if ( $days_since_last_work >= 2 ) {
			if ( $day_of_week == 6 || $day_of_week == 7 ) {
				continue;
			}
			else {
				$work_days[]          = $day;
				$days_since_last_work = 0;
			}
		}
		else {
			$days_since_last_work++;
		}
	}
	
	echo "\n";
	echo "========================================\n";
	echo "  Расписание на $month_name $year года\n";
	echo "========================================\n\n";
	
	$day_names = [ 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс' ];
	
	foreach ( $day_names as $day_name ) {
		echo mb_str_pad( $day_name, 4, ' ', STR_PAD_LEFT );
	}
	
	echo "\n";
	echo str_repeat( '-', 28 ) . "\n";
	
	$first_day_of_week = date( 'N', strtotime( "$year-$month-1" ) );
	
	for ( $i = 1; $i < $first_day_of_week; $i++ ) {
		echo "    ";
	}
	
	for ( $day = 1; $day <= $days_in_month; $day++ ) {
		$date        = "$year-$month-$day";
		$day_of_week = date( 'N', strtotime( $date ) );
		
		if ( in_array( $day, $work_days ) ) {
			echo "\033[32m" . str_pad( $day, 3, ' ', STR_PAD_LEFT ) . "\033[0m ";
		}
		else {
			echo str_pad( $day, 3, ' ', STR_PAD_LEFT ) . " ";
		}
		
		if ( $day_of_week == 7 ) {
			echo "\n";
		}
	}
	
	echo "\n\n";
	echo "\nВсего рабочих дней: " . count( $work_days ) . "\n";
	echo "========================================\n\n";
}

generate_work_schedule( 2026, 1 );
