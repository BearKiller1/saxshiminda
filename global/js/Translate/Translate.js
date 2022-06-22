export default class Translator{
    
    constructor(){}

    Init = (data, pageName) => {
        this.OldData = data;
        var doc = document.getElementById(pageName);
    
        doc.innerHTML =  doc.innerHTML.replace(/\{\{(.*?)\}\}/g, (match, p1) => {
            var variable = data;
            p1.replace(/\s/g, '').split('.').forEach(element => {
                if(variable[element] != undefined){
                    variable = variable[element];
                }
                else{
                    if(p1 != "index")
                        variable = "{{ " + p1 + "}} not found";
                    else{
                        variable = p1;
                    }
                }
            });
            return variable;
        });
        this.Loop();
    }

    Loop = () => {
        if(document.querySelectorAll('[LCfor]')[0] != undefined){
            if(document.querySelectorAll('[LCfor]')[0].getAttribute('LCfor') != undefined){
                if(!isNaN(document.querySelectorAll('[LCfor]')[0].getAttribute('LCfor'))){
                    var loopNumber = document.querySelectorAll('[LCfor]')[0].getAttribute('LCfor');
                    if(loopNumber > 1){
                        for(var i = 0; i < loopNumber - 1; i++){
                            document.querySelectorAll('[LCfor]')[0].parentElement.append(document.querySelectorAll('[LCfor]')[0].cloneNode(true));
                            var elements = document.querySelectorAll('[LCfor]');
                        }
                        for(var i = 0; i < elements.length; i++){
                            document.querySelectorAll('[LCfor]')[i].innerHTML = document.querySelectorAll('[LCfor]')[i].innerHTML.replaceAll('index', i)
                        }
                    }
                    else if(loopNumber == 1){
                        document.querySelectorAll('[LCfor]')[0].innerHTML = document.querySelectorAll('[LCfor]')[0].innerHTML.replaceAll('index',0)
                    }
                    else if(loopNumber == 0){
                        document.querySelectorAll('[LCfor]')[0].remove();
                    }
                }
            }
        }
    }

    Rebuild = (data, pageName) => {
        var doc = document.getElementById(pageName);
        var oldData = this.OldData;
        

        $.each(oldData, function (indexInArray, valueOfElement) {
            if(data[indexInArray] != undefined){
                doc.innerHTML =  doc.innerHTML.replaceAll(valueOfElement, data[indexInArray]);
                oldData[indexInArray] = data[indexInArray];
            }
        });
        this.oldData = oldData;

    }
}

new Translator();
