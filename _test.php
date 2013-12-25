<?php
	class SteamLinuxTest extends PHPUnit_Framework_TestCase
	{
		private $FilePath = __DIR__ . DIRECTORY_SEPARATOR . 'GAMES.json';
		private $Games;
		
		public function testFileExists()
		{
			$this->assertFileExists( $this->FilePath );
		}
		
		/**
		 * @depends testFileExists
		 */
		public function testFileNotEmpty()
		{
			$this->Games = file_get_contents( $this->FilePath );
			
			$this->assertNotEmpty( $this->Games );
		}
		
		/**
		 * @depends testFileNotEmpty
		 */
		public function testJSON()
		{
			$Games = json_decode( $this->Games, true );
			
			$this->assertSame( json_last_error(), JSON_ERROR_NONE, json_last_error_msg() );
			
			foreach( $Games as $Key => $Value )
			{
				$this->assertTrue( is_numeric( $Key ) );
				$this->assertTrue( is_array( $Value ) );
			}
		}
	}
