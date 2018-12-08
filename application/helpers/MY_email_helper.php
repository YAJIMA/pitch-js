<?php
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-12-02
 * Time: 17:08
 */
if ( ! function_exists('HBsendMail'))
{
    function HBsendMail($to, $subject, $body, $from_email, $from_name, $from_enc="UTF-8", $files=NULL, $reply_email=NULL, $reply_name=NULL){
        mb_language("ja");
        mb_internal_encoding($from_enc);
        $result = false;

        /* Mail, headers */
        $headers  = "MIME-Version: 1.0 \r\n" ;

        /* Mail, body */
        $body = mb_convert_encoding($body, "ISO-2022-JP", $from_enc);

        /* Mail, optional paramiters. */
        $sendmail_params  = "-f$from_email";

        /* Mail, subject */
        $subject = mb_convert_encoding($subject, "ISO-2022-JP", $from_enc);
        $subject = "=?iso-2022-jp?B?" . base64_encode($subject) . "?=";

        /* Ataachment */
        if(isset($files) && is_array($files)){
            // boundary
            $semi_rand = md5(time());
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
            // headers for attachment
            $headers .= "Content-Type: multipart/mixed;\r\n" . " boundary=\"{$mime_boundary}\"\r\n";
            // multipart boundary
            $body = "--{$mime_boundary}\r\n" . "Content-Type: text/plain;charset=\"ISO-2022-JP\"\r\n" .
                "Content-Transfer-Encoding: 7bit\r\n\r\n" . $body . "\r\n\r\n";
            // preparing attachments
            for($i=0;$i<count($files);$i++){
                if(is_file($files[$i])){
                    $body .= "--{$mime_boundary}\r\n";
                    $fp = @fopen($files[$i],"rb");
                    $data = @fread($fp,filesize($files[$i]));
                    @fclose($fp);
                    $data = chunk_split(base64_encode($data));
                    $body .= "Content-Type: application/octet-stream; name=\"".basename($files[$i])."\"\r\n" .
                        "Content-Description: ".basename($files[$i])."\r\n" .
                        "Content-Disposition: attachment;\r\n" . " filename=\"".basename($files[$i])."\"; size=".filesize($files[$i]).";\r\n" .
                        "Content-Transfer-Encoding: base64\r\n\r\n" . $data . "\r\n\r\n";
                }
            }
            $body .= "--{$mime_boundary}--";
        }else{
            $headers .= "Content-Type: text/plain;charset=ISO-2022-JP\r\n";
        }

        /* Additional Header */
        $headers .= "From: " .
            mb_encode_mimeheader (mb_convert_encoding($from_name,"ISO-2022-JP",$from_enc)) .
            "<".$from_email.">\n";
        if(!empty($reply_email)){
            if(!empty($reply_name)){
                $headers .= "Reply-To: " .
                    mb_encode_mimeheader (mb_convert_encoding($reply_name,"ISO-2022-JP",$from_enc)) .
                    "<".$reply_email.">\r\n";
            }else{
                $headers .= "Reply-To: " .
                    mb_encode_mimeheader (mb_convert_encoding($reply_email,"ISO-2022-JP",$from_enc)) .
                    "<".$reply_email.">\r\n";
            }
        }else{
            $headers .= "Reply-To: " .
                mb_encode_mimeheader (mb_convert_encoding($from_name,"ISO-2022-JP",$from_enc)) .
                "<".$from_email.">\r\n";
        }

        /* Mail, sending */
        return mail($to, $subject, $body, $headers, $sendmail_params);

    }
}