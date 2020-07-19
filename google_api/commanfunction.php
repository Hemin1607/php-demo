<?php
    function createMimeMessage_($msg) {

        $nl = "\n";
        $boundary = "__ctrlq_dot_org__";
    
        $mimeBody = [
    
            "MIME-Version: 1.0",
            "To: " + encode_($msg.to.name) + "<" + $msg.to.email + ">",
            "From: " + encode_($msg.from.name) + "<" + $msg.from.email + ">",
            "Subject: " + encode_($msg.subject), // takes care of accented characters
    
            "Content-Type: multipart/alternative; boundary=" + $boundary + $nl,
            "--" + $boundary,
    
            "Content-Type: text/plain; charset=UTF-8",
            "Content-Transfer-Encoding: base64" + $nl,
            Utilities.base64Encode($msg.body.text, Utilities.Charset.UTF_8) + $nl,
            "--" + $boundary,
    
            "Content-Type: text/html; charset=UTF-8",
            "Content-Transfer-Encoding: base64" + $nl,
            Utilities.base64Encode($msg.body.html, Utilities.Charset.UTF_8) + $nl
    
        ];
    
        for ($i = 0; $i < $msg.files.length; $i++) {
    
            $attachment = [
                "--" + $boundary,
                "Content-Type: " + $msg.files[i].mimeType + '; name="' + $msg.files[$i].fileName + '"',
                'Content-Disposition: attachment; filename="' + $msg.files[$i].fileName + '"',
                "Content-Transfer-Encoding: base64" + $nl,
                $msg.files[$i].bytes
            ];
    
            $mimeBody.push($attachment.join($nl));
    
        }
    
        $mimeBody.push("--" + $boundary + "--");
    
        return $mimeBody.join($nl);
    
    }

?>