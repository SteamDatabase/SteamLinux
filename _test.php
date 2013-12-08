<?php
	class SteamLinuxLinksTest extends PHPUnit_Framework_TestCase
	{
		public function testLinks()
		{
			$Files = glob( __DIR__ . DIRECTORY_SEPARATOR . '_posts' . DIRECTORY_SEPARATOR . '*.markdown' );
			
			$this->assertNotEmpty( $Files );
			
			foreach( $Files as $File )
			{
				$File = file( $File, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES );
				
				$this->assertNotEmpty( $File );
				
				foreach( $File as $Line )
				{
					// Simple check for markdown list and url
					if( substr( $Line, 0, 3 ) !== '- [' )
					{
						continue;
					}
					
					$this->assertRegExp( '/^- \[(.+)\]\(http:\/\/store\.steampowered\.com\/app\/[0-9]{1,6}\/\)/', $Line );
				}
			}
		}
	}
