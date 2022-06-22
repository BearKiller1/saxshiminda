// import MainFunctions from "../../../index.js";

export default class Ajax{
    
    constructor(){
        // this.Main = new MainFunctions(false);
    }

    Init = (Params) =>{
        if(Params.type == undefined || Params.type == "")
            Params.type = "POST";

        if(Params.spURL != undefined)
            Params.url = Params.spURL;
        else
            if(Params.groupName != undefined)
                Params.url = "components/" +Params.groupName + "/" + + Params.url + "/" + Params.url + ".php";
            else
                Params.url = "components/" + Params.url + "/" + Params.url + ".php";

        $.ajax({
            type: Params.type,
            url: Params.url,
            data: Params.object,
            success: Params.success
        });
    }
}

new Ajax();
