import MainFunctions from "../../index.js";

export default class Upload extends MainFunctions {
    
    constructor(){
        super(false);
        this.Main = new MainFunctions(false);
    }

    upload = (file) => {
        this.Main.Ajax({
            spUrl: "global/php/upload/upload.php",
            object: {
                method: "alert",
                data: {
                    file: file
                }
            },
            success: (response) => {
                return response;
            }
        })
    }
}

new Upload();
