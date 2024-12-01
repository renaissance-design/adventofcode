<?php

function getResult( $file ) {
    if( file_exists( $file ) && is_readable( $file ) ) {

		foreach( file( $file ) as $line ) {

			$split = explode( '   ', $line );

			$left[] = (int) $split[0];
			$right[] = (int) $split[1];
		}

		sort( $left, SORT_NUMERIC );
		sort( $right, SORT_NUMERIC );
		
		for( $i = 0; $i <= count( $left ); $i++ ) {
			$results[$i] = ( $left[$i] > $right[$i] ? $left[$i] - $right[$i] : $right[$i] - $left[$i] );
		}

		return array_sum( $results );
	}
}

echo 'Result: ' . getResult( 'input.txt' );
