<?php
	class SteamLinuxTest extends PHPUnit_Framework_TestCase
	{
		public function testFileExists( $filePath )
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
			
			$allowedKeys = Array( 'Working', 'Hidden', 'Comment' );
			
			foreach( $games as $key => $value )
			{
				$this->assertTrue( is_numeric( $key ) );
				$this->assertTrue( is_array( $value ) );
				
				foreach( $value as $key => $value2 )
				{
					$this->assertArrayHasKey( $key, $allowedKeys );
					
					if( $key === 'Working' || $key === 'Hidden' )
					{
						$this->assertTrue( is_bool( $value2 ) );
					}
					else if( $key === 'Comment' )
					{
						$this->assertTrue( is_string( $value2 ) );
						$this->assertNotEmpty( $value2 );
					}
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
			
			$this->assertEquals( $gamesOriginal, $games, 'File must be sorted correctly by appid' );
		}
	}
