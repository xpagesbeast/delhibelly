<?php # Script 8.2 - mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL 
// and selects the database.

// Set the database access information as constants:
DEFINE ('DB_USER', "cs319_1_spr2018_group6");
DEFINE ('DB_PASSWORD', "cs319$!w@Jh");
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', "cs319_1_spr2018_group6_db");

// Make the connection:
$dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

class DBController {

    /*Norwoodpark hosting conenction*/
    /*
    private $host = "localhost";
    private $user = "delhibel_delhi";
    private $password = "T0day!";
    private $database = "delhibel_delhibelly";
*/

    /*Using a XAMPP - everything installed on your oomputer*/
    /*
   private $user = "root";
   private $password = "";
   private $database = "delhibelly";
    */

    /*NEIU Server*/

    private $host = "localhost";
    private $user = "cs319_1_spr2018_group6";
    private $password = "cs319$!w@Jh";
    private $database = "cs319_1_spr2018_group6_db";


    /* DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'delhibelly');
    */

    /*Good for all types of connections*/
    private $conn;
    private $db;


    function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }
/*
    public static function getConnection()
    {
        if (empty($this->conn)) {
            new Database();
        }
    }
*/
    function getDBResult($query, $params = array())
    {
        $sql_statement = $this->conn->prepare($query);
        if (! empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();
        $result = $sql_statement->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (! empty($resultset)) {
            return $resultset;
        }
    }

    function insertDB($query, $params = array())
    {
        $sql_statement = $this->conn->prepare($query);
        if (! empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();

        $id = mysqli_insert_id ( $this->conn );
        return $id;
    }

    function updateDB($query, $params = array())
    {
        $sql_statement = $this->conn->prepare($query);
        if (! empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();
    }

    function bindParams($sql_statement, $params)
    {
        $param_type = "";
        foreach ($params as $query_param) {
            $param_type .= $query_param["param_type"];
        }

        $bind_params[] = & $param_type;
        foreach ($params as $k => $query_param) {
            $bind_params[] = & $params[$k]["param_value"];
        }

        call_user_func_array(array(
            $sql_statement,
            'bind_param'
        ), $bind_params);
    }

}

?>