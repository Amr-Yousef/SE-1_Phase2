<?php

class DBController
{

    public $dbHost = "localhost";
    public $dbUser = "root";
    public $dbPassword = "";
    public $dbName = "cc fraud detection";
    public $connection;

    public function openConnection()
    {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->connection->connect_error) {
            echo " Error in Connection : " . $this->connection->connect_error;
            return false;
        } else {
            return true;
        }
    }

    public function closeConnection()
    {
        if ($this->connection) {
            //$this->connection->close();
        } else {
            echo "Connection is not opened";
        }
    }

    public function select($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function selectAll($table, $key, $value)
    {
        $qry = 'SELECT * FROM '.$table.' WHERE '.$key.' = '.$value.'';
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
            return $resultset;
        }
    }

    public function insert($qry)
    {
        $result = $this->connection->query($qry);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $this->connection->insert_id;
        }
    }

    public function delete($query)
    {
        $result = $this->connection->query($query);
        if (!$result) {
            echo "Error : " . mysqli_error($this->connection);
            return false;
        } else {
            return $result;
        }
    }
}
