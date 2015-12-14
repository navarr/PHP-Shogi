<?php
    require_once 'Shogi.php';
    $shogi = new Shogi();
//	$shogi->debug = true;
//	$shogi->ignore_turns = true;
    $shogi->fill_in_board_blanks();

        $tests = [];
    $tests[] = 'L,7,g,7,f'; // 1
    $tests[] = 'L,3,c,3,d';
    $tests[] = 'L,2,h,6,h'; // 2
    $tests[] = 'L,8,c,8,d';
    $tests[] = 'L,6,g,6,f'; // 3
    $tests[] = 'L,7,a,6,b';
    $tests[] = 'L,5,i,4,h'; // 4
    $tests[] = 'L,5,c,5,d';
    $tests[] = 'L,3,i,3,h'; // 5
    $tests[] = 'L,5,a,4,b';
    $tests[] = 'L,4,h,3,i'; // 6
    $tests[] = 'L,4,b,3,b';
    $tests[] = 'L,6,i,5,h'; // 7
    $tests[] = 'L,6,a,5,b';
    $tests[] = 'L,4,g,4,f'; // 8
    $tests[] = 'L,1,c,1,d';
    $tests[] = 'L,1,g,1,f'; // 9
    $tests[] = 'L,3,a,4,b';
    $tests[] = 'L,7,i,7,h'; // 10
    $tests[] = 'L,8,d,8,e';
    $tests[] = 'L,8,h,7,g'; // 11
    $tests[] = 'L,4,b,5,c';
    $tests[] = 'L,3,i,2,h'; // 12
    $tests[] = 'L,7,c,7,d';
    $tests[] = 'L,5,g,5,f'; // 13
    $tests[] = 'L,4,a,4,b';
    $tests[] = 'L,7,h,6,g'; // 14
    $tests[] = 'L,5,c,6,d';
    $tests[] = 'L,6,h,7,h'; // 15
    $tests[] = 'L,7,d,7,e';
    $tests[] = 'L,9,i,9,h'; // 16
    $tests[] = 'L,7,e,7,f';
    $tests[] = 'L,6,g,7,f'; // 17
    $tests[] = 'L,8,b,7,b';
    $tests[] = 'L,6,f,6,e'; // 18
    $tests[] = 'L,2,b,7,g,1';
    $tests[] = 'L,7,h,7,g'; // 19
    $tests[] = 'L,6,d,5,c';
    $tests[] = 'L,7,f,6,g'; // 20
    $tests[] = 'L,7,b,8,b';
    $tests[] = 'L,4,f,4,e'; // 21
    $tests[] = 'L,8,e,8,f';
    $tests[] = 'L,8,g,8,f'; // 22
    $tests[] = 'L,8,b,8,f';
    $tests[] = 'L,D,4096,8,g'; // 23
    $tests[] = 'L,8,f,8,c';
    $tests[] = 'L,D,8,4,f'; // 24
    $tests[] = 'L,D,4096,7,c';
    $tests[] = 'L,D,4096,7,d'; // 25
    $tests[] = 'L,D,8,9,i';
    $tests[] = 'L,6,g,7,h'; // 26
    $tests[] = 'L,9,i,7,g,1';
    $tests[] = 'L,8,i,7,g'; // 27
    $tests[] = 'L,D,2,8,h';
    $tests[] = 'L,D,8,6,a'; // 28
    $tests[] = 'L,8,c,8,d';
    $tests[] = 'L,6,a,5,b,1'; // 29
    $tests[] = 'L,8,h,7,h,1';
    $tests[] = 'L,5,b,4,b'; // 30
    $tests[] = 'L,5,c,4,b';
    $tests[] = 'L,D,32,8,e'; // 31
    $tests[] = 'L,8,d,8,b';
    $tests[] = 'L,7,d,7,c,1'; // 32
    $tests[] = 'L,8,a,7,c';
    $tests[] = 'L,D,4096,7,d'; // 33
    $tests[] = 'L,7,c,8,e';
    $tests[] = 'L,4,f,8,b,1'; // 34
    $tests[] = 'L,8,e,7,g,1';
    $tests[] = 'L,7,d,7,c,1'; // 35
    $tests[] = 'L,6,b,5,a';
    $tests[] = 'L,7,c,6,c'; // 36
    $tests[] = 'L,D,4096,6,b';
    $tests[] = 'L,6,c,7,b'; // 37
    $tests[] = 'L,D,8,9,d';
    $tests[] = 'L,7,b,6,a'; // 38
    $tests[] = 'L,9,d,6,a';
    $tests[] = 'L,D,2,7,a'; // 39
    $tests[] = 'L,6,a,9,d';
    $tests[] = 'L,8,b,6,d'; // 40
    $tests[] = 'L,D,32,5,b';
    $tests[] = 'L,4,e,4,d'; // 41
    $tests[] = 'L,D,256,3,a';
    $tests[] = 'L,6,d,5,d'; // 42
    $tests[] = 'L,D,64,5,c';
    $tests[] = 'L,5,d,5,e'; // 43
    $tests[] = 'L,5,c,4,d';
    $tests[] = 'L,5,e,7,g'; // 44
    $tests[] = 'L,7,h,5,h';
    $tests[] = 'L,4,i,5,h'; // 45
    $tests[] = 'L,9,d,5,h,1';
    $tests[] = 'L,D,32,4,i'; // 46
    $tests[] = 'L,5,h,5,g';
    $tests[] = 'L,7,a,9,a,1'; // 47
    $tests[] = 'L,1,d,1,e';
    $tests[] = 'L,1,f,1,e'; // 48
    $tests[] = 'L,D,4096,1,g';
    $tests[] = 'L,1,i,1,g'; // 49
    $tests[] = 'L,2,a,3,c';
    $tests[] = 'L,2,g,2,f'; // 50
    $tests[] = 'L,4,d,3,e';
    $tests[] = 'L,D,256,4,e'; // 51
    $tests[] = 'L,3,e,2,f';
    $tests[] = 'L,4,e,3,c,1'; // 52
    $tests[] = 'L,4,b,3,c';
    $tests[] = 'L,D,1024,2,g'; // 53
    $tests[] = 'L,2,f,1,g,1';
    $tests[] = 'L,2,h,1,g'; // 54
    $tests[] = 'L,1,a,1,e';
    $tests[] = 'L,D,4096,1,f'; // 55
    $tests[] = 'L,1,e,1,f';
    $tests[] = 'L,1,g,1,f'; // 56
    $tests[] = 'L,D,4096,1,e';
    $tests[] = 'L,1,f,1,e'; // 57
    $tests[] = 'L,D,4096,1,d';
    function show_table($shogi)
    {
        $classes = 
            [
                SHOGI_OUSHOU   => 'shogi_ou',
                SHOGI_HISHA    => 'shogi_hisha',
                SHOGI_RYUOU    => 'shogi_ryuou',
                SHOGI_KAKUGYOU => 'shogi_kakugyou',
                SHOGI_RYUUMA   => 'shogi_ryuuma',
                SHOGI_KINSHOU  => 'shogi_kinshou',
                SHOGI_GINSHOU  => 'shogi_ginshou',
                SHOGI_NARIGIN  => 'shogi_narigin',
                SHOGI_KEIMA    => 'shogi_keima',
                SHOGI_NARIKEI  => 'shogi_narikei',
                SHOGI_KYOUSHA  => 'shogi_kyousha',
                SHOGI_NARIKYOU => 'shogi_narikyou',
                SHOGI_FUHYOU   => 'shogi_fuhyou',
                SHOGI_TOKIN    => 'shogi_tokin',
            ];
        $shogi->fill_in_board_blanks();
        $output = "<table class='shogi_table shogi_black'>";
        $output .= '<tr><th></th>';
        for ($i = 0;$i < 9;$i++) {
            $output .= "<th><abbr title=\"{$i}\">".$shogi->machine_to_human($i, 'x').'</abbr></th>';
        }
        $output .= '<th></th></tr>';
        foreach ($shogi->board as $a => $row) {
            $output .= '<tr>';
            $output .= "<th><abbr title=\"{$a}\">".$shogi->machine_to_human($a, 'y').'</abbr></th>';
            if ($a == 0 || $a == 10) {
                $class = '';
                if ($a == 0) {
                    $class = 'white';
                }
                if ($a == 10) {
                    $class = 'black';
                }
                $output .= "<td colspan=\"9\" class=\"{$class}\">";
                foreach ($row as $b => $field) {
                    $row[$b] = "<div class=\"shogi_{$class} {$classes[$field[1]]}\" title=\"{$shogi->convention[$field[1]]}\"></div>";
                }
                $output .= implode(' ', $row);
                $output .= '</td>';
            } else {
                foreach ($row as $b => $field) {
                    $class = '';
                    if ($field[0] == SHOGI_WHITE) {
                        $class = 'white';
                    }
                    if ($field[0] == SHOGI_BLACK) {
                        $class = 'black';
                    }
                    $output .= "<td class=\"{$class} shogi_{$class} {$classes[$field[1]]}\" title=\"{$shogi->convention[$field[1]]}\">&nbsp;</td>";
                }
            }
            $output .= "<th><abbr title=\"{$a}\">".$shogi->machine_to_human($a, 'y').'</abbr></th>';
            $output .= '</tr>';
        }
        $output .= '<tr><th></th>';
        for ($i = 0;$i < 9;$i++) {
            $output .= "<th><abbr title=\"{$i}\">".$shogi->machine_to_human($i, 'x').'</abbr></th>';
        }
        $output .= '<th></th></tr>';
        $output .= '</table>';

        return $output;
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>class Shogi; Test Suite</title>
		<!-- <link rel="stylesheet" href="http://facebook.koneko-chan.net/shogi/css/board.css" type="text/css" /> -->
		<link rel="stylesheet" href="devset.css" type="text/css" />
		<style type="text/css">
		        .shogi_table { border-collapse: collapse;background-image:url('http://facebook.koneko-chan.net/shogi/img/woodbg.png');margin: 0 auto; }
		        .shogi_table td,
		        .shogi_table th
		        {
		                width: 50px;
		                height: 50px;
		                padding: 0px !important;
		                border: 1px solid black;
		                text-align: center;
		        }
			.shogi_table td div
			{
				width: 50px; height: 50px; display: inline-block; background-repeat: no-repeat; background-position: 50% 50%;
			}
		        .shogi_white { color: #FFFFFF; } .shogi_black { color: #000000; }
		      /*  .shogi_table td:hover { border:1px solid yellow; } */
		        .shogi_table th { background-color: #6d84b4;color: white;width:20px;height:20px; }
		        .results { border-collapse: collapse;min-width:50%;width:100%; }
		        .results td,
		        .results th
		        {
		                padding: 3px;
		                border: 1px solid black;
		                content:" ";
		        }
		        div.left { float: left; }
		        .center { text-align: center; }
		        .pass { background-color: #00FF00; } .fail { background-color: #FF0000; }
		</style>
		<style>
			td.black { color: black; }
			td.white { color: white; }
		</style>
	</head>
	<body>
		<h1>Shogi Test Suite</h1>
		<tt>Working: Pawns, Bishops, Rooks</tt><br />
<?php
    if (isset($_GET['test'])) {
        $get = intval($_GET['test']);
    } else {
        $get = 0;
    }
?>
<a href="./test.php?test=1">First Test</a> &middot;
<?php if ($get - 1 > 0) {
    ?><a href="./test.php?test=<?= $get - 1 ?>">Previous Test</a> &middot; <?php 
} ?>
<?php if ($get < count($tests)) {
    ?><a href="./test.php?test=<?= $get + 1 ?>">Next Test</a> &middot; <?php 
} ?>
<?php if ($get != 0) {
    ?><a href="./test.php?test=0">All Tests</a><?php 
} else {
    ?>All Tests<?php 
} ?>
<br /><br />
<table class="results" summary="">
	<tr><th>Test #</th><th>Description</th><!-- <th>Turn</th> --><th>Type</th><th>Result</th><th>Log</th></tr>
<?php
    if ($get == 0) {
        $get = count($tests);
    }
    foreach ($tests as $k => $v) {
        if ($k < $get) {
            $args = explode(',', $v);
            if ($args[1] == 'D') {
                $piece = [0 => 0, 1 => $args[2]];
                $bool = $shogi->drop($args[2], $args[3], $args[4], true);
                $desc = $shogi->convention[$piece[1]].'*'.$args[3].$args[4];
            } else {
                $piece = $shogi->get_place($args[1], $args[2]);
                if ($args[5] == 1) {
                    $promote = true;
                } else {
                    $promote = false;
                }
                $bool = $shogi->move($args[1], $args[2], $args[3], $args[4], true, $promote);
                $desc = $shogi->convention[$piece[1]].$args[1].$args[2].'-'.$args[3].$args[4];
            }
            if (($args[0] == 'L' && $bool == true) || ($args[0] == 'I' && $bool == false)) {
                $class = 'pass';
            }
            if (($args[0] == 'L' && $bool == false) || ($args[0] == 'I' && $bool == true)) {
                $class = 'fail';
            }
            ?>
	<tr>
		<th><?= $k + 1 ?></th>
		<td><?= $desc ?></td>
		<!-- <td><?= ($shogi->turn == SHOGI_BLACK) ? 'White' : 'Black' ?></td> -->
		<td class="<?= ($args[0] == 'L') ? 'pass' : 'fail' ?>"><?= ($args[0] == 'L') ? 'Legal' : 'Illegal' ?></td>
		<td class="<?= $class ?>"><?= $class ?></td>
		<td><?= $shogi->log[count($shogi->log) - 1] ?></td>
	</tr>
<?php

        }
    }
?>
	<caption style="position:relative;">
		<?= show_table($shogi); ?><br />
	</caption>
</table>
<tt>* In all instances, Pass means the code worked properly, not that the ove was proper.</tt><br />
<a onclick="document.getElementById('boardarray').style.display = 'block';return false;" href="">Display Board</a>
<pre style="display:none;" id="boardarray"><?php print_r($shogi->board); // */ ?></pre>
</body></html>
