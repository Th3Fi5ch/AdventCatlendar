<?php
include 'src/Advent.php';
$advent = new Advent( 'participants.json' );
?>

<html>
<head>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
		}

		body {
			background: #6b92b9;
			text-align: center;
		}

		input, span {
			background-color: white;
			border: 1px solid black;
			border-radius: 10px;
			padding: 5px;
		}

		span {
			font-style: oblique;
		}

		canvas {
			display: block;
			position: fixed;
			top: 0;
			left: 0;
			z-index: -5;
		}

		img {
			z-index: -16;
		}
	</style>
	<script src="js/snow.js" type="text/javascript" language="JavaScript"></script>
</head>
<body>
<canvas id="canvas"></canvas>
<br/>

<h2>WMDE SW Advent Catlendar</h2><br/><br/>

<form method="post">
	<?php
	if ( isset( $_POST['confirmWinner'] ) && isset( $_POST['winnerName'] ) ) {
		try {
			$advent->confirmWinner( $_POST['winnerName'] );
			print '<span>Christmas cat says: "You\'re welcome!"</span><br/>';
		} catch ( Exception $e ) {
			print '<span>Christmas cat says: "' . $e->getMessage() . '"</span><br/>';
		}
	} elseif ( isset( $_POST['getWinner'] ) ) {
		$winnerName = $advent->getWinner();

		print '<span>Christmas cat says: "' . $winnerName . '"!</span><br/><br/>';
		print '<input type="hidden" name="winnerName" value="' . $winnerName . '" />';
		print '<input type="submit" name="confirmWinner" value="Thanks oh great Christmas cat!" /><br/><br/>';
		print '<input type="submit" name="getWinner" value="Oh holy Christmas cat, ' . $winnerName . ' is not here today! What shall we do?" />';
	} else {
		print '<h3>click wisely</h3>';
		print '<input type="submit" name="getWinner" value="Hey Christmas cat! Who gets the calendar today?" />';
	}
	?><br/><br/>

	<img style="height:70%; margin: auto"
		 src="//upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Peek-a-boo_cat_at_Christmas.JPG/640px-Peek-a-boo_cat_at_Christmas.JPG"/><br/>
	<small>
		<a href="https://commons.wikimedia.org/wiki/User:Matthew_Paul_Argall">Matthew Paul Argall</a>,
		<a href="https://commons.wikimedia.org/wiki/File:Peek-a-boo_cat_at_Christmas.JPG">„Peek-a-boo cat at
			Christmas“</a>,
		<a href="http://creativecommons.org/licenses/by-sa/3.0/legalcode/">CC BY-SA 3.0</a>
	</small>

</form>
</body>
</html>

