<?php
    //Connect to the database
                require 'vendor/autoload.php';
                $client = new MongoDB\Client("mongodb://some-mongo:27017");
                $collection = $client->chat->messages;

                $cursor = $collection->find();


    //Get the messages that are after the timestamp given as an argument
    $lasttime = $_GET['lasttime'];

        $json = [];
        foreach($cursor as $row){
                if($row['time'] > $lasttime){
                       $jsonmessage = $row;
                        array_push($json, $jsonmessage);
                }
        }
        //print_r($json);
        $json = json_encode($json);

    //$json = json_encode($result->fetch_all());
    //print_r($json);

    exit($json);
?>
