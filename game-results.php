<html>
    <head>
	
        <link href="tictactoe.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="tictactoe.js"></script>
		
		<title>Tic tac toe</title>
        
	</head>

	<body>

    <div class='list-container'>

        <?php
            // Add necessary php files
            include_once('connect.php');
            include_once('tic-tac-toe.php');

            $obj = new TicTacToe($host, $username, $password, $table);
            $obj->connect();

            // Retrieve all games
            $result = $obj->getAllGames();

            // Create buttons for all games:
            if ($result !== false && mysqli_num_rows($result) > 0) {
                while ( $row = mysqli_fetch_assoc($result) ) {
                    $id = stripslashes($row['ID']);
                    $TicTacToeGame = stripslashes($row['game']);
                    $gameResult = stripslashes($row['result']);

                    print $id . '. <button onclick="showGame(' . $TicTacToeGame . ')">' . $TicTacToeGame . ' (' . $gameResult . ')</button> <br/> ' ;
                }
            }



        ?>

        </div>

        <div class='playing-field'>

            <div class='square s1' id='s1'></div>
            <div class='square s2' id='s2'></div>
            <div class='square s3' id='s3'></div>

            <div class='square s4' id='s4'></div>
            <div class='square s5' id='s5'></div>
            <div class='square s6' id='s6'></div>

            <div class='square s7' id='s7'></div>
            <div class='square s8' id='s8'></div>
            <div class='square s9' id='s9'></div>

        </div>
        <a class='results' href='/tictactoe/index.php'>Game page</a>

    </body>


</html>