<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'kbs25121996@gmail.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = 'Online Appointment Form';

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  $contact->smtp = array(
    'host' => 'smtp.gmail.com',
    'username' => 'itsmohsinofficial@gmail.com',
    'password' => 'pqfznrsawlnxmphf',
    'port' => '587'
  );


  $contact->add_message( $_POST['name'], 'Name');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['phone'], 'Phone');
  $contact->add_message( $_POST['date'], 'Appointment Date');
  $contact->add_message( $_POST['department'], 'Department');
  $contact->add_message( $_POST['doctor'], 'Doctor');
  $contact->add_message( $_POST['message'], 'Message');

  echo $contact->send();
?>