<?php

if(isset($_POST['Email'])) {


    $email_to = "keerthi@apakau.com";
    $email_subject = "Website Contact";


    function died($error) {

        echo "We are very sorry, but there were error(s) found with the form you submitted.";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }

    // validation expected data exists
    if(!isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['companyname'])) {
        died('Sorry, but there appears to be a problem with the form you submitted.');
    }

    $first_name = $_POST['Name']; // required
    $last_name = $_POST['Email']; // required
    $email_from = $_POST['companyname']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$Email)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$Name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }

  if(strlen($companyname) < 10) {
    $error_message .= 'The message you entered does not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }


    $Name .= clean_string($Name)."\n";
    $Email .= clean_string($Email)."\n";
    $companyname .= clean_string($companyname)."\n";


//email headers
$headers = 'From: '.$Email."\r\n".
'Reply-To: '.$Email."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $companyname, $headers);
?>

Thank you for contacting me. I will be in touch with you very soon.

<?php
}
?>