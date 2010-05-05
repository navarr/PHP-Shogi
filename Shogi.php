<?php 
	class Shogi
	{
		/**
		 * Debug
		 * @var boolean
		 */
		public $debug = false;
		/**
		 * Conventions
		 * @var mixed
		 */
		public $convention = array
		(
			SHOGI_OUSHOU => "K",
			SHOGI_HISHA => "R",
			SHOGI_RYUOU => "+R",
			SHOGI_KAKUGYOU => "B",
			SHOGI_RYUUMA => "+B",
			SHOGI_KINSHOU => "G",
			SHOGI_GINSHOU => "S",
			SHOGI_NARIGIN => "+S",
			SHOGI_KEIMA => "N",
			SHOGI_NARIKEI => "+N",
			SHOGI_KYOUSHA => "L",
			SHOGI_NARIKYOU => "+L",
			SHOGI_FUHYOU => "p",
			SHOGI_TOKIN => "+p"	
		);
		/**
		 * Colors
		 * @var mixed
		 */
		public $colors = array
		(
			SHOGI_BLACK => "Black",
			SHOGI_WHITE => "White"
		);
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
		 * Turn - Whose Turn it Is
		 * @var SHOGI_BLACK or SHOGI_WHITE
		 */
		public $turn = SHOGI_BLACK;
		/**
		 * Log - Log of Movements
		 * @var array
		 *      (
		 *        array(COLOUR, PIECE, FROM_X, FROM_Y, TO_X, TO_Y),
		 *        ...
		 *      )
		 */
		public $log = array();
		/**
		 * Fills in Array Blanks in the Board Array.
		 * @return void
		 */
		public function fill_in_board_blanks()
		{
			for($a = 1;$a <= 9;$a++)
			{
				if(!isset($this->board[$a])) { $this->board[$a] = array(); }
				for($b = 0;$b <= 8;$b++)
				{
					if(!isset($this->board[$a][$b])) { $this->board[$a][$b] = 0; }
				}
				ksort($this->board[$a]);
			}
			ksort($this->board);
		}
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
		 * 
		 * @param unknown_type $x
		 * @param unknown_type $y
		 * @param unknown_type $human
		 * @return unknown_type
		 */
		public function get_place($x,$y,$human = false)
		{
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
			}
			return $this->board[$y][$x];
		}
		/**
		 * Capture a Piece
		 * @param mixed $x
		 * @param mixed $y
		 * @param boolean $human
		 * @return boolean
		 */
		public function capture($x,$y,$human = false)
		{
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
			}
			$piece = $this->board[$y][$x];
			if(!isset($piece[0])) { return false; }
			$piece = $this->demote_piece($piece);
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
			$orig = $piece;
			if(!isset($piece[1])) { return false; }
			if($piece[1] == SHOGI_TOKIN) { $piece[1] = SHOGI_FUHYOU; }
			if($piece[1] == SHOGI_NARIKYOU) { $piece[1] = SHOGI_KYOUSHA; }
			if($piece[1] == SHOGI_NARIKEI) { $piece[1] = SHOGI_KEIMA; }
			if($piece[1] == SHOGI_NARIGIN) { $piece[1] = SHOGI_GINSHOU; }
			if($piece[1] == SHOGI_RYUUMA) { $piece[1] = SHOGI_KAKUGYOU; }
			if($piece[1] == SHOGI_RYUOU) { $piece[1] = SHOGI_HISHA; }
			$this->debug("Demoted {$this->convention[$orig[1]]} to {$this->convention[$piece[1]]}");
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
			$this->debug("Removing Piece {$x},{$y}");
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
			}
			$this->board[$y][$x] = array();
			return true;
		}
		/**
		 * Place a Piece on a Specific Slot
		 * @param piece $piece
		 * @param mixed $x
		 * @param mixed $y
		 * @param boolean $human
		 * @return boolean
		 */
		public function place_piece($piece,$x,$y,$human = false)
		{
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
			}
			if($piece[0] && $piece[1]) // Has to be valid data.
			{
				$this->board[$y][$x] = $piece;
				return true;
			} else { return false; }
		}
		/**
		 * Move a piece following Shogi Rules
		 * @param mixed $x
		 * @param mixed $y
		 * @param mixed $tox
		 * @param mixed $toy
		 * @param boolean $human
		 * @return boolean
		 */
		public function move($x,$y,$tox,$toy,$human = false)
		{
			if($human)
			{
				list($x,$y) = $this->human_to_machine($x,$y);
				list($tox,$toy) = $this->human_to_machine($tox,$toy);
			}
			$piece = $this->board[$y][$x];
			if($piece[0] != $this->turn) { $this->debug("Not Our Turn");return false; } // Not our turn.
			if(!$this->can_move($x,$y,$tox,$toy)) { $this->debug("Can't Move");return false; } // Invalid Move
			if($this->board[$toy][$tox][0]) { if(!$this->capture($tox,$toy)) { $this->debug("Can't Capture Piece");return false; } }
			$this->place_piece($piece,$tox,$toy);
			$this->remove_piece($x,$y);
			if($this->turn == SHOGI_WHITE) { $this->turn = SHOGI_BLACK; }
			else { $this->turn = SHOGI_WHITE; } // Switch the Turncxv 
			$this->log[] = array($piece[0],$piece[1],$x,$y,$tox,$toy);
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
			$piece = $this->board[$y][$x];
			
			$this->debug("Can Move from {$x},{$y} to {$tox},{$toy}?");
			$this->debug("Piece: {$this->colors[$piece[0]]} {$this->convention[$piece[1]]}");
			
			// Invalid Movements for all Cases
			if(!isset($piece[0])) { return false; } // No piece on the board
			if($this->board[$toy][$tox][0] == $piece[0]) { return false; } // If Same Colour
			if($toy < 1 || $toy > 9) { return false; } // If out of bounds
			if($tox < 0 || $tox > 8) { return false; } // ""
			
			if($piece[1] == SHOGI_OUSHOU) // King
			{
				if(($toy == $y + 1 || $toy == $y - 1) || ($tox == $x + 1 || $tox == $x - 1))
				{
					return true;
				}
				return false;
			}
			elseif($piece[1] == SHOGI_HISHA) // Rook
			{
				if(($toy > $y || $toy < $y) XOR ($tox > $x || $tox < $x))
				{
					if($toy > $y)
					{
						for($i = $y+1;$i < $toy;$i++)
						{
							if($this->board[$toy][$i][0]) { return false; }
						}
					}
					elseif($toy < $y)
					{
						for($i = $y-1;$i > $toy;$i++)
						{
							if($this->board[$toy][$i][0]) { return false; }
						}
					}
					elseif($tox > $x)
					{
						for($i = $x+1;$i < $tox;$i++)
						{
							if($this->board[$i][$tox][0]) { return false; }
						}
					}
					elseif($tox < $x)
					{
						for($i = $x-1;$i > $tox;$i++)
						{
							if($this->board[$i][$tox][0]) { return false; }
						}
					}
					return true;
				}
				return false;
			}
			elseif($piece[1] == SHOGI_RYUOU) // Promoted Rook
			{
				if(($toy == $y + 1 || $toy == $y - 1) || ($tox == $x + 1 || $tox == $x - 1)) { return true; } // King Moves
				elseif(($toy > $y || $toy < $y) XOR ($tox > $x || $tox < $x))
				{
					if($toy > $y)
					{
						for($i = $y+1;$i < $toy;$i++)
						{
							if($this->board[$toy][$i][0]) { return false; }
						}
					}
					elseif($toy < $y)
					{
						for($i = $y-1;$i > $toy;$i++)
						{
							if($this->board[$toy][$i][0]) { return false; }
						}
					}
					elseif($tox > $x)
					{
						for($i = $x+1;$i < $tox;$i++)
						{
							if($this->board[$i][$tox][0]) { return false; }
						}
					}
					elseif($tox < $x)
					{
						for($i = $x-1;$i > $tox;$i++)
						{
							if($this->board[$i][$tox][0]) { return false; }
						}
					}
					return true;
				}
				return false;
			}
			elseif($piece[1] == SHOGI_KAKUGYOU) // Bishop
			{
				$a = abs($y - $toy);
				$b = abs($x - $tox);
				if($a/$b != 1) { return false; } // |Slope| must be 1
				if($x < $tox && $y < $toy)
				{
					for($i = 1;$i < ($x - $tox);$i++)
					{
						if($this->board[$y-$i][$x-$i][0]) { return false; }
					}
				}
				elseif($x > $tox && $y < $toy)
				{
					for($i = 1;$i < ($x - $tox);$i++)
					{
						if($this->board[$y+$i][$x-$i][0]) { return false; }
					}
				}
				elseif($x < $tox && $y > $toy)
				{
					for($i = 1;$i < ($y - $toy);$i++)
					{
						if($this->board[$y-$i][$x+$i][0]) { return false; }
					}
				}
				elseif($x > $tox && $y > $toy)
				{
					for($i = 1;$i < ($y - $toy);$i++)
					{
						if($this->board[$y-$i][$x-$i][0]) { return false; }
					}
				}
				return true;
			}
			elseif($piece[1] == SHOGI_RYUUMA) // Promoted Bishop
			{
				$a = abs($y - $toy);
				$b = abs($x - $tox);
				if(($toy == $y + 1 || $toy == $y - 1) || ($tox == $x + 1 || $tox == $x - 1)) { return true; } // King Moves
				if($a/$b != 1) { return false; } // |Slope| must be 1
				if($x < $tox && $y < $toy)
				{
					for($i = 1;$i < ($x - $tox);$i++)
					{
						if($this->board[$y-$i][$x-$i][0]) { return false; }
					}
				}
				elseif($x > $tox && $y < $toy)
				{
					for($i = 1;$i < ($x - $tox);$i++)
					{
						if($this->board[$y+$i][$x-$i][0]) { return false; }
					}
				}
				elseif($x < $tox && $y > $toy)
				{
					for($i = 1;$i < ($y - $toy);$i++)
					{
						if($this->board[$y-$i][$x+$i][0]) { return false; }
					}
				}
				elseif($x > $tox && $y > $toy)
				{
					for($i = 1;$i < ($y - $toy);$i++)
					{
						if($this->board[$y-$i][$x-$i][0]) { return false; }
					}
				}
				return true;
			}
			       // Gold General                // Promoted Silver           // Promoted Knight            // Promoted Lance              // Tokin		
			elseif($piece[1] == SHOGI_KINSHOU || $piece[1] == SHOGI_NARIGIN || $piece[1] == SHOGI_NARIKEI || $piece[1] == SHOGI_NARIKYOU || $piece[1] == SHOGI_TOKIN)
			{
				if($toy == $y-1 && ($tox = $x+1 || $tox = $x-1 || $tox = $x)) // Row Above
				{
					return true;
				}
				elseif($toy == $y && ($tox = $x+1 || $tox = $x-1)) // Left or Right
				{
					return true;
				}
				elseif($toy == $y+1 && $tox = $x)
				{
					return true;
				}
				return false;
			}
			elseif($piece[1] == SHOGI_GINSHOU) // Silver General
			{
				if($toy == $y-1 && ($tox = $x+1 || $tox = $x-1 || $tox = $x)) // Row Above
				{
					return true;
				}
				elseif($toy == $y+1 && ($tox == $x-1 || $tox == $x+1))
				{
					return true;
				}
				return false;
			}
			elseif($piece[1] == SHOGI_KEIMA) // Knight
			{
				if($piece[0] == SHOGI_BLACK)
				{
					if($toy == $y-2 && ($tox == $x-1 || $tox == $x+1)) { return true; }
					return false;
				}
				if($piece[0] == SHOGI_WHITE)
				{
					if($toy == $y+2 && ($tox == $x-1 || $tox == $x+1)) { return true; }
					return false;
				}
			}
			elseif($piece[1] == SHOGI_KYOUSHA) // Lance
			{
				if($piece[0] == SHOGI_BLACK)
				{
					if($toy < $y && $tox == $x)
					{
						for($i = $y-1;$i < $toy;$i++)
						{
							if($this->board[$i][$tox][0]) { return false; }
						}
						return true;
					}
				}
				if($piece[0] == SHOGI_WHITE)
				{
					if($toy > $y && $tox == $x)
					{
						for($i = $y+1;$i > $toy;$i++)
						{
							if($this->board[$i][$tox][0]) { return false; }
						}
						return true;
					}
				}
				return false;
			}
			elseif($piece[1] == SHOGI_FUHYOU) // Pawn
			{
				if($piece[0] == SHOGI_BLACK && $toy == $y-1 && $tox == $x) { return true; }
				elseif($piece[0] == SHOGI_WHITE && $toy == $y+1 && $tox == $x) { return true; }
				else { return false; }
			}
			else { return false; }
		}
		/**
		 * 
		 * @return unknown_type
		 */
		public function html_table_board($header = false)
		{
			$output = "<table>";
			if($header) { $output .= "<tr><th></th><th>0</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th></tr>"; }
			foreach($this->board as $a => $row)
			{
				$output.= "<tr>";
				if($header) { $output .= "<th>{$a}</th>"; }
				if($a == 0 || $a == 10)
				{
					$class = "";
					if($a == 0) { $class = "white"; }
					if($a == 10) { $class = "black"; }
					$output .= "<td colspan=\"9\" class=\"{$class}\">";
					foreach($row as $b => $field)
					{
						$row[$b] = $this->convention[$field[1]];
					}
					$output .= implode(", ",$row);
					$output .= "</td>";
				}
				else { foreach($row as $b => $field)
				{
					$class = "";
					if($field[0] == SHOGI_WHITE) { $class = "white"; }
					if($field[0] == SHOGI_BLACK) { $class = "black"; }
					$output .= "<td class=\"{$class}\">{$this->convention[$field[1]]}</td>";
				} }
				$output.= "</tr>";
			}
			$output.= "</table>";
			return $output;
		}
		public function debug($debug)
		{
			if($this->debug == true) { print("Debug: {$debug}<br />"); }			
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