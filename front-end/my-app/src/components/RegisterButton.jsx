import React, {useState} from 'react';
//import { useState } from 'react';

const RegisterButton=()=>{
    // const handleClick=()=>{
    //     console.log('Kliknuto je dugme za rezervisanje');
    // }
    // const [registerButton,setValue]=useState(0);
    
    const [firstName,setFirstName]=useState("");
    const [lastName,setLastName]=useState("");
    const [username,setUsername]=useState("");
    const [email,setEmail]=useState("");
    const [password,setPassword]=useState("");

    const [abc, setCount]=useState(0);

    const handleRegistrationInput=()=>{
        //setFirstName
    }


    return (
        <input name="register" type="button" id='register' button="register" onClick={handleRegistrationInput} value="0"/>
    )


    
};

// function handlingRegistrationInput(){
//     console.log('dugme je kliknuto');
//     console.log(firstName);
// }
export default RegisterButton;