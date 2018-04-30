<?php
class DBController {

    /*Norwoodpark hosting conenction*/
    private $host = "localhost";
    private $user = "delhibel_delhi";
    private $password = "T0day!";
    private $database = "delhibel_delhibelly";


    /*Using a XAMPP - everything installed on your oomputer*/
     /*
    private $user = "root";
    private $password = "";
    private $database = "delhibelly";
     */

    /*NEIU Server*/
    /*
   private $user = "cs319_1_spr2018_group6";
    private $password = "cs319$!w@Jh";
    private $database = "cs319_1_spr2018_group6_db";
 */

     /* DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'delhibelly');
     */

    /*Good for all types of connections*/
    private $conn;
    private $db;


    function close(){
        $this->conn->close();


        $this->conn = null;
        $this->db = null;
    }

	function __construct() {
		$this->conn = $this->connectDB();
		$this->db = $this->connectPDO();
	}

	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}

	function connectPDO(){
        try{

            $dbh = new PDO('mysql:host='.$this->getHost().';dbname='.$this->database, $this->user,$this->password,array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT => false,PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8mb4'));
        }catch(PDOException $ex){
            file_put_contents('/tmp/PDOErrors.txt', $ex->getMessage(), FILE_APPEND);
            echo $ex->getMessage();
        }
        return $dbh;
    }

    function getPDOHandle(){
	    return $this->db;
    }

    function getHost(){
	    return $this->host;
    }

}
?>