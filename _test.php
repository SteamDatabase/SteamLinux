<?php
	class SteamLinuxTest extends PHPUnit_Framework_TestCase
	{
		public function filePathProvider()
		{
			return __DIR__ . DIRECTORY_SEPARATOR . 'GAMES.json';
		}
		
		/**
		 * @dataProvider filePathProvider
		 */
		public function testFileExists( $filePath )
		{
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
			
			foreach( $games as $key => $value )
			{
				$this->assertTrue( is_numeric( $key ) );
				$this->assertTrue( is_array( $value ) );
			}
		}
	}
