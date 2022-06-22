


<?php

    include_once "../../includes/Lucid.class.php";

    class Main extends Lucid{

        /**
         * This constructor Sets up response request and connection
         */
        public function __construct(){
            $this->response = array();
            $this->request  = $_REQUEST["data"];
            Parent::__construct();
        }

        /**
         * This function is the main function of the class
         * @param Pagename  string
         * @param GroupName string
         * @return result (text about generation) 
         * @return status (1 - good | 2 - bad)
         */
        public function Generate(){

            if($this->request['group'] != ''){
                $path = "../".$this->request['group'];
            }
            else{
                $path = '../'.$this->request['name'];
            }

            if($this->request['group'] != "" && file_exists($path ."/". $this->request['name'])){
                $this->response['result'] = "Group Already Exists";
                $this->response['status'] = 2;
            }
            else if(file_exists($path) && $this->request['group'] == ""){
                $this->response['result'] = "Components Already Exists";
                $this->response['status'] = 2;
            }
            else{
                if($this->request['group'] != ""){
                    if(!file_exists($path)){
                        mkdir($path);
                    }
                    mkdir($path ."/". $this->request['name']);
                    $path = $path ."/". $this->request['name'];
    
                    $html   = fopen($path ."/". $this->request['name']. ".html"  ,   "w");
                    $css    = fopen($path ."/". $this->request['name']. ".css"   ,   "w");
                    $js     = fopen($path ."/". $this->request['name']. ".js"    ,   "w");
                    $php    = fopen($path ."/". $this->request['name']. ".php"   ,   "w");
                }
                else{
                    mkdir($path);
                    $html   = fopen($path ."/". $this->request['name']. ".html"  ,   "w");
                    $css    = fopen($path ."/". $this->request['name']. ".css"   ,   "w");
                    $js     = fopen($path ."/". $this->request['name']. ".js"    ,   "w");
                    $php    = fopen($path ."/". $this->request['name']. ".php"   ,   "w");
                }
    
                fwrite($html, '<section style="text-align: center;" id="'.$this->request['name'].'"> <h1>{{ WelcomeText }}</h1> </section>');
                
                CreatePHPClass($php,$this->request['name'],$this->request['group']);
                CreateJSClass($js,$this->request['name'],$this->request['group']);

                $this->response['database'] = $this->InsertIntoDatabase();
                $this->response['result']   =  "Component Created";
                $this->response['status']   = 1;
            }

        }

        public function InsertIntoDatabase(){
            Parent::RunQuery("  CREATE TABLE IF NOT EXISTS `Components` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) NOT NULL,
                                    `type` int(11) NOT NULL,
                                    `description` text NOT NULL,
                                    `permision` int(11) NOT NULL,
                                    PRIMARY KEY (`id`)
                                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

            $this->columns['name'] = $this->request['name'];
            
            if($this->request['group'] != ""){
                $this->columns['type'] = 1;
                $this->columns['description'] = 'This is in a '.$this->request['group'].' group';
            }
            else{
                $this->columns['type'] = 2;
                $this->columns['description'] = 'This is in a '.$this->request['name'].' component';
            }

            $this->columns['permision'] = 0;

            $fp = fopen('../../assets/database/data.sql', 'a');//opens file in append mode  
            // return fwrite($fp, Parent::InsertData("components",$this->columns, true));
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
    $main    = new Main();

    if(method_exists($main , $method)){
        $main->$method();
        $main->GetResult();
    }
    else{
        echo "Method Not Found";
    }

function CreatePHPClass($php,$pagename, $group){
    $class_name = $pagename;
    $class_name[0] = strtoupper($class_name[0]);

    if($group != ''){ $urls = '../../../'; }
    else{ $urls = '../../'; }

$class_string = '
<?php
    include_once "'.$urls.'includes/Lucid.class.php";

    class ' .$class_name. ' extends Lucid{
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
    $' .$pagename. '    = new ' .$class_name. '();

    if(method_exists($' .$pagename. ' , $method)){
        $' .$pagename. '->$method();
        $' .$pagename. '->GetResult();
    }
    else{
        echo "Method Not Found";
    }

?>
';
    fwrite($php, $class_string);
}

function CreateJSClass($js,$pagename,$group){
    $class_name = $pagename;
    $class_name[0] = strtoupper($class_name[0]);
    $test = `12`;
    if($group != ''){ $urls = '../../../'; }
    else{ $urls = '../../'; }

$class = '
import Router from "'.$urls.'global/js/Router/Router.js";
import Translator from "'.$urls.'global/js/Translate/Translate.js";
import Ajax from "'.$urls.'global/js/Ajax/Ajax.js";
import Listener from "'.$urls.'global/js/Listener/Listener.js";

export default class '.$class_name.' {
    
    constructor(){
        this.Router = new Router();
        this.Translator = new Translator();
        this.Listener = new Listener();

        this.Init();
        this.Handler();
    }

    Init = () => {
        this.Variables = {
            WelcomeText : "'.$class_name.' Wokrs !",
        }
        
        this.Translator.Init(this.Variables, "'.$pagename.'");
    }

    Handler = () => {

    }
}

new '.$class_name.'();
';
    fwrite($js, $class);
}
?>