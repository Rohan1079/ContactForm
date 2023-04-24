<?php
include_once("index.php");

$newUser = new user();
$newUser->name = $_POST["userName"];
$newUser->eMail = $_POST["userEmail"];
$newUser->userIssue = $_POST["userIssue"];
$newUser->comment = $_POST["comment"];

function sqlEntry()
        {
            $servername = "localhost";
            $username = "********"; //your database username
            $password = "********"; //your databse password
            $dbname ="*****"; //your database name
            $newUser = new user();
            $newUser->name = $_POST["userName"];
            $newUser->eMail = $_POST["userEmail"];
            $newUser->userIssue = $_POST["userIssue"];
            $newUser->comment = $_POST["comment"];

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        
        echo "Connected successfully.";
        
        $stmt = $conn->prepare("INSERT INTO information (Name, eMail, Issue, comment) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$newUser->name, $newUser->eMail, $newUser->userIssue, $newUser->comment);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        echo "Information is saved.";
        
        } 

?>

<html>
    <head>
    </head>
    <body>
        <h1>Your Information:</h1>
        <hr>
        <?php
        ob_clean();
        echo "Name : $newUser->name <br>";
        echo "eMail : $newUser->eMail <br>";
        echo "Issue : $newUser->userIssue <br>";
        echo "Comment : $newUser->comment<br>";
        ?>
        <p> Incorrect Detalis? Press Edit. <br> Happy with the information, Save it! </p>
        
        <input type ="button" value="Edit" onclick ="history.back()">
        <button onclick="<?php sqlEntry() ?>;"> Save It! </button>

    </body>
</html>
