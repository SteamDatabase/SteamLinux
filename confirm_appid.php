#!/usr/bin/env php
<?php
	if( $argc < 2 )
	{
		echo 'Usage: ./' . $argv[ 0 ] . ' <appid> [appid] [appid] - Confirm one or more appids' . PHP_EOL;
		exit;
	}
	
	$Games = json_decode( file_get_contents( __DIR__ . '/GAMES.json' ), true );
	
	for( $i = 1; $i < count( $argv ); $i++ )
	{
		$AppID = $argv[ $i ];
		
		if( !is_numeric( $AppID ) || $AppID <= 0 )
		{
			echo '"' . $AppID . '" is not a valid AppID' . PHP_EOL;
			exit;
		}
		
		$AppID = (int)$AppID;
		
		if( array_key_exists( $AppID, $Games ) )
		{
			echo 'AppID ' . $AppID . ' is already confirmed' . PHP_EOL;
			exit;	
		}
		
		$Games[ $AppID ] = true;
		
		echo 'Confirmed AppID ' . $AppID . PHP_EOL;
	}
	
	ksort( $Games );
	
	$Games = json_encode( $Games, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
	$Games = str_replace( '    ', "\t", $Games );
	$Games = str_replace( ' {', "\n\t{", $Games );
	$Games .= "\n";
	
	file_put_contents( __DIR__ . '/GAMES.json', $Games );
