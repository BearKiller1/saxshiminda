<?php
    
    include_once "../../../includes/Lucid.class.php";

    class Upload extends Lucid{
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

        public function UploadImage(){
            $this->file = $_FILES["file"];

            $this->file_name    = $this->file["name"];
            $this->file_size    = $this->file["size"];
            $this->file_tmp     = $this->file["tmp_name"];
            $this->file_type    = $this->file["type"];
            $this->file_ext     = strtolower(end(explode(".", $this->file_name)));

            /**
             * If user sent different URL
             */
            if($this->request['path'])
                $this->path = $this->request['path'];
            else
                $this->path = "../../../assets/uploads/";

            /**
             * If user sent an extension
             */
            if($this->request['ext'])
                $this->ext = $this->request['ext'];
            else
                $this->ext = ["jpg", "jpeg", "png", "gif"];
            
            /**
             * If user sent a size
             */
            if($this->request['size'])
                $this->size = $this->request['size'];
            else
                $this->size = 5000000;


            /**
             * File Validation
             */
            $this->permission = false;

            if(in_array($this->file_ext, $this->ext)){
                $this->permission = true;
            }
            else{
                $this->permission = false;
                $this->response['message'] = "Invalid file type";
            }

            if($this->file_size <= $this->size){
                $this->permission = true;
            }
            else{
                $this->permission = false;
                $this->response['message'] = "File size is too large";
            }

            if($this->permission){
                $this->file_name = uniqid("", true).".".$this->file_ext;
                $this->file_path = $this->path.$this->file_name;
                if(move_uploaded_file($this->file_tmp, $this->file_path)){
                    $this->response['status'] = true;
                    $this->response['message'] = "File uploaded successfully";
                    $this->response['file_path'] = $this->file_path;
                }
                else{
                    $this->response['status'] = false;
                    $this->response['message'] = "Some error occurred while uploading file";
                }
            }
            else{
                $this->response['status'] = false;
            }
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
    $upload    = new Upload();

    if(method_exists($upload , $method)){
        $upload->$method();
        $upload->GetResult();
    }
    else{
        echo "Method Not Found";
    }

?>
