<?php
    include 'AutoLoader.php';
    
    class Lucid extends Connection {
        
        public function __construct() {
            Parent::__construct();
        }

        /**
         * Inserts data in table
         * @param  string   $table  table name
         * @param  array    $fields fields to be inserted
         * @param  bool     $callback if true returns the query
         * @return boolean  1 - success, 0 - failure
         * @author BearKiller22
         */
        public function InsertData($tableName, $request, $callback = true) {
            
            $this->request = $request;

            $val = "";
            $sql = "";

            for($i = 0; $i != COUNT($this->request); $i++){
                if($i+1 == COUNT($this->request))
                    $sql .= array_keys($this->request)[$i];
                else
                    $sql .= array_keys($this->request)[$i]. ","; 
            }


            for($i = 0; $i != COUNT($this->request); $i++){
                if($i+1 == COUNT($this->request))
                    $val .= "?";
                else
                    $val .= "?,";
            }

            $sql = "INSERT INTO  " . $tableName . " ($sql) VALUES ( $val)";

            for ($i=0; $i < COUNT($this->request); $i++) { 
                $values[] = $this->request[array_keys($this->request)[$i]];
            }
            
            return Parent::Add($sql, $values);

        }

        /**
         * @param string $sql query to be executed
         * @return array values of the ? placeholders
         * @return boolean 1 - success, 0 - failure
         */
        public function GetData($sql, $request){
            for ($i=0; $i < COUNT($request); $i++) { 
                $values[] = $request[array_keys($request)[$i]];
            }
            return Parent::Get($sql, $values);
        }

        /**
         * @param string $sql query to be executed
         */
        public function RunQuery($sql){
            return Parent::Run($sql);
        }

        /**
         * Delete Files
         * @todo Think about it man
         */
        public function DeleteDta(){

        }
    }


?>