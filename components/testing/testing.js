
import Router from '../../global/js/Router/Router.js';
import Translator from '../../global/js/Translate/Translate.js';
import Ajax from '../../global/js/Ajax/Ajax.js';
import Listener from '../../global/js/Listener/Listener.js';

export default class Testing {
    
    constructor(){
        this.Router = new Router();
        this.Translator = new Translator();
        this.Listener = new Listener();
        this.Ajax = new Ajax();

        this.Init();
        this.Handler();
    }

    NewData = {
        Name: "Gela",
        Surname:"gnolidze",
        Age: "21",
    }

    Init = () => {
        this.Variables = {
            WelcomeText : "Testing Wokrs !",
            Name : "Dachi",
            Surname : "Khutsishvili",
            Age : 19,
        }
        
        this.Translator.Init(this.Variables, "testing");
    }

    Handler = () => {
        this.Listener.Init({
            Attribute   : 'id',
            ElementName : "change",
            event       : "click",
            function : () => {
                this.Ajax.Init({
                    url: "testing",
                    object: {
                        method: "GetRandomStuff",
                        data: {
                            name : 12,
                        }
                    },
                    success: (response) => {
                        response = JSON.parse(response);
                        this.NewData.Age = response.age;
                        this.Translator.Rebuild(this.NewData, "testing");
                    }
                })
                this.Handler()
            }
        });
    }
}

new Testing();
