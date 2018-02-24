<?php

if(isset($_POST['email'])) {



    // EDIT THE 2 LINES BELOW AS REQUIRED

    $email_to = "jro34@live.com";

    $email_subject = "Website Form Message";





    function died($error) {

        // your error code can go here

        echo "We are very sorry, but there were error(s) found with the form you submitted. ";

        echo "These errors appear below.<br /><br />";

        echo $error."<br /><br />";

        echo "Please go back and fix these errors.<br /><br />";

        die();

    }



    // validation expected data exists

    if(!isset($_POST['name']) ||

        !isset($_POST['email']) ||

        !isset($_POST['telephone']) ||

        !isset($_POST['comments'])) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');

    }



    $name = $_POST['name']; // required

    $email_from = $_POST['email']; // not required

    $telephone = $_POST['telephone']; // not required

    $comments = $_POST['comments']; // required



    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {

    $error_message .= 'The Name you entered does not appear to be valid.<br />';

  }

  if(strlen($comments) < 2) {

    $error_message .= 'The Comments you entered do not appear to be valid.<br />';

  }

  if(strlen($error_message) > 0) {

    died($error_message);

  }

    $email_message = "Message details below.\n\n";



    function clean_string($string) {

      $bad = array("content-type","bcc:","to:","cc:","href");

      return str_replace($bad,"",$string);

    }



    $email_message .= "Name: ".clean_string($name)."\n";

    $email_message .= "Email: ".clean_string($email_from)."\n";

    $email_message .= "Telephone: ".clean_string($telephone)."\n";

    $email_message .= "Comments: ".clean_string($comments)."\n";





// create email headers

$headers = 'From: '.$name."\r\n".

'Reply-To: '.$email_from."\r\n" .

'X-Mailer: PHP/' . phpversion();

@mail($email_to, $email_subject, $email_message, $headers);

// This refreshes after submit and sends email, but no confirmation messages are shown

// header('Location: index.html');

// This refreshes after submit and sends email, displays conf. message and refreshes to index.html after 5 seconds

header( "refresh:5; url = index.html" );

?>



<!-- include your own success html here -->


Thank you for contacting us. We will be in touch with you very soon.


<?php

}

?>