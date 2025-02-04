import {React,useState,useEffect,useContext} from "react";
import {useNavigate} from 'react-router-dom';
import { AuthContext } from "./AuthenticationState";
// import { AuthContext } from "./AuthenticationState";
// import { AuthContext } from "./AuthenticationState";
// import {useState} from 'react';



const Login=()=>{
    // const {user,login}=useContext(AuthContext);
    // console.log()

    // const {userFunc}=useContext(AuthContext);
    const navigate=useNavigate();
    const {login} = useContext(AuthContext);
    const [email,setEmail]=useState("");
    const [password,setPassword]=useState("");
    const [isValid,setIsValid]=useState({email:null,password:null});
    const [userReport,setUserReport]=useState({msg:null,description:null});


    const validateInputs=()=>{
        const regexEmail=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const regexPassword=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        // if(regexEmail.test(email)){
        //     setIsValid({email:true});
        // }else{
        //     setIsValid({email:false});
        // }
        // if(regexPassword.test(password)){
        //     setIsValid({password:true});
        // }else{
        //     setIsValid({password:false});
        // }
        if(regexEmail.test(email)&&regexPassword.test(password)){
            return true;
        }else{
            return false;
        }
    }
    const loginProcessing = async ()=>{
        validateInputs();
        if(validateInputs())
        {
            const data=await login({email,password});

            console.log(data);
            if(data.user){
                navigate('/products');
            }
            console.log(JSON.parse(sessionStorage.getItem('user')));
            // if(data.user){

            // }

            // if(data.user){
            //     sessionStorage.setItem('user',JSON.parse(JSON.stringify(data.user)));
            //     console.log((JSON.parse(sessionStorage.getItem('user'))));
            //     // console.log('Korisnik postoji');
            // }else console.log('Korisnik ne postoji');
            // console.log();
            // console.log('OAIJWDOIAWDIJAOWIDJAOIWDJAOIWJD')
            // const response = await fetch('/login-processing', {
            //     method: 'POST',
            //     headers: { 'Content-Type': 'application/json' },
            //     body: JSON.stringify({ email, password }),
            // });

            // const data=await response.json();
            // console.log(data);
            // if(data.message){
            //     sessionStorage.setItem('loggedIn',true);
            //     sessionStorage.setItem('user', JSON.stringify(data.user));
            //     console.log('uspesno je')


                
                
            //     navigate('/products');
            // }else console.log('nista ne radi')
            

        }
        // validateInputs(){}
        // if(validateInputs()){
        //     try {


        //         const data=await login({email,password});

        //         console.log(data);

        //         const obj={msg:data.message,description:data.description}
        //         setUserReport(obj);
        //         // localStorage.setItem('user',JSON.stringify({email}));
                

        //         if(obj.msg==true){
        //             console.log('PORUKA JE ISPRAVNA')
        //             navigate('/products');
        //         }
        //     } 
        //     catch (error) 
        //     {
        //         console.error('Login failed:', error);
        //         setUserReport({msg: false,description: 'An error occurred during login. Please try again.'});
        //     }
        // }else console.log('Kriterijumi nisu ispostovani');


        // console.log(isValid);

        // console.log('Email is '+email+' while password is '+password);


    }
    


    return(
    <div className='row justify-content-center'>
        {/* <h1>{user}</h1> */}
        <div className='col-md-6'>
            <form action="" method="post" className='row justify-content-center'>
                <div className='form-group col-lg-12'>
                    <label htmlFor="email" className='col-lg-4'>Email:</label>
                    <input id="email" name="email"  type="email" className={`col-lg-12 ${isValid.email==null?'':isValid.email?'border border-success':"border border-danger"}`} onChange={(e)=>setEmail(e.target.value)}/>
                    <span type="text" id="emailErrReport">
                    {
                        isValid.email==false
                        ?(<small className="text-danger">Invalid email</small>)
                        :null
                    }
                    {/* {isValid === false && (
                    <small className="text-danger">Invalid first name</small>
                    )} */}
                    </span>
                </div>
                <div className='form-group col-lg-12'>
                    <label htmlFor="password" className='col-lg-4'>Password:</label>
                    <input 
                    id="password" 
                    name="password"  
                    type="password" 
                    className={`col-lg-12 ${isValid.password==null?'':isValid.password?'border border-success':"border border-danger"}`} 
                    onChange={(e)=>setPassword(e.target.value)}/>
                    <span type="text" id="passwordErrReport">
                    {
                        isValid.password==false
                        ?(<small className="text-danger">Invalid password</small>)
                        :null
                    }
                    {/* {isValid === false && (
                    <small className="text-danger">Invalid first name</small>
                    )} */}

                    </span>
                </div>
                <div className="form-group col-lg-12">
                    <div id="userReport"> 
                        {userReport && (
                            <div
                                className={`alert ${
                                    userReport.msg==false
                                    ?'alert-danger'
                                    :userReport.msg==true
                                    ?'alert-success'
                                    :''
                                }`}
                            >
                            {userReport.description}

                            </div>
                        )}                                                  
                    </div>
                </div>
                <div className="form-group w-100 d-flex justify-content-center">
                    <input name="login" type="button" value="Login" id='login' button="login" onClick={loginProcessing}/>
                    
                </div>
                <span>Don't have an account?Click here to<a href="/index"> register</a></span>
                
            </form>
        </div>
        {/* <div className='col-md-6'>
            <form action="" method="post" className='row justify-content-center'>
                <div className='form-group col-lg-12'>
                    <label for="email" className='col-lg-4'>Email:</label>
                    <input id="email" name="email"  type="email" className='col-lg-12'/>
                    <span type="text" id="emailErrReport"></span>
                </div>
                <div className='form-group col-lg-12'>
                    <label for="password" className='col-lg-4'>Password:</label>
                    <input id="password" name="password"  type="password" className='col-lg-12'/>
                    <span type="text" id="passwordErrReport"></span>
                </div>
                <div className="form-group col-lg-12">
                    <div id="userReport">
                         
                    </div>
                </div>
                <div className="form-group w-100 d-flex justify-content-center">
                    <input name="login" type="button" value="Login" id='login' button="login"/>
                    
                </div>
                <span>Don't have an account?Click here to<a href="/index"> register</a></span>
            </form>
        </div> */}
    </div>
    );
}

export default Login;