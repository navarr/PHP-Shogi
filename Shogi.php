<?php 
	class Shogi
	{
		/**
		 * Default Layout
		 * @var mixed
		 */
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
		/**
		 * Convert "Human" Coordinates to Machine Coordinates
		 * @param mixed $var
		 * @param mixed $var2
		 * @return mixed
		 */
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
		/**
		 * Capture a Piece
		 * @param mixed $x
		 * @param mixed $y
		 * @param boolean $human
		 * @return boolean
		 */
		public function capture_piece($x,$y,$human = false)
		{
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
			}
			$piece = $this->board[$y][$x];
			if(!isset($piece[0])) { return false; }
			if($piece[0] == SHOGI_BLACK)
			{
				$newy = 0;
				$piece[0] = SHOGI_WHITE;
			}
			elseif($piece[0] == SHOGI_WHITE)
			{
				$newy = 10;
				$piece[0] = SHOGI_BLACK;
			}
			$piece = $this->demote_piece($x,$y);
			$this->remove_piece($x,$y);
			$this->board[$newy][] = $piece;
			return true;
		}
		/**
		 * Return the Demoted version of the Piece
		 * @param piece $piece
		 * @return piece
		 */
		public function demote_piece($piece)
		{
			if(!isset($piece[0])) { return false; }
			if($piece[1] == SHOGI_TOKIN) { $piece[1] = SHOGI_FUHYOU; }
			if($piece[1] == SHOGI_NARIKYOU) { $piece[1] = SHOGI_KYOUSHA; }
			if($piece[1] == SHOGI_NARIKEI) { $piece[1] = SHOGI_KEIMA; }
			if($piece[1] == SHOGI_NARIGIN) { $piece[1] = SHOGI_GINSHOU; }
			if($piece[1] == SHOGI_RYUUMA) { $piece[1] = SHOGI_KAKUGYOU; }
			if($piece[1] == SHOGI_RYUOU) { $piece[1] = SHOGI_HISHA; }
			return $piece;
		}
		/**
		 * Remove a piece from the board
		 * @param mixed $x
		 * @param mixed $y
		 * @param boolean $human
		 * @return true
		 */
		public function remove_piece($x,$y,$human = false)
		{
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
			}
			unset($this->board[$y][$x]);
			return true;
		}
		/**
		 * Can Move from $x,$y to $tox,$toy
		 * @param mixed $x
		 * @param mixed $y
		 * @param mixed $tox
		 * @param mixed $toy
		 * @param boolean $human
		 * @return boolean Can Move
		 */
		public function can_move($x,$y,$tox,$toy,$human = false)
		{
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
				list($tox,$toy) = $this->human_to_machine($tox,$toy);
			}
			$piece = $this->board[$x][$y];
			
			// Invalid Movements for all Cases
			if(!isset($piece[0])) { return false; } // No piece on the board
			if($this->board[$tox][$toy][0] == $piece[0]) { return false; } // If Same Colour
			if($toy < 1 || $toy > 9) { return false; } // If out of bounds
			if($tox < 0 || $tox > 8) { return false; } // ""
			
			if($piece[1] == SHOGI_OUSHOU) // King
			{
				if(($toy == $y + 1 || $toy == $y - 1) || ($tox == $x + 1 || $tox == $x - 1))
				{
					return true;
				}
			}
			elseif($piece[1] == SHOGI_HISHA) // Rook
			{
				if(($toy > $y || $toy < $y) XOR ($tox > $x || $tox < $x))
				{
					if($toy > $y)
					{
						for($i = $y+1;$i < $toy;$i++)
						{
							if($this->board[$tox][$i][0]) { return false; }
						}
					}
					elseif($toy < $y)
					{
						for($i = $y-1;$i > $toy;$i++)
						{
							if($this->board[$tox][$i][0]) { return false; }
						}
					}
					elseif($tox > $x)
					{
						for($i = $x+1;$i < $tox;$i++)
						{
							if($this->board[$i][$toy][0]) { return false; }
						}
					}
					elseif($tox < $x)
					{
						for($i = $x-1;$i > $tox;$i++)
						{
							if($this->board[$i][$toy][0]) { return false; }
						}
					}
					return true;
				}
			}
			elseif($piece[1] == SHOGI_RYUOU) // Promoted Rook
			{
				
			}
			elseif($piece[1] == SHOGI_KAKUGYOU) // Bishop
			{
				$a = abs($y - $toy);
				$b = abs($x - $tox);
				if($a/$b != 1) { return false; }
			}
			elseif($piece[1] == SHOGI_RYUUMA) // Promoted Bishop
			{
				
			}
			       // Gold General                // Promoted Silver           // Promoted Knight            // Promoted Lance              // Tokin		
			elseif($piece[1] == SHOGI_KINSHOU || $piece[1] == SHOGI_NARIGIN || $piece[1] == SHOGI_NARIKEI || $piece[1] == SHOGI_NARIKYOU || $piece[1] == SHOGI_TOKIN)
			{
				
			}
			elseif($piece[1] == SHOGI_GINSHOU) // Silver General
			{
				
			}
			elseif($piece[1] == SHOGI_NARIKEI) // Knight
			{
				
			}
			elseif($piece[1] == SHOGI_KYOUSHA) // Lance
			{
				
			}
			elseif($piece[1] == SHOGI_FUHYOU) // Pawn
			{
				if($piece[0] == SHOGI_BLACK && $toy = $y-1 && $tox == $x) { return true; }
				if($piece[0] == SHOGI_WHITE && $toy = $y+1 && $tox == $x) { return true; }
				return false;
			}
			return false;
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