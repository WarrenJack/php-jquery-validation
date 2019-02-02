<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Validation Form 1.0</title>
  </head>
  <body>
<?php

include 'valid.php';

if(isset($_POST['submit'])){
  $wasSuccessful = true;

  $text = sanitizeFormString($_POST['text']);
  $email = sanitizeFormString($_POST['email']);
  $phone = sanitizeFormString($_POST['phone']);
  $domain = sanitizeFormString($_POST['domain']);
  $postcode = sanitizeFormString($_POST['postcode']);

//TEXT ------------------------

	$result = Validate::text($text, true);

	switch($result){
		case Validate::SHORT:
			$text_error = 'Text is to short, Character length must be over 2';
      $wasSuccessful = false;
		break;
		case Validate::LONG:
			$text_error = 'Text is to long, Character length must be below 300';
      $wasSuccessful = false;
		break;
    case Validate::TEXT_INVALID:
      $text_error = 'Text can only container letters or white space.';
      $wasSuccessful = false;
    break;
    case Validate::REQUIRED:
      $text_error = 'This field is required';
      $wasSuccessful = false;
    break;
	}
//END TEXT ----------------------

//EMAIL -----------------------------
  $result = Validate::email($email, true);

	switch($result){
		case Validate::EMAIL_INVALID:
			$email_error = 'Jack\'s email is invalid';
      $wasSuccessful = false;
		break;
    case Validate::EMAIL_USER_INVALID:
      $email_error = 'Username for email is invalid';
      $wasSuccessful = false;
    break;
		case Validate::REQUIRED:
			$email_error = 'Jack\'s email is required';
      $wasSuccessful = false;
		break;
	}
//END Email ----------------------------

//DOMAIN -----------------------------
  $result = Validate::domain($domain, true);

	switch($result){
		case Validate::DOM_INVALID:
			$domain_error = 'Domain is invalid';
      $wasSuccessful = false;
		break;
		case Validate::REQUIRED:
			$domain_error = 'Domain is required';
      $wasSuccessful = false;
		break;
	}
//END DOMAIN ----------------------------

//POSTCODE ------------------------
	$result = Validate::postcode($postcode, true);

	switch($result){
		case Validate::POSTCODE_INVALID:
			$postcode_error = 'Jack\'s post code is invalid';
      $wasSuccessful = false;
		break;
		case Validate::REQUIRED:
			$postcode_error = 'Jack\'s post code is required';
      $wasSuccessful = false;
		break;
	}
//END POSTCODE ----------------------

//PHONE ------------------------
	$result = Validate::phone($phone, true);

  switch($result){
		case Validate::SHORT:
			$phone_error = 'Number is to short, Character length must be over 2';
      $wasSuccessful = false;
		break;
		case Validate::LONG:
			$phone_error = 'Number is to long, Character length must be below 12';
      $wasSuccessful = false;
		break;
    case Validate::PHONE_INVALID:
      $phone_error = 'Text can only contain numbers.';
      $wasSuccessful = false;
    break;
    case Validate::REQUIRED:
      $phone_error = 'This field is required';
      $wasSuccessful = false;
    break;
	}
//END PHONE ----------------------

	if($wasSuccessful == true) {
		header("Location: index.php");
	}
}

?>

<form class="" method="post"  action="index.php" id='myform'>

      <p>
        <label for="text">Text</label>
				<input id="text" name="text" type="text" >
        <?php echo $text_error;?>

			</p>

			<p>
				<label for="email">Email</label>
				<input id="email" name="email" type="text" data-validation="email">
        <?php echo $email_error;?>

			</p>

      <p>
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="phone" >
        <?php echo $phone_error;?>
      </p>

      <p>
        <label for="domain">Domain</label>
        <input id="domain" name="domain" type="domain">
        <?php echo $domain_error;?>

      </p>

      <p>
        <label for="postcode">Postcode</label>
        <input id="postcode" name="postcode" type="postcode">
        <?php echo $postcode_error;?>

      </p>

			<button type="submit" name="submit">Submit</button>
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script src="validationjs.js"></script>

  </body>
</html>
