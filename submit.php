<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['appointment']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['date']) && isset($_POST['doctor']) && $_POST['message']) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $date = $_POST['date'];
  $doctor = $_POST['doctor'];
  $message = $_POST['message'];

  $captcha = $_POST['g-recaptcha-response'];
  $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LcSVKonAAAAAHNUBAx0CHgmnpytnEqf5KUZwia6&response='.$captcha);
  $valid = json_decode($response , true);

  if ($valid['success'] == 1) {
    $email_message = '<html lang="en"><body> <p>There has been an enquiry website -</p><table border=1 cellpadding=0 cellspacing=0>
    <tr><td height=25 valign=middle> <strong>Name</strong></td><td> '.$name.'</td></tr>
    <tr><td height=25 valign=middle> <strong>Phone:</strong></td><td> '.$phone.'</td></tr>
    <tr><td height=25 valign=middle> <strong>Email</strong></td><td> '.$email.'</td></tr>
    <tr><td height=25 valign=middle> <strong>Date</strong></td><td> '.$date.'</td></tr>
    <tr><td height=25 valign=middle> <strong>Designation</strong></td><td> '.$doctor.'</td></tr>
    <tr><td height=25 valign=middle> <strong>Message</strong></td><td> '.$message.'</td></tr>
    </body> </html>';
    $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'itsmohsinofficial@gmail.com';                     //SMTP username
      $mail->Password   = 'pqfznrsawlnxmphf';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      //Recipients
      $mail->setFrom('itsmohsinofficial@gmail.com', 'Manasu');
      // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
      // $mail->addAddress('ellen@example.com');               //Name is optional
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Manasu | Appointment';
      $mail->Body    = $email_message;
      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      echo 'Message has been sent';
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

  }
}
