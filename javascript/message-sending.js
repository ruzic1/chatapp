const socket=new WebSocket('ws://127.0.0.1:8080');
socket.onopen=function(){
    console.log("WebSocket connection established.");
}
socket.onmessage=function(){
    
}
socket.onclose=function(){
    
}
socket.onerror=function(){
    
}
const buttonForSending=document.getElementById('buttonForSendingMessage');


if(buttonForSending){
    //console.log(document.getElementById('textArea').value);
   
    //const socket=new WebSocket("ws://127.0.0.1:8080");

    buttonForSending.addEventListener('click',function(){
        const username="";
        console.log(document.getElementsByClassName('contact'));
        for(var i=0;i<document.getElementsByClassName('contact').length;i++){
            // if(document.getElementsByClassName('contact')[i].style=='active'){
            //     console.log('element '+document.getElementsByClassName('contact')[i]+' je aktivan')
            // }
            console.log(document.getElementsByClassName('contact')[i].classList.contains('active'));
            if(document.getElementsByClassName('contact')[i].classList.contains('active')){
                username=document.getElementsByClassName('contact')[i].querySelector('span').textContent;
            }

        }
        
        //console.log
        // const abc=document.getElementById('contacts');
        // const idReciever=abc.getAttribute('data-reciever-id');
        // for(var i=0;i<document.getElementsByClassName('contact').length;i++){
        //     if(document.getElementsByClassName('contact')[i].style=='active'){
        //         console.log('element '+document.getElementsByClassName('contact')[i]+' je aktivan')
        //     }
        // }
        // const idSender=currentUserId;
        // const message=document.getElementById('msgText').value;
        // const senderUsername=document.
        //console.log('OVO JE ID:'+id);
        //const targetId=;
        //const message=document.getElementById('textArea').value;
        //sendMessage(idReciever,idSender,message);
        // var msg=document.getElementById('textArea').value;
        // console.log(msg);
        // // console.log(123);
        // // socket.send(msg);
        // const socket=new WebSocket('ws://127.0.0.1:8080');
        // socket.onopen=function(){
        //     console.log("WebSocket connection established.");
        //     socket.send(msg);
        // }

    })

}
function sendMessage(targetId,senderId,msg){
    const message={
        targetId:targetId,
        messageText:msg,
        senderId:senderId
    };
    socket.send(JSON.stringify(message));


}