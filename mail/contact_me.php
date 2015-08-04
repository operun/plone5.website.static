<?php
// Check for empty fields
if(empty($_POST['name'])                ||
   empty($_POST['email'])               ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
        echo "No arguments Provided!";
        return false;
   }

$name = $_POST['name'];
$email_address = $_POST['email'];

// Create the email and send the message
$to = 'mail@steffen-lindner.de'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Plone5 RLS Party Anmeldung:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\n";
$headers = "From: noreply@plone.de\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
mail($to,$email_subject,$email_body,$headers);
$myfile = fopen("anmeldungen.txt", "w") or die("Unable to open file!");
$current = file_get_contents($myfile);
$current .= $email_body;
fwrite($myfile, $current);
fclose($myfile);
return true;
?>
