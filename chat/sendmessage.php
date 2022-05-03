
<?php
    //Connect to the database
        require 'vendor/autoload.php';
        $client = new MongoDB\Client("mongodb://some-mongo:27017");
        $collection = $client->chat->messages;

        $element = array("sender" => $_POST['username'], "text" => $_POST['usertext'], "time" => time());


  //Get the message from the POST supervariable
    $name = $_POST['username'];
    $content = $_POST['usertext'];

    //Insert the message into the database
    $collection->insertOne($element);
    //header('Location: index.php');
    exit();

?>
