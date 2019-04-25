// To determine whos turn it is
var turn = false;
// To determine if the game is tied or won
var gameWon = '';
// Abstract representation of the playing field
var fields =    ['empty', 'empty', 'empty',
                'empty','empty','empty',
                'empty','empty','empty'];
// This variable stores the course of the game
var courseOfGame = '';


function fillGame() {
    // Everytime this function is called it fills in the squares (either x's or o's) according to the 'fields' variable
    var squares = document.getElementsByClassName('square');

    for (var i = 0; i < squares.length; i++) {
        if (fields[i] == 'empty') {
            squares[i].style.background = 'none';
        } else if (fields[i] == 'x') {
            squares[i].style.background = 'url(x.png) no-repeat center center';
            squares[i].style.backgroundSize = 'cover';
        } else if (fields[i] == 'o') {
            squares[i].style.background = 'url(circle.png) no-repeat center center';
            squares[i].style.backgroundSize = 'cover';
        }
    }
    return;

}

function resetGame() {
    // Resets all the values in fields array to 'empty' and reloads the game

    for (var i = 0; i < fields.length; i++ ) {
        fields[i] = 'empty';
    }

    courseOfGame = '';
    gameWon = '';
    turn = false;

    window.location.href = '/tictactoe';

    fillGame();
}

function resetBuild() {
    // Same as above, but here the page doesn't need to be refreshed.
    for (var i = 0; i < fields.length; i++ ) {
        fields[i] = 'empty';
    }

    turn = false;
    fillGame();
}

function allFieldsSame(field1, field2, field3) {

    // Check if field1, field2 and field3 are the same and not empty
    if (field1 == field2 && field2 == field3 && field1 != 'empty') {
        return true;
    } else {
        return false;
    }
}

function checkForWin() {
    // There are only 8 lines to check, so I figured this method would do:
    if (allFieldsSame(fields[0],fields[1],fields[2]) || 
        allFieldsSame(fields[3],fields[4],fields[5]) || 
        allFieldsSame(fields[6],fields[7],fields[8]) || 
        allFieldsSame(fields[0],fields[3],fields[6]) || 
        allFieldsSame(fields[1],fields[4],fields[7]) || 
        allFieldsSame(fields[2],fields[5],fields[8]) ||  
        allFieldsSame(fields[0],fields[4],fields[8]) || 
        allFieldsSame(fields[2],fields[4],fields[6])) {
            return true;
        } else {
            return false;
        }
}

function initiateWinProtocol() {
    // Create timestamp and pass the arguments to PHP through a GET method. 
    // These variables need to be passed to PHP to store them in the database
    var created = new Date().getTime();

    window.location.href = '/tictactoe/index.php?game=' + courseOfGame + '&created=' + created + '&result=' + gameWon;
    
}

function alterField(position) {
    // If game is not yet won or tied, change field to x or o depending on who's turn it is.
    // Also store the number of the square that is being filled in 'courseOfGame'
    if (!gameWon) {

        if (fields[position] == 'empty') {
            if (turn) {
                fields[position] = 'x';
            } else {
                fields[position] = 'o';
            }

            turn = !turn;
            courseOfGame = courseOfGame + position;

            fillGame();

            // If game is won or tied, exit game.
            if (checkForWin()) {
                gameWon = 'won';
                initiateWinProtocol();
            } else if (!checkForWin() && courseOfGame.length == 9) {
                gameWon = 'tie';
                initiateWinProtocol();
            }
            
        } else {
            alert('This field is already taken');
        }
    } else {
        alert('What are you doing? Game is already won. Press button to start over.');
    }
    

}


function showGame(tictactoegame) {

    // This function is to show games played.
    resetBuild();

    tictactoegame = String(tictactoegame);
    for (var i = 0; i < tictactoegame.length; i++) {
        if (!turn) {
            fields[tictactoegame.charAt(i)] = 'o';
        } else {
            fields[tictactoegame.charAt(i)] = 'x';
        }
        fillGame();
        turn = !turn;
      }


}
