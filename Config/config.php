<?php

class Config
{
    public $HOST = "localhost";
    public $USERNAME = "root";
    public $PASSWORD = "";
    public $DB_NAME = "library";
    public $table_name = "librarytable";

    public $conn;
    public function connect()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
    }

    public function insert_record($book_name, $author_name, $price, $year, $language, $image)
    {
        $this->connect();
        $query = "INSERT INTO $this->table_name (book_name,author_name,price,year,language,image)VALUES('$book_name', '$author_name', $price, $year,'$language','$image');";

        $res = mysqli_query($this->conn, $query);

        return $res;
    }
    public function fetch_record()
    {
        $this->connect();
        $query = "SELECT * FROM $this->table_name;";

        $res = mysqli_query($this->conn, $query);

        return $res;
    }
    public function fetch_single_record($id)
    {
        $this->connect();
        $query = "SELECT * FROM $this->table_name WHERE id=$id;";

        $res = mysqli_query($this->conn, $query);
        return $res;
    }

    public function delete($id)
    {
        $this->connect();
        $fetched_res = $this->fetch_single_record($id);
        $record      = mysqli_fetch_array($fetched_res);
        if ($record) {
            $filename = "../photos/store/" . $record['image'];

            unlink($filename);
            $query = "DELETE FROM $this->table_name WHERE id=$id;";

            $res = mysqli_query($this->conn, $query);

            return $res;
        } else {
            false;
        }
    }

    public function update($id, $book_name, $author_name, $price, $year, $language, $image)
    {
        $this->connect();
        $fetched_res = $this->fetch_single_record($id);
        $record      = mysqli_fetch_array($fetched_res);
        if ($record) {

            $filename = "../photos/store/" . $record['image'];

            unlink($filename);


            $query = "UPDATE $this->table_name SET book_name='$book_name',author_name='$author_name',price=$price,year=$year,language='$language',image='$image' WHERE id=$id;";

            $res = mysqli_query($this->conn, $query);

            return $res;
        } else {
            return false;
        }
    }
}
