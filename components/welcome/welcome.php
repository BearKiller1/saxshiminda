
<?php
    
    include_once "../../includes/Lucid.class.php";

    class Welcome extends Lucid{
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
    $welcome    = new Welcome();

    if(method_exists($welcome , $method)){
        $welcome->$method();
        $welcome->GetResult();
    }
    else{
        echo "Method Not Found";
    }

?>
