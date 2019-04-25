<html>
    <head>
	
        <link href="tictactoe.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="tictactoe.js"></script>
		
		<title>Tic tac toe</title>
        
	</head>

	<body>


    <?php

        // If $_GET variable is set:
        if (isset($_GET['game']) ) {
            // Include necessary php pages
            include_once('connect.php');
            include_once('tic-tac-toe.php');

            $obj = new TicTacToe($host, $username, $password, $table);
            $obj->connect();

            $gameData = $_GET['game'];
            $created = $_GET['created'];
            $gameResult = $_GET['result'];

            // If given timestamp is not yet in the database, add results to database
            // This is to prevent the same result from being entered twice when someone refreshes the page
            if ($obj->searchTimeStamp($created)){
                $obj->updateDB($gameData, $created, $gameResult);
            }
        }    

        ?>

        <div class='playing-field'>

            <div class='square s1' id='s1' onclick='alterField(0)'></div>
            <div class='square s2' id='s2' onclick='alterField(1)'></div>
            <div class='square s3' id='s3' onclick='alterField(2)'></div>

            <div class='square s4' id='s4' onclick='alterField(3)'></div>
            <div class='square s5' id='s5' onclick='alterField(4)'></div>
            <div class='square s6' id='s6' onclick='alterField(5)'></div>

            <div class='square s7' id='s7' onclick='alterField(6)'></div>
            <div class='square s8' id='s8' onclick='alterField(7)'></div>
            <div class='square s9' id='s9' onclick='alterField(8)'></div>

        </div>
        <div class='button-container'>
            <button class='reset-button' onclick="resetGame()">Click here to reset</button>
        </div>
        <a class='results' href='/tictactoe/game-results.php'>Results</a>


        
        
    </body>


</html>


