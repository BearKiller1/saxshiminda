export default class Listener{
    
    constructor(){
    }

    Init = (Obj) => {
        if(Obj.Attribute == "id"){
            if(document.getElementById(Obj.ElementName) != undefined){
                document.getElementById(Obj.ElementName).addEventListener(Obj.event, Obj.function);
            }
            else{
                console.log(Obj.ElementName + " not found in listener");
            }
        }
        else if(Obj.Attribute == "class"){
            if(document.getElementsByClassName(Obj.ElementName) != undefined){
                document.getElementsByClassName(Obj.ElementName).addEventListener(Obj.event, Obj.function);
            }
            else{
                console.log(Obj.ElementName + " not found in listener");
            }
        }
    }
}

new Listener();
