var response = null;
class Arcmail {
    constructor(arcdata) {
        this.getarcdata = arcdata;
    }
    send = () => {

        var jsondata = JSON.stringify(this.getarcdata);

        var xhr = new XMLHttpRequest();
        // xhr.withCredentials = true;

        xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            response = this.responseText;
            console.log(response);
             respond();
        }
        });

        xhr.open("POST", "https://yourwebsite.com/parse/send.php");
        xhr.setRequestHeader("content-type", "application/json");
        xhr.setRequestHeader("cache-control", "no-cache");

        xhr.send(jsondata);
    }
}

// coded by @anishh.arc find on instagram