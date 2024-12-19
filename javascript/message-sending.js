let socket;
window.onload=function(){  
    //let socket;  
    let username=getUsername().then(username=>{
        socket=new WebSocket(`ws://127.0.0.1:8080?username=${username}`);
        console.log(socket);

        socket.onopen=function(){
            console.log("WebSocket connection established.");
        }
        socket.onmessage=function(event){
            console.log(event);
            if(event.data) outputMessagesInRealTime(event.data);
            //console.log(event);
            //const data=JSON.parse(event.data);
            //console.log(data);
            //socket.send(JSON.stringify(data));
            //console.log(data);
            // console.log('New message:', data);
            // socket.send(data);

        }
        socket.onclose=function(){
            
        }
        socket.onerror=function(){
            
        }
    });
    //const socket=new WebSocket(`ws://127.0.0.1:8080?username=${username}`);
    // socket.onopen=function(){
    //     console.log("WebSocket connection established.");
    // }
    // socket.onmessage=function(event){
    //     const data=JSON.parse(event.data);
    //     console.log('New message:', data.text);
    // }
    // socket.onclose=function(){
        
    // }
    // socket.onerror=function(){
        
    // }
    const buttonForSending=document.getElementById('buttonForSendingMessage');


    if(buttonForSending){


        buttonForSending.addEventListener('click',function(){
            let username="";
            console.log(document.getElementsByClassName('contact'));
            for(var i=0;i<document.getElementsByClassName('contact').length;i++){

                console.log(document.getElementsByClassName('contact')[i].classList.contains('active'));
                if(document.getElementsByClassName('contact')[i].classList.contains('active')){
                    username=document.getElementsByClassName('contact')[i].querySelector('span').textContent;
                }

            }
            if(username!=""){
                let msg=document.getElementById('msgText').value;
                let sender_username= document.getElementById('currentUser').textContent;
                let reciever_username=username;
                sendMessage(reciever_username,sender_username,msg)
            }
        })

    }
}
function sendMessage(reciever_username,sender_username,msg){
    const message={
        reciever_username:reciever_username,
        sender_username:sender_username,
        msg:msg
    };
    socket.send(JSON.stringify(message));
}

// async function main(){
//     const username=await getUsername();
//     console.log(username);
// }

function getUsername(){

    return fetch('/get-user')
        .then(response=>response.json())
        .then(data=>data.username);
    // const response=fetch('/get-user');
    // const data=response.json();
    // return data.username;
}

function outputMessagesInRealTime(message){
    const messageContainer=document.getElementById('message-area');
    const newMessage=document.createElement('div');
    newMessage.classList.add('message');
    newMessage.textContent=message;
    messageContainer.appendChild(newMessage);
}