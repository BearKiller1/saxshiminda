<?php
    // $servername = "bpsin91g95fditjmzhzw-mysql.services.clever-cloud.com";
    // $username = "uditv2kgxca2jstv";
    // $password = "sjanM2u8FHVdfmd6McZo";
    // $dbname = "bpsin91g95fditjmzhzw";


    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "lucid";
    
    // $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $conn = new mysqli($servername, $username, $password, $dbname);

    class Connection{
    
        public function __construct(){
            $this->data = '';
            
            $this->servername = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname = "lucid";
            
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        }

        public function Add($sql, $values, $callback = true){
            
            try {
                $stms = $this->conn->prepare($sql);
                $stms->execute($values);

                if($callback)
                    $this->data = $this->conn->lastInsertId();
                else
                    $this->data = 1;

                return $this->data;
            } catch (Exception $e) {
                $this->data = $e;
                throw $e;
            } finally{
                return $this->data;
            }

        }

        public function Get($sql, $request){

            try {
                $stms = $this->conn->prepare($sql);
                $stms->execute($request);
                $this->data = $stms->fetchAll(PDO::FETCH_ASSOC);
            } catch (\Throwable $th) {
                $this->data = 0;
                throw $th;
            } finally {
                return $this->data;
            }
        }

        public function Run($sql){
            try {
                $stms = $this->conn->prepare($sql);
                $stms->execute();
                $this->data = $stms->fetchAll(PDO::FETCH_ASSOC);
            } catch (\Throwable $th) {
                $this->data = 0;
                throw $th;
            } finally {
                return $this->data;
            }
        }

    }

?>