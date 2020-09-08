# Documentation

arcmail-api is a open source api for sending emails using javascript you can send mails from localhost too without xampp or wampp server, for testing purpose you can setup "parse/send.php" file in any online server and send emails from anywhere using link to this file in "js/script.js". Will write described documentation soon... :)

*if you browse files you will not going to have any issues*

## Set path

if you have uploaded all files in a server, just set full path to "js/script.js" of "parse/send.php" on line number 21

```
    xhr.open("POST", "https://yourwebsite.com/parse/send.php");
```

## Link JavaScript File

Link "js/script.js" file wherever you want to use, be sure the path is correct otherwise it will not going to work

```
<script src='js/script.js'>
```

## Initialize Values

you have to use this code and define correct values in order to send emails, you can use it on same file from where you want to send mails. If you use this on separate ".js" file you have to link this correctly

```
// use this keys and assign custom related values
        const authKey = "auth1";
        const data = {
        "fromName" : "john doe", // from name
        "fromEmail" : "john@example.com", // from email
        "replyTo" : "john@example.com", // reply-to optional
        "sendTo" : [
            "joy@example.com",
            "jane@example.com"
        ],
        "cc" : [
            "jonah@example.com"
        ],
        "bcc" : [
            "jack@example.com"
        ],
        "subject" : "test api", // mail subject
        "message" : "simple mail request from js to php", // mail body html enabled
        "attachment" : "readme.md", // only in relative path from api server send file example, "../maildata/filename.pdf"
        
        "authKey" : authKey // your authkey
    }
```

## Call send() Function

you can use any event listener according to your need it depends how you want to use it. Here is a simple auto function

```
// use this below line to call mail function according to need currently set to call on every page reload
new Arcmail(data).send();
```

## Custom Responses

you can modify custom responses whatever you want by this function

```
// use this below code or function to handle custom response text
    function respond() {
        if(response == "mail sent") {
            console.log("Mail has been sent successfully");
        } 
    }
```

## Authentication Keys

authentication keys can be modifiable in a "parse\randomtextdemofile8560arc22.json" or can be generated from anywhere it simply a file where authkeys can be stored if you change the file name of json it will not going to work and authentication will be failed. You can set filename in "parse/send.php" on line number 10

```
$getKeys = trim(file_get_contents('randomtextdemofile8560arc22.json'), "\xEF\xBB\xBF");
```

## Message

if you stil have any issues you can raise an issue we will help and your suggestions and modifications are welcome

*[@anishh.arc](https://instagram.com/anishh.arc) - instagram*
