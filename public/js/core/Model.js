export class Model{
    //get
    async getData(url){
        const response = await fetch(url);
        return  response.json();
    }
    //post
}

export const WEBROOT="http://localhost/php/public/index.php"