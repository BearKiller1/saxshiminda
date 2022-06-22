import Ajax  from "../Ajax/Ajax.js";

export default class Router{
    
    constructor(){
        this.Ajax = new Ajax();
    }

    Init = (Page, Group = '') => {
        this.Ajax.Init({
            spURL: 'includes/Router.class.php',
            object: {
                method: "GetPage",
                data: {
                    page: Page,
                    group: Group
                }
            },
            success: (response) => {
                window.localStorage.setItem('LastPage',Page);
                response = JSON.parse(response);
                document.title = Page;
                $("#content").html(response.page);
            }
        })
    }
}

new Router();
