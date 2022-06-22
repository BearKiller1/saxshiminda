<?php
    include_once "Lucid.class.php";
    
    /**
     * @todo Checking Permissions
     */
    class Router extends Lucid{

        public function __construct(){
            $this->response = array();
            $this->request  = $_REQUEST['data'];
        }

        public function GetPage(){
            $this->page = $this->request['page'];

            $this->result['page'] = $this->GetPageUrl();
            
            if($this->request['group']){
                $this->group = $this->request['group'];
                if(file_exists("../components/".$this->group."/".$this->page."/".$this->page.".html"))
                    $this->result['page'] .= file_get_contents("../components/".$this->group."/".$this->page."/".$this->page.".html");
                else
                    $this->result['page'] .= file_get_contents("../components/error.html");
            }
            else{
                if(file_exists("../components/".$this->page."/".$this->page.".html"))
                    $this->result['page'] .= file_get_contents("../components/".$this->page."/".$this->page.".html");
                else
                    $this->result['page'] .= file_get_contents("../components/error.html");
            }

        }

        public function GetPageUrl(){

            if($this->request['group'])
                $path = "components/".$this->group."/".$this->page."/".$this->page;
            else
                $path = "components/".$this->page."/".$this->page;

            $url = '<div class="url">
                        <script type="module" src="'.$path.'.js"> var ' . $this->page . ' = new ' . $this->page .'() </script>
                        <link rel="stylesheet" href="'.$path.'.css">
                    </div>';
            return $url;
        }

        public function GetResult(){
            echo json_encode($this->result);
        }

    }

    $method = $_REQUEST["method"];
    $router = new Router();

    if(method_exists($router , $method)){
        $router->$method();
        $router->GetResult();
    }
    else{
        echo "Method Not Found";
    }
?>