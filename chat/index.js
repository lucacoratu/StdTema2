
window.onload = (e) => {
    setRefreshTime();
};

function setRefreshTime() {
    setInterval((e) => {
        getMessages();
    }, 1000)
}

const hidden_label = document.getElementById('current_id');
let lastTime = parseInt(hidden_label.innerText);

function getMessages() {
    $.ajax({
        type: "GET",
        url: 'getmessages.php?lasttime=' + lastTime
    }).done((e) => {
        //console.log(e);
        var json = JSON.parse(e);
        console.log(json);

        //Add the message to the html
        const messages = document.getElementById('messages');
        //console.log(messages);

        for (let i = 0; i < json.length; i++) {
            messages.innerHTML += '<div class="message-container"><div class="message">' + json[i].text + '</div><div class="sender-date">' + json[i].sender + ' ' + json[i].time + "</div>"
            lastTime = parseInt(json[i].time);
        }

        //console.log(lastID);
    });
}

function sendMessage(e){
    //Get the username
    const inputUsername = document.getElementById('username');
    const inputUsertext = document.getElementById('usertext');

    var user = inputUsername.value;
    var text = inputUsertext.value;
    //Get the usertext
    $.ajax({
        type: 'POST',
        url: 'sendmessage.php',
        data: {usertext: text, username: user},
        success: function(e){
            return;
        }
    })
}
