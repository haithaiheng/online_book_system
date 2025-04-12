<?php
    require '../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    header('Content-type: application/json');
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['email'])){
        echo json_encode(array('message'=>'invalid request'));
        exit;
    }
    
    require_once('../providers/api.php');
    $api = new Api();

    $message = '';
    $code = '';
    $result = $api->forgot($data['email']);
    if ($result == null){
        $message = 'email not found!';
    }else{
        $d = $result->fetch_assoc();
        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'hengalwaysfresh@gmail.com';                     //SMTP username
            $mail->Password   = 'jvwj niwp zbfl wkus';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('hengalwaysfresh@gmail.com', 'OBS');
            $mail->addAddress($data['email'], '');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Forgot Password';
            $mail->Body    = 'Here is your verify code <b>'.$d['user_confirmcode'].'</b>';
            $mail->AltBody = 'Do not share this to anyone';
        
            $send = $mail->send();
            if ($send){
                $code = $d['user_confirmcode'];
                $message = 'success';
            }
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        

        
    }

    echo json_encode(array('message'=>$message,'code'=>$code));
?>