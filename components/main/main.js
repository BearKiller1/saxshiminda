import Ajax from "../../global/js/Ajax/Ajax.js";
import Router from "../../global/js/Router/Router.js";

export default class Generator {
    constructor(){
        this.Ajax = new Ajax();
        this.Router = new Router();
        this.url = "main";
        document.getElementById('create').addEventListener('click', this.Generate);
    }

    Generate = () => {
        var pageName    = document.getElementById('component').value;
        var group       = document.getElementById('group').value;
        if(pageName != ''){
            this.Ajax.Init({
                url: this.url,
                object: {
                    method:"Generate",
                    data:{
                        name    : pageName,
                        group   : group
                    }
                },
                success: (response) => {
                    response = JSON.parse(response);
                    this.Router.Init(pageName, group);
                }
            })
        }
        else{
            alert("Type Component Name");
        }
    }
}

new Generator();