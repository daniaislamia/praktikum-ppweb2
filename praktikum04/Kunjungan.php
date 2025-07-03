<?php

class Kunjungan {
    public $id;
    public $timestamp;
    public $fullname;
    public $email;
    public $jenis_kunjungan_id;

    private static function connect(){

        $conn = mysqli_connect("localhost", "root", "", "bukutamu");

        if(!$conn){
            die("Connection failed" . mysqli_connect_error());

        }


        return $conn;
    
    }

    public  function save() 
    {
        $conn = self::connect();
        $query = "INSERT INTO kunjungan (fullname, email, jenis_kunjungan_id)
          VALUES ('" . $this->fullname . "', '" . $this->email . "', " . $this->jenis_kunjungan_id . ")";

          mysqli_query($conn, $query);
          $insert_id = mysqli_insert_id($conn);
          mysqli_close($conn);

          return $insert_id;
        

        
    }

    public static function getAll(){

        $conn = self::connect();
        $query = "SELECT * FROM kunjungan";
        // Eksekusi Query
        $result = mysqli_query($conn, $query);
        // Close Connection 
        mysqli_close($conn);


        $entries = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $entry = new Kunjungan();
            $entry->id = $row['id'];
            $entry->timestamp = $row['timestamp'];
            $entry->fullname = $row['fullname'];
            $entry->email = $row['email'];
            $entry->jenis_kunjungan_id = $row['jenis_kunjungan_id'];


            array_push($entries, $entry);

        }
        return $entries;
    }   



}