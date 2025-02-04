import React, { useContext, useEffect, useState } from 'react';
import {Link,useNavigate} from 'react-router-dom';
import { AuthContext } from './AuthenticationState';
// import { Auth, AuthContext } from './AuthenticationState';
import { useAuth } from './AuthenticationState';


// AuthContext
const Navbar=()=>{
    const {user,logout}=useContext(AuthContext);
    const navigate=useNavigate();
    // const [userFromSession,setUserFromSession]=useState(null);
    // useEffect(()=>{
    //         if(sessionStorage.getItem('user')){
    //             console.log('ISPRAVNI NAVBAR')
    //             setUserFromSession(JSON.parse(sessionStorage.getItem('user')));
    //         }else{
    //             console.log('NAVBAR')
    //             sessionStorage.removeItem('user');
    //             setUserFromSession(null);
    //         }

    // },[])
    // const {user,checkSession,logout}=useContext(AuthContext);
    
    // checkSession()
    // .then((res)=>{
    //     console.log(res);
    // })
    // .catch((err)=>{

    // })
    // console.log(checkSession().);
    // useEffect(()=>{
    //     const verifySession=async ()=>{
    //         await checkSession();
    //     }
    //     verifySession();
    // },[]);
    // console.log(user);
    // console.log(JSON.parse(user));
    // checkSession()
    // .then((res)=>{
    //     console.log(res);
    //     if(res){
    //         // localStorage.setItem()
    //     }
    // })
    // .catch((err)=>{
    //     console.log(err);
    // })
    // useEffect(()=>{
    //     console.log(localStorage.getItem('user'));
    //     checkSession()
    //     .then((res)=>{
    //         console.log(res);
    //     })
    //     .catch((err)=>{

    //     })

    // },[])
    
    
    // useEffect(()=>{
    //     checkSession()
    //     .then((response)=>{
    //         console.log(response);
    //     })
    //     .catch((err)=>{

    //     })

    // },[]);
    // const abc=checkSession();
    // console.log(abc);
    // const {user,checkSession}=useContext(AuthContext);
    // console.log(localStorage.getItem('user'));
    // checkSession()
    // .then((result)=>{
    //     console.log(result);
    // })
    // .catch((err)=>{

    // })
    
    const handleLogout=async(e)=>{

        
        e.preventDefault();
        const callForContext=await logout();
        console.log(callForContext);
        if(callForContext){
            navigate('/login');
        }
        // console.log(callForContext);
        // if(response.ok){
        //     sessionStorage.removeItem('user');

        //     navigate('/login');
        // }
        // console.log(sessionStorage.getItem('user'));
        // if(response.ok){
        //     setUser(null);
        //     localStorage.removeItem('user');
        //     console.log('uspesno prekidanje sesije, kao i brisanje korisnika iz localStoragea')
        //     navigate('/login');

        // }
    }
    // if(!user){
    //     return <p>Loading...</p>
    // }
    return(
        <nav className="navbar navbar-expand-lg navbar-light bg-light">
            <div className="container-fluid">
                <Link className="navbar-brand" to="/">
                MyApp
                </Link>
                <button
                className="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul className="navbar-nav">
                        {
                            user
                            
                            ?(
                                <>
                                    <li className="nav-item">
                                        <Link className="nav-link" to="/profile">
                                            {JSON.parse(JSON.stringify(user.email))}
                                        </Link>
                                    </li>
                                    <li className="nav-item">
                                        <Link className="nav-link" onClick={(e)=>handleLogout(e)}>
                                            Logout
                                        </Link>
                                    </li>
                                </>
                            )
                            :(
                                
                                <>
                                    <li className="nav-item">
                                        <Link className="nav-link" to="/login">
                                            Login
                                        </Link>
                                    </li>
                                    <li className="nav-item">
                                        <Link className="nav-link" to="/register">
                                            Register
                                        </Link>
                                    </li>
                                </>
                            )
                        }
                        {/* <li className="nav-item">
                            <Link className="nav-link" to="/login">
                                Login
                            </Link>
                            </li>
                            <li className="nav-item">
                            <Link className="nav-link" to="/register">
                                Register
                            </Link>
                        </li> */}
                        
                        <li className='nav-item'>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}
export default Navbar;