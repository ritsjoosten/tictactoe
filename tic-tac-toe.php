<?php

class TicTacToe {

    protected $host;
	protected $username;
	protected $password;
	protected $table;
    var $connection;
    
    // The constructor of the class: defines the data necessary to connect:
  	public function __construct($HostName, $UserName, $Password, $DbName){
		$this->host = $HostName;
		$this->username = $UserName;
		$this->password = $Password;
		$this->table = $DbName;
    }
    
    public function connect() {

        // Assigns the variable 'connection' the connection:
        $this->connection = mysqli_connect($this->host,$this->username,$this->password,$this->table) or die("Could not connect. " . mysqli_error());

        // Run function 'buildDB' :
        return $this->buildDB();
    }

    public function updateDB($gameData, $created, $gameResult) {
        // Insert game data into database
        $query = "INSERT INTO tictactoe (ID, game, created, result) VALUES (NULL, $gameData, $created, '$gameResult')";
        mysqli_query($this->connection, $query);
    }

    public function searchTimeStamp($created) {
        $query = "SELECT * FROM tictactoe WHERE created = $created";
        $result = mysqli_query($this->connection, $query);

        if (mysqli_num_rows($result) > 0) {
            return false;
        } else return true;
    }

    public function getAllGames() {
        $query = "SELECT * FROM tictactoe WHERE 1";
        $result = mysqli_query($this->connection, $query);

        return $result;
    }

    private function buildDB() {

        // Create table in database if it doesn't already exist:
        $sql = "CREATE TABLE IF NOT EXISTS tictactoe (
                    ID int NOT NULL AUTO_INCREMENT,
                    game VARCHAR(9),
                    created VARCHAR(100),
                    result ENUM('won','tie'),
                    PRIMARY KEY (ID)
                )" ;
          $temp = mysqli_query($this->connection, $sql);
          
          if (!$temp){
             echo "TABLE NOT CREATED" . mysqli_error($this->connection);
          }
    
        return $temp;
    }

}

?>