
<?php
// This is my code for contact form
class user 
{
    public $name;
    public $eMail;
    public $userIssue;
    public $comment;

    function __construct()
    {
        $name = "";
        $eMail = "";
        $userIssue = "";
        $comment = "";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

// define variables and set to empty values
$nameErr = $emailErr = "";
$name = $email = $comment  = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["userName"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["userName"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["userEmail"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["userEmail"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }
}
?>
<html>
    <head>
        <title> Contact Form </title>
        <link rel ="stylesheet" href="styles.css">
    </head>
    <body>
        <h1> Contact Form </h1>
        <hr>
        <div class = "contactForm">
        <form action="output.php" method = "post">
            <label for = "name">Name:</label>
            <input type="text" placeholder ="Your Name" name = "userName" required>
            <br><br>
            <label for = "userEmail">eMail:</label>
            <input type = "text" placeholder ="Your eMail" name = "userEmail" required>
            <br><br>
            <label for = "userIssue" >Issue:</label>
            <select name = "userIssue" required>
                <option value = "Select"> Select your issue </option>
                <option value = "Query"> Query </option>
                <option value = "Feedback"> Feedback </option>
                <option value = "Complaint"> Complaint </option>
                <option value = "Other"> Other </option>
            </select>
            <br><br>
            <lable for = "comment">Comment:</lable>
            <textarea name="comment" rows = "5" cols ="40" required></textarea>
            <br><br>
            <input type = "submit" name = "submit" value = "Submit">
            <hr>
        </form>
        </div>
    </body>
</html>
