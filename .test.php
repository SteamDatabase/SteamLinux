<?php
	class SteamLinuxTest extends PHPUnit_Framework_TestCase
	{
		public function testFileExists( )
		{
			// Trying to get dataProvider to work with depends in phpunit requires some serious magic
			$filePath = __DIR__ . DIRECTORY_SEPARATOR . 'GAMES.json';
			
			$this->assertFileExists( $filePath );
			
			return $filePath;
		}
		
		/**
		 * @depends testFileExists
		 */
		public function testFileNotEmpty( $filePath )
		{
			$games = file_get_contents( $filePath );
			
			$this->assertNotEmpty( $games );
			
			return $games;
		}
		
		/**
		 * @depends testFileNotEmpty
		 */
		public function testJSON( $games )
		{
			$games = json_decode( $games, true );
			
			$this->assertSame( json_last_error(), JSON_ERROR_NONE, json_last_error_msg() );
			
			$allowedKeys = Array(
				'Working'    => 'is_bool',
				'Hidden'     => 'is_bool',
				'Beta'       => 'is_bool',
				'Comment'    => 'is_string',
				'CommentURL' => 'is_string'
			);
			
			foreach( $games as $appID => $value )
			{
				$this->assertTrue( is_numeric( $appID ), 'Key "' . $appID . '" must be numeric' );
				$this->assertTrue( is_array( $value ), 'Value of "' . $appID . '" must be an array' );
				
				foreach( $value as $key => $value2 )
				{
					$this->assertArrayHasKey( $key, $allowedKeys, 'Invalid key "' . $key . '" in "' . $appID . '"' );
					$this->assertTrue( $allowedKeys[ $key ]( $value2 ), '"' . $key . '" in "' . $appID . '" is not "' . $allowedKeys[ $key ] . '"' );
				}
			}
			
			return $games;
		}
		
		/**
		 * @depends testJSON
		 */
		public function testSorting( $games )
		{
			$gamesOriginal = $games;
			
			ksort( $games );
			
			$this->assertTrue( $gamesOriginal === $games, 'File must be sorted correctly by appid' );
		}
	}
