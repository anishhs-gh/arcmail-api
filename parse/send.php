<?php
error_reporting(0);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    $json = trim(file_get_contents('php://input'), "\xEF\xBB\xBF");
    $data = json_decode($json,true);
    
    $response = "";
    if($data['authKey'] != "") {
        $getKeys = trim(file_get_contents('randomtextdemofile8560arc22.json'), "\xEF\xBB\xBF");
        $keydata = json_decode($getKeys,true);
        
        $key = array_search($data['authKey'], array_column($keydata, 'authkey'));

        if ($key == $data['authKey']) {
            $response = "authkey verified";

            //init mail

            $sender_name = $data['fromName'];
            $sender_email = $data['fromEmail'];
            $reply_to = $data['replyTo'];
            $send_to = $data['sendTo'];
            $send_to_x = implode(",",$send_to);
            $send_bcc = $data['bcc'];
            $send_bcc_x = implode(",",$send_bcc);
            $send_cc = $data['cc'];
            $send_cc_x = implode(",",$send_cc);
            $email_subject = $data['subject'];
            $email_body = $data['message'];
            $email_attachment = $data['attachment'];
        //recipient
        $to = $send_to_x;
        //sender
        $from = $sender_email;
        $fromName = $sender_name;
        //email subject
        $subject = $email_subject; 
        //attachment file path
        $file = $email_attachment;

        //email body content
        $htmlContent = $email_body;

        //header for sender info
        $headers = "From: $fromName"." <".$from.">";
        // Cc email
        $headers .= "\nCc: ".$send_cc_x;
        // Bcc email
        $headers .= "\nBcc: ".$send_bcc_x;

        // Reply to
        $headers .= "\nReply-to: ".$reply_to;

        //boundary 
        $semi_rand = md5(time()); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

        //headers for attachment 
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

        //multipart boundary 
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

        //preparing attachment
        if(!empty($file) > 0){
            if(is_file($file)){
                $message .= "--{$mime_boundary}\n";
                $fp =    @fopen($file,"rb");
                $data =  @fread($fp,filesize($file));

                @fclose($fp);
                $data = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
                "Content-Description: ".basename($file)."\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }

        $message .= "--{$mime_boundary}--";
        $returnpath = "-f" . $from;

        //send email
        $mail = @mail($to, $subject, $message, $headers, $returnpath); 
        //email sending status
        if($mail) {
            $response = "mail sent";
        } else {
            $response = "mail sending failed";
        }

            //end
        } else {
            $response = "invalid authkey passed";
        }
    } else {
        $response = "authkey not passed";
    }
    echo $response;

    // coded by @anishh.arc find on instagram
?>