
import Router from '../../global/js/Router/Router.js';
import Translator from '../../global/js/Translate/Translate.js';
import Ajax from '../../global/js/Ajax/Ajax.js';
import Listener from '../../global/js/Listener/Listener.js';

export default class Welcome {
    
    constructor(){
        this.Router = new Router();
        this.Translator = new Translator();
        this.Listener = new Listener();
        this.Ajax = new Ajax();
        
        this.Init();
        this.Handler();
    }

    Init = () => {
        
        this.Variables = {
            WelcomeText : "Welcome Wokrs !",
            name        : 'Dachi',
            age         : 19,
            number      : 5,
        }

        
        this.Translator.Init(this.Variables, "welcome");
    }
    
    Handler = () => {

        this.Listener.Init({
            Attribute   : 'id',
            ElementName : "generate",
            event       : "click",
            function : () => { 
                this.Router.Init('main');
            }
        });

        this.Listener.Init({
            Attribute   : 'id',
            ElementName : "roam",
            event       : "click",
            function : () => {
                this.Router.Init(document.getElementById('routeTo').value);
            }
        })

    }

    

}

new Welcome();
