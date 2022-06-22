
import Router from './global/js/Router/Router.js';
export default class MainFunctions {
    constructor(Move){
        this.Router = new Router();
        this.MainPage  = "welcome";
        this.MainGroup = "";
        if(Move){
            
            if(localStorage.getItem("LastPage") != undefined){
                this.MainPage = localStorage.getItem("LastPage");
            }
            else if(localStorage.getItem("LastGroup") != undefined){
                this.MainGroup = localStorage.getItem("LastGroup");
            }

            this.Router.Init(this.MainPage, this.MainGroup);
        }
    }
}

new MainFunctions(true);