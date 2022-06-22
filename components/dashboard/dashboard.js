
import Router from "../../global/js/Router/Router.js";
import Translator from "../../global/js/Translate/Translate.js";
import Ajax from "../../global/js/Ajax/Ajax.js";
import Listener from "../../global/js/Listener/Listener.js";

export default class Dashboard {
    
    constructor(){
        this.Router = new Router();
        this.Translator = new Translator();
        this.Listener = new Listener();

        this.Init();
        this.Handler();
    }

    Init = () => {
        this.Variables = {
            WelcomeText : "Dashboard Wokrs !",
        }
        
        this.Translator.Init(this.Variables, "dashboard");
    }

    Handler = () => {

    }
}

new Dashboard();
