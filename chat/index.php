<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="index.js" defer></script>
    </head>
    <body>
        <div class="chat-container">
            <div class="chat-header">
                Chat application
            </div>
            <div class="chat-messages" id="messages">
<!--                 <div class="message-container">
                    <div class="message">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut cumque ab ipsa commodi quo quas>
                    </div>
                    <div class="sender-date">
                        Lucacoratu 24 April 2022
                    </div>
                </div> -->
                <?php
                    //Load the messages from the database
                    //Connect to the database
                require 'vendor/autoload.php';
                $client = new MongoDB\Client("mongodb://some-mongo:27017");
                $collection = $client->chat->messages;

                $cursor = $collection->find();
                $lastMessageTimestamp = 1;
                foreach($cursor as $row){
                   echo '<div class="message-container">
                        <div class="message">';
                        echo $row['text'];
                        echo '</div>
                        <div class="sender-date">';
                        echo $row['sender'].' '.$row['time'];
                        echo '</div>
                        </div>';
                        $lastMessageTimestamp = $row['time'];
                }
                    echo '<label style="display: none" id="current_id">'.$lastMessageTimestamp.'</label>';
                ?>
            </div>
            <div class="chat-insert">
                <form class="insert-form" method="POST" action="sendmessage.php">
                    <input id="username" class="message-sender" type="text" placeholder="Enter your name" required maxlength="100" name="username">
                    <input id="usertext" class="message-input" type="text" placeholder="Write your message" required maxlength="50" name="usertext">
                    <button class="send-message" type="button" onclick="sendMessage(this)">Send</button>
                </form>
            </div>
        </div>
    </body>
</html>
