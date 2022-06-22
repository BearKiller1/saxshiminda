
<?php
    
    include_once "../../includes/Lucid.class.php";

    class Testing extends Lucid{
        public $response;
        public $request;

        /**
         * This constructor Sets up response request and connection
         */
        public function __construct(){
            $this->response = array();
            $this->request  = $_REQUEST["data"];
            Parent::__construct();
        }

        public function GetRandomStuff(){
            $this->response = [
                "age" => rand(0, 100)
            ];
        }

        /**
         * This function returnt the response of this php file
         */
        public function GetResult(){
            echo json_encode($this->response);
        }

        public function __destruct(){
        }
    }

    $method     = $_REQUEST["method"];
    $testing    = new Testing();

    if(method_exists($testing , $method)){
        $testing->$method();
        $testing->GetResult();
    }
    else{
        echo "Method Not Found";
    }

?>
