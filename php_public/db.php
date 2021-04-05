<?php
class DataBase{
    private $host; //host
    private $user; //user
    private $pwd; //password
    private $dbname; //db name
    private $debug; //error message
    private $conn; //connection
    private $dbhalt; //handle error

    var $result; // return result
    var $num_rows; // return number of rows in result
    var $insert_id; // last insert id
    var $affected_rows; // affected rows

    function __construct($host = "127.0.0.1", $user = "mxl8591_neighborhood", $pwd = "lzl47502ABC@@3", $dbname = "mxl8591_neighborhood", $debug = false)
//    function __construct($host = "143.110.136.62", $user = "lori", $pwd = "Lori1995,.", $dbname = "neighborhood", $debug = false)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pwd = $pwd;
        $this->dbname = $dbname;
        $this->debug = $debug;
        $this->connect ();
    }

    //  connect
    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbname);
    }

    //  handle error
//    private function dbhalt($errmsg) {
//        $msg = "数据库有问题!";
//        $msg = $errmsg;
//        echo "$msg";
//        die ();
//    }

    //select
    public function execute($sql) {
        $this->result = mysqli_query($this->conn,$sql);
        if (!$this->result) {
            printf("Error: %s\n", mysqli_error($this->conn));
            exit();
        }
        return $this->result;
    }

    //get more than one record return
    public function getMultipleRecords() {
        $i = 0;
        $output = [];
        $_this = $this;
        while($row = $_this->fetchAssoc()){
            $output["data"][$i] = $row;
            $i++;
        }
        return $output;
    }

    //get number index and associate array  ["a"=>"a", "b"=>"b", 1=>"a", 2=>"b"]
    public function fetchArray() {
        return mysqli_fetch_array($this->result);
    }

    //get associate array   ["a"=>"a", "b"=>"b"] 一般用这个或者对象数组
    public function fetchAssoc() {
        return mysqli_fetch_assoc ( $this->result );
    }

    //get number index array    [1=>"a", 2=>"b"]/["a", "b"]
    public function fetchIndexArray() {
        return mysqli_fetch_row ( $this->result );
    }

    //get object array {"a": "a", "b": "b"};
    public function fetchObject() {
        return mysqli_fetch_object ( $this->result );
    }

    //return num of rows in result
    function numRows() {
        return mysqli_num_rows ( $this->result );
    }

    //delete data
    public function delete($sql) {
        $result = $this->execute ( $sql );
        $this->affected_rows = mysqli_affected_rows ( $this->conn );
//        $this->free_result ( $result );
        return $this->affected_rows;
    }

    //insert data
    public function insert($sql) {
        $this->execute ( $sql );
        $this->insert_id=mysqli_insert_id($this->conn);
//        return $this->affected_rows = mysqli_affected_rows ($this->conn);
        return $this->insert_id;
    }

    //update data
    public function update($sql) {
        $result = $this->execute ( $sql );
        $this->affected_rows = mysqli_affected_rows ($this->conn);
        return $this->affected_rows;
    }

    //close connection
    public function close() {
        mysqli_close($this->conn);
    }
}


