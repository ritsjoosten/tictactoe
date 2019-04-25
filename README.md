# Explanation #

If you want to test this on your own, you need to change the phpmyadmin login credentials in the connect.php file. You can also test it on www.ritsjoosten.nl/tictactoe (not all the games in the game-result page are correct regarding 'win' or 'tie').

There are two pages: _index.php_ and _game-results.php_. The index page allows two players to play tic-tac-toe, the game-results page allows users to review the results of previous games. 

To store the data of a javascript based game in a mysql database I had to send the data from Javascript into PHP. The way I did this was by using GET methods. I used Javascript to keep track of the game and when the game is finished I created a window.href back to the index page along with some GET variables.  Then the PHP index page would use those varibales to create a SQL query and connect to the database to insert this data.

One of the things I had to decide on was how to store the course of the game. The way I did this was by appending a string with the field that was filled next. So if the first turn a symbol is put on the **third** field of the board, and the second turn a symbol (either x or o) is put on the **fifth** field, the string so far would be **'35'**. This way the entire game could be replayed by going through the string character by character.
