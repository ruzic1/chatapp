import React, {useState,useEffect} from 'react';
import RegisterButton from './RegisterButton';



const Register=()=>{


    const [firstName,setFirstName]=useState("");
    const [lastName,setLastName]=useState("");
    const [username,setUsername]=useState("");
    const [email,setEmail]=useState("");
    const [password,setPassword]=useState("");

    const [isValid,setValidity]=useState({firstName:null,lastName:null,username:null,email:null,password:null});

    const [isTouched,setIsTouched]=useState(false);

    const validateFormInput=()=>{
        // if(regexFirstName.test(isValid.firstName)){
        //     setValidity((prev)=>({
        //         ...prev,
        //         firstName:true,
        //     }))
        // }else{
        //     setValidity((prev)=>({
        //         ...prev,
        //         firstName:false
        //     }))
        // }
        console.log(isValid.firstName);
        // console.log(firstName);
        // console.log('Ime korisnika je:'+firstName);
        const regexFirstName=/^[A-Z][a-z'-]{2,15}$/;
        const regexLastName=/^[A-Za-z][A-Za-z'-]{2,20}$/;
        const regexUsername=/^[a-zA-Z0-9_]{3,15}$/;
        const regexEmail=/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        const regexPassword=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


        if(regexFirstName.test(firstName)){
            setValidity((prev)=>({
                ...prev,
                firstName:true,
            }))
        }else{
            setValidity((prev)=>({
                ...prev,
                firstName:false
            }))
        }

        if(regexLastName.test(lastName)){
            setValidity((prev)=>({
                ...prev,
                lastName:true,
            }))
        }else{
            setValidity((prev)=>({
                ...prev,
                lastName:false
            }))
        }

        if(regexUsername.test(username)){
            setValidity((prev)=>({
                ...prev,
                username:true,
            }))
        }else{
            setValidity((prev)=>({
                ...prev,
                username:false
            }))
        }

        if(regexEmail.test(email)){
            setValidity((prev)=>({
                ...prev,
                email:true,
            }))
        }else{
            setValidity((prev)=>({
                ...prev,
                email:false
            }))
        }

        if(regexPassword.test(password)){
            setValidity((prev)=>({
                ...prev,
                password:true,
            }))
        }else{
            setValidity((prev)=>({
                ...prev,
                password:false
            }))
        }
        //console.log(Object.values(isValid));
        // if(regexFirstName.test(firstName)){
        //      setValidity(true);
        //     console.log('prosao je uslov')
        // }else setValidity(false);

        // const handleReports=()=>{

        // }

        
        // if(regexLastName.test(lastName)){
        //     setValidity(true);
        // }else setValidity(false);
        // if(regexUsername.test(lastName)){
        //     setValidity(true);
        // }else setValidity(false);
        
        // if(regexEmail.test(lastName)){
        //     setValidity(true);
        // }else setValidity(false);

        // if(regexLastName.test(lastName)){
        //     setValidity(true);
        // }else setValidity(false);

        
        // if(regexFirstName.test(firstName)){

        //     setValidity(true);
        // }else{
 
        //     setValidity(false);
        // }

        // if(isValid){
        //     console.log('Unos je validan');
        // }else{
        //     console.log('Totalna greska');
        // }
        // {isValid?'border border-success col-lg-12':'border border-danger col-lg-12'}


    }
    useEffect(()=>{
        const validity=Object.values(isValid);
        console.log(validity);
        if(validity.every(instance=>instance==true)){
            console.log('SVI INPUTI SU VALIDNI');
        }else console.log('IMA GRESAKA')
    })
    // const handleInputChange=(e)=>{
    //     setFirstName(e.target.value);
    // }
    const handleBlur=()=>{
        setIsTouched(true);
    }
    return (
        
        <main className='container'> 
        {/* <h1>{isValid}</h1> */}
            <div className='row justify-content-center'>
                <div className='col-md-6'>
                    <form action="" method="post" className='row justify-content-center'>
                        <div className='form-group col-lg-12'>
                            <label htmlFor="fName" className='col-lg-4'>First name:</label> 
                            <input 
                            id="fName" 
                            name="fName"  
                            type="text" 
                            className={`col-lg-12 border ${isValid.firstName==null?'':isValid.firstName?'border border-success':"border border-danger"}`}
                            onBlur={handleBlur} 
                            onChange={(e)=>setFirstName(e.target.value)} />

                            <span type="text" id="fnameErrReport">
                                {
                                    isValid.firstName==false
                                    ?(<small className="text-danger">Invalid first name</small>)
                                    :null
                                }
                                {/* {isValid === false && (
                                <small className="text-danger">Invalid first name</small>
                                )} */}

                            </span>
                        </div>
                        <div className='form-group col-lg-12'>
                            <label htmlFor="fName" className='col-lg-4'>Last name:</label> 
                            <input 
                            id="lName" 
                            name="lName"  
                            type="text" 
                            className={`col-lg-12 border ${isValid.lastName==null?'':isValid.lastName?'border border-success':"border border-danger"}`}
                            onBlur={handleBlur} 
                            onChange={(e)=>setLastName(e.target.value)}/>

                            <span type="text" id="lnameErrReport">
                                {
                                    isValid.lastName==false
                                    ?(<small className="text-danger">Invalid last name</small>)
                                    :null
                                }

                            </span>

                        </div>
                        <div className='form-group col-lg-12'>
                            <label htmlFor="username" className='col-lg-4'>Username:</label> 
                            <input 
                            id="username" 
                            name="username"  
                            type="text" 
                            className={`col-lg-12 border ${isValid.username==null?'':isValid.username?'border border-success':"border border-danger"}`}
                            onBlur={handleBlur} 
                            onChange={(e)=>setUsername(e.target.value)} />

                            <span type="text" id="usernameErrReport">
                                {
                                    isValid.username==false
                                    ?(<small className="text-danger">Invalid username</small>)
                                    :null
                                }

                            </span>
                            {/* <label htmlFor="email" className='col-lg-4'>Email:</label>
                            <input id="email" name="email"  type="email" className='col-lg-12'/>
                            <span type="text" id="emailErrReport"></span> */}
                        </div>
                        <div className='form-group col-lg-12'>
                            <label htmlFor="email" className='col-lg-4'>Email:</label> 
                            <input 
                            id="email" 
                            name="email"  
                            type="text" 
                            className={`col-lg-12 border ${isValid.email==null?'':isValid.email?'border border-success':"border border-danger"}`}
                            onBlur={handleBlur} 
                            onChange={(e)=>setEmail(e.target.value)} />

                            <span type="text" id="emailErrReport">
                                {
                                    isValid.email==false
                                    ?(<small className="text-danger">Invalid email</small>)
                                    :null
                                }

                            </span>
                            {/* <label htmlFor="password" className='col-lg-4'>Password:</label>
                            <input id="password" name="password"  type="password" className='col-lg-12'/>
                            <span type="text" id="passwordErrReport"></span> */}
                        </div>
                        <div className='form-group col-lg-12'>
                            <label htmlFor="password" className='col-lg-4'>Password:</label> 
                            <input 
                            id="password" 
                            name="password"  
                            type="text" 
                            className={`col-lg-12 border ${isValid.password==null?'':isValid.password?'border border-success':"border border-danger"}`}
                            onBlur={handleBlur} 
                            onChange={(e)=>setPassword(e.target.value)} />

                            <span type="text" id="passwordErrReport">
                                {
                                    isValid.password==false
                                    ?(<small className="text-danger">Invalid password</small>)
                                    :null
                                }

                            </span>
                            {/* <label htmlFor="password" className='col-lg-4'>Password:</label>
                            <input id="password" name="password"  type="password" className='col-lg-12'/>
                            <span type="text" id="passwordErrReport"></span> */}
                        </div>
                        <div className="form-group col-lg-12">
                            <div id="userReport">
                                
                            </div>
                        </div>
                        <div className="form-group w-100 d-flex justify-content-center">
                            <input name="register" type="button" value="Register" id='register' button="register" onClick={validateFormInput}/>
                            {/* <button onClick={validateFormInput}>Register</button> */}
                        </div>
                        <span>If you have an account, <a href="/login">click here</a></span>
                        {isValid === false && (
                            <small className="text-danger">Invalid first name</small>
                        )}
                        {isValid === true && (
                            <small className="text-success">Valid first name</small>
                        )}
                    </form>
                </div>
            </div>
            {/* <div>
            <h2>Ovde je dugme</h2>
            <RegisterButton/>
            </div> */}
        </main>
    );
    
}
export default Register;