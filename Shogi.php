<?php 
	class Shogi
	{
		public $board = array
			(
				0 => array(), // White Holding
				1 => array
				(
					array(SHOGI_WHITE,SHOGI_KYOUSHA),
					array(SHOGI_WHITE,SHOGI_KEIMA),
					array(SHOGI_WHITE,SHOGI_GINSHOU),
					array(SHOGI_WHITE,SHOGI_KINSHOU),
					array(SHOGI_WHITE,SHOGI_OUSHOU),
					array(SHOGI_WHITE,SHOGI_KINSHOU),
					array(SHOGI_WHITE,SHOGI_GINSHOU),
					array(SHOGI_WHITE,SHOGI_KEIMA),
					array(SHOGI_WHITE,SHOGI_KYOUSHA)		
				),
				2 => array
				(
					1 => array(SHOGI_WHITE,SHOGI_HISHA),
					7 => array(SHOGI_WHITE,SHOGI_KAKUGYOU)				
				),
				3 => array
				(
					array(SHOGI_WHITE,SHOGI_FUHYOU),
					array(SHOGI_WHITE,SHOGI_FUHYOU),
					array(SHOGI_WHITE,SHOGI_FUHYOU),
					array(SHOGI_WHITE,SHOGI_FUHYOU),
					array(SHOGI_WHITE,SHOGI_FUHYOU),
					array(SHOGI_WHITE,SHOGI_FUHYOU),
					array(SHOGI_WHITE,SHOGI_FUHYOU),
					array(SHOGI_WHITE,SHOGI_FUHYOU)		
				),
				7 => array
				(
					array(SHOGI_BLACK,SHOGI_FUHYOU),
					array(SHOGI_BLACK,SHOGI_FUHYOU),
					array(SHOGI_BLACK,SHOGI_FUHYOU),
					array(SHOGI_BLACK,SHOGI_FUHYOU),
					array(SHOGI_BLACK,SHOGI_FUHYOU),
					array(SHOGI_BLACK,SHOGI_FUHYOU),
					array(SHOGI_BLACK,SHOGI_FUHYOU),
					array(SHOGI_BLACK,SHOGI_FUHYOU)		
				),
				8 => array
				(
					1 => array(SHOGI_BLACK,SHOGI_KAKUGYOU),
					7 => array(SHOGI_BLACK,SHOGI_HISHA)	
				),
				9 => array
				(
					array(SHOGI_BLACK,SHOGI_KYOUSHA),
					array(SHOGI_BLACK,SHOGI_KEIMA),
					array(SHOGI_BLACK,SHOGI_GINSHOU),
					array(SHOGI_BLACK,SHOGI_KINSHOU),
					array(SHOGI_BLACK,SHOGI_OUSHOU),
					array(SHOGI_BLACK,SHOGI_KINSHOU),
					array(SHOGI_BLACK,SHOGI_GINSHOU),
					array(SHOGI_BLACK,SHOGI_KEIMA),
					array(SHOGI_BLACK,SHOGI_KYOUSHA)
				),
				10 => array() // Black Holding
			);

			public function human_to_machine($var,$var2 = null)
			{
				$ra = array
				(
					"a" => 1,
					"b" => 2,
					"c" => 3,
					"d" => 4,
					"e" => 5,
					"f" => 6,
					"g" => 7,
					"h" => 8,
					"i" => 9,
					9 => 0,
					8 => 1,
					7 => 2,
					6 => 3,
					5 => 4,
					4 => 5,
					3 => 6,
					2 => 7,
					1 => 8
				);
				if($var2) { return array($ra[$var],$ra[$var2]); }
				return $ra[$var];
			}
	}
	// Definitions (Conventions)
	define("SHOGI_OUSHOU",1); // K
	define("SHOGI_HISHA",2); // R
	define("SHOGI_RYUOU",4); // +R
	define("SHOGI_KAKUGYOU",8); // B
	define("SHOGI_RYUUMA",16); // +B
	define("SHOGI_KINSHOU",32); // G
	define("SHOGI_GINSHOU",64); // S
	define("SHOGI_NARIGIN",128); // +S
	define("SHOGI_KEIMA",256); // N
	define("SHOGI_NARIKEI",512); // +N
	define("SHOGI_KYOUSHA",1024); // L
	define("SHOGI_NARIKYOU",2048); // +L
	define("SHOGI_FUHYOU",4096); // p
	define("SHOGI_TOKIN",8192); // +p
	define("SHOGI_WHITE",16384);
	define("SHOGI_BLACK",32768);