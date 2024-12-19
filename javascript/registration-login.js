const registerButton=document.getElementById('register');
if(registerButton)
    registerButton.addEventListener("click",function(){
    console.log(555);
    let firstName=document.getElementById('fName');
    let lastName=document.getElementById('lName');
    let username=document.getElementById('username');
    let email=document.getElementById('email');
    let password=document.getElementById('password');
    //console.log(55);
    const fNameRegex=/^[A-Z][A-Za-z'-]{2,15}$/;
    const lNameRegex=/^[A-Za-z][A-Za-z'-]{2,20}$/;
    const usernameRegex=/^[a-zA-Z0-9_]{3,15}$/;
    const emailRegex=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRegex=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    let errors=0;

    if(!fNameRegex.test(firstName.value)){
        errors++;
        firstName.style.border="1px solid red";
        document.getElementById('fnameErrReport').innerHTML="First Name should have first capital letter, and should have min 2 and max 15 characters."
    }else{
        firstName.style.border="1px solid black";
        document.getElementById('fnameErrReport').innerHTML="";
    }
    if(!lNameRegex.test(lastName.value)){
        errors++;
        lastName.style.border="1px solid red";
        document.getElementById('lnameErrReport').innerHTML="Last Name should have first capital letter, and should have min 2 and max 20 characters."
    }else{
        lastName.style.border="1px solid black";
        document.getElementById('lnameErrReport').innerHTML="";
    }
    if(!usernameRegex.test(username.value)){
        errors++;
        username.style.border="1px solid red";
        document.getElementById('usernameErrReport').innerHTML="Username can have lowercase,uppercase letters, as well as numbers and underscore. Between 3 and 15 characters";
    }else{
        username.style.border="1px solid black";
        document.getElementById('usernameErrReport').innerHTML="";
    }
    if(!emailRegex.test(email.value)){
        errors++;
        email.style.border="1px solid red";
        document.getElementById('emailErrReport').innerHTML="Email can have combinations of characters before @ char. After @, specific domain is expected";
    }else{
        email.style.border="1px solid black";
        document.getElementById('emailErrReport').innerHTML="";
    }
    if(!passwordRegex.test(password.value)){
        errors++;
        password.style.border="1px solid red";
        document.getElementById('passwordErrReport').innerHTML="Password must have atleast 8 characters, from which one should be uppercase, one lowercase letter, one digit and one special character";
    }else{
        password.style.border="1px solid black";
        document.getElementById('passwordErrReport').innerHTML="";
    }

    // if(fNameRegex.test(firstName.value)){
    //     errors++;
    // }


    let dataForTransfer={
        'username':username.value,
        'email':email.value,
        'password':password.value
    };
    let currentString= window.location.href;
    let fixedString=currentString.lastIndexOf("/",currentString.length);
    let finalString=currentString.substring(fixedString,currentString.length);
    let correctedString=finalString.replace(".php","");
    //console.log(dataForTransfer);
    if(errors==0)
    {
        fetch('/registration-processing',{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                fName1:firstName.value,
                lName1:lastName.value,
                username1:username.value,
                email1:email.value,
                password1:password.value
            })
            
        })
        .then((response)=>{
            if(response.ok){
                return response.json();
            }
        })
        .then((data)=>{
            if(data.status=="success"){
                document.getElementById('userReport').innerHTML=`<div class='alert alert-success' role='alert'>${data.message}</div>`;
                openModalForLogin();
            }else if(data.status=="error"){
                document.getElementById('userReport').innerHTML=`<div class='alert alert-danger' role='alert'>${data.message}</div>`;
            }else{
                document.getElementById('userReport').innerHTML=`<div class='alert alert-warning' role='alert'>${data.message}</div>`;
            }
            
            console.log(data);
        })
        .catch((err)=>{
            console.error(err);
        })
    }
})
const loginButton=document.getElementById('login');
if(loginButton){
    loginButton.addEventListener('click',function(){
        let email=document.getElementById('email');
        let password=document.getElementById('password');
        console.log(email.value);
        console.log(password.value);

        
        fetch("/login-processing",{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            body:JSON.stringify({
                email:email.value,
                password:password.value
            })

        })
        .then((res)=>{
            if(res.ok){
                return res.json();
            }
        })
        .then((data)=>{
            //console.log(data);
            if(data.message==true){
                console.log(data.description);
                console.log('USPELO');
                window.location.href=`/products`
            }else if(data.message==false){
                console.log(data.description);
            }
        })
        .catch((err)=>{
            console.error(err);
        })
    })
}
document.addEventListener('DOMContentLoaded',()=>{
    const url=window.location.pathname;

    if(url=='/products')
    {

        fetch(`/user-connections`,{
            method:'POST',
            headers:{
                'Content-Type':'application/json'
            },
            //body:JSON.stringify({'id':userId})
        })
        .then((res)=>{
            return res.json();
        })
        .then((data)=>{
            // console.log(data);
            // console.log(data.length);
            if(data.length==0||data==null){
                document.getElementById('listOfContacts').innerHTML="<span>You have no contacts</span>"
            }
            else{
                for(var i=0;i<data.length;i++)
                {
                    console.log(data);
                    document.getElementById('listOfContacts').innerHTML=`<div class="contact" onclick="clickedReciever(this)"><span style='font-weight:800' id='username'>${data[i].username}</span><div>${data[i].poruka}</div></div><div class="contact" onclick="clickedReciever(this)"><span style='font-weight:800' id='username'>John doe</span></div>`
                }
            }
        })
        .catch((exc)=>{
            console.log('Exception:'+exc.message);
        })


    }
    // const count1=url.lastIndexOf("/");
    // const finalUrl=url.substring(count1,url.length);
    //console.log(url);
    
    //console.log(userId);
})
function openModalForLogin(){
    var divElement=document.createElement("div");
    divElement.setAttribute("id","myModal");
    divElement.setAttribute("class","modal");
    //console.log(divElement);

    var modalContent=document.createElement("div");
    modalContent.setAttribute("class","modal-content");
    //console.log(modalContent);

    divElement.appendChild(modalContent);
    console.log(divElement);
}
function connectionSetup(){
    console.log('Konektovanje');
}