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
		 * We're sadistic bastards that only allow tabs
		 *
		 * @depends testFileNotEmpty
		 */
		public function testWhitespace( $games )
		{
			$this->assertNotRegExp( '/^ +/m', $games, 'Spaces used, we only allow tabs' );
			$this->assertNotRegExp( '/^\t+ +/m', $games, 'Tabs mixed with spaces, we only allow tabs' );
			
			$games = trim( $games );
			
			$this->assertNotRegExp( '/\s$/m', $games, 'End of line whitespace found, fix it' );
			$this->assertNotRegExp( '/^$/m', $games, 'Empty line found, fix it' );
			
			return $games;
		}
		
		/**
		 * @depends testWhitespace
		 */
		public function testJSON( $games )
		{
			$games = json_decode( $games, true );
			
			$this->assertSame( json_last_error(), JSON_ERROR_NONE, 'JSON Error: ' . ( function_exists( 'json_last_error_msg' ) ? json_last_error_msg() : json_last_error() ) );
			
			$allowedKeys = Array(
				'Hidden'     => 'is_bool',
				'Beta'       => 'is_bool',
				'Comment'    => 'is_string',
				'CommentURL' => 'is_string'
			);
			
			foreach( $games as $appID => $keys )
			{
				$this->assertTrue( is_numeric( $appID ), 'Key "' . $appID . '" must be numeric' );
				
				if( $keys === true )
				{
					// We're golden!
				}
				else if( is_array( $keys ) )
				{
					$this->assertNotEmpty( $keys, '"' . $appID . '" can not be an empty array' );
					
					foreach( $keys as $key => $value )
					{
						$this->assertArrayHasKey( $key, $allowedKeys, 'Invalid key "' . $key . '" in "' . $appID . '"' );
						$this->assertTrue( $allowedKeys[ $key ]( $value ), '"' . $key . '" in "' . $appID . '" is not "' . $allowedKeys[ $key ] . '"' );
						
						if( $key === 'Beta' )
						{
							$this->assertTrue( $value, $key . ' key in "' . $appID . '" can only be set to true' );
						}
						else if( $key === 'Hidden' )
						{
							$this->assertTrue( $value, $key . ' key in "' . $appID . '" can only be set to true' );
							$this->assertArrayNotHasKey( 'Beta', $keys, 'Beta key can not be used along with Hidden key in "' . $appID . '"' );
							$this->assertArrayHasKey( 'Comment', $keys, 'Hidden app "' . $appID . '" must contain a Comment explaining why it was hidden' );
						}
						else if( $key === 'CommentURL' )
						{
							$this->assertArrayHasKey( 'Comment', $keys, 'CommentURL key can not be without Comment key in "' . $appID . '"' );
							$this->assertStringStartsWith( 'http', $value, 'CommentURL must be an url in "' . $appID . '"' );
						}
					}
				}
				else
				{
					$this->assertTrue( false, 'Key "' . $appID . '" has an invalid value' );
				}
			}
			
			return $games;
		}
		
		/**
		 * @depends testJSON
		 */
		public function testSorting( $games )
		{
			$gamesSorted = $games;
			
			ksort( $gamesSorted );

			if( $games !== $gamesSorted )
			{
				$gamesKeys = array_keys( $games );
				$gamesSortedKeys = array_keys( $gamesSorted );
				$cachedCount = count( $gamesKeys );
				
				unset( $games, $gamesSorted );
				
				for( $i = 0; $i < $cachedCount; ++$i )
				{
					$message = '';
					if ( $gamesKeys[ $i ] !== $gamesSortedKeys[ $i ] )
					{
						$where = array_search( $gamesKeys[ $i ], $gamesSortedKeys ) - array_search( $gamesSortedKeys[ $i ], $gamesKeys );
						$message = $where > 0 ? $gamesKeys[ $i ] . '" is far too early' : ( $where == 0 ? $gamesKeys[ $i ] . '" is on an adjacent line' : $gamesSortedKeys[ $i ] . '" is far too late' );
					}
					$this->assertEquals( $gamesKeys[ $i ], $gamesSortedKeys[ $i ], 'File must be sorted correctly by appid, "' . $message );
				}
			}
		}
	}
