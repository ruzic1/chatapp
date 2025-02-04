// if(document.querySelectorAll('.contact')){
//     document.querySelectorAll('.contact').addEventListener('click',function(e){
//         console.log(e);
//     })
// }
function clickedReciever(e){
    //console.log(e);
    //console.log(555);
    // console.log(e.textContent);
    //console.log(e);
    let contacts=document.getElementsByClassName('contact');
    //console.log(contacts);
    for(var i=0;i<contacts.length;i++){
        contacts[i].classList.remove('active');
    }
    for(var i=0;i<contacts.length;i++){  
        if(e==contacts[i]){

            contacts[i].classList.add('active');

        }
    }
    //e.setAttribute('class','active');
    let elements=document.getElementsByClassName('contact');
    //console.log(e.id);
    let clickedRecieverUsername=e.querySelector('#username').textContent;
    //console.log(clickedRecieverUsername);


    fetch('/message-retrieval',{
        method:'POST',
        headers:{
            'Content-Type':'application/json',
        },
        body:JSON.stringify({
            username:clickedRecieverUsername
        })
    })
    .then((res)=>{
        return res.json();
    })
    .then((data)=>{
        //console.log('Evo ga zapis:'+data);
        if(data.length==0){
            document.getElementById('message-area').innerHTML='<span>No messages yet</span>';
        }else{
            let html="";
            //const messageElements = document.getElementsByClassName('message');
            var dbObject=JSON.parse(JSON.stringify(data));
            //console.log(dbArray);

            for(var i=0;i<data.length;i++){
                //document.getElementsByClassName('message sent').innerHTML=`""`
                if(dbObject[i].poruka==null){
                    continue;
                }
                html+=`<div class='message sent'>${(dbObject[i].poruka)}</div>`;
                
            }

            //console.log(html);
            document.getElementById('message-area').innerHTML=html;
            //document.getElementsByClassName('message sent')[0].innerHTML=html;
            // document.getElementById('message-area').innerHTML='<span>No messages yet</span>';
        }
    })
    .catch((err)=>{
        console.log(err.message);
    })
}