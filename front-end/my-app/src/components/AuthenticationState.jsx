import { createContext,useEffect,useState } from "react";
import { useNavigate } from "react-router-dom";
// import { useState } from "react";

export const AuthContext=createContext();
export const AuthProvider=({children})=>{
  // const [user,setUser]=useState(()=>{
  //   const storedUser = sessionStorage.getItem('user');
  //   return storedUser ? JSON.parse(storedUser) : null;
  // });

  const [user,setUser]=useState(null);

  // useEffect(()=>{
  //   const storedUser=sessionStorage.getItem('user');
  //   console.log(JSON.stringify(storedUser));

  // },[]);
  useEffect(()=>{
    const storedUser=sessionStorage.getItem('user');
    if(storedUser){
      setUser(JSON.parse(storedUser));
    }
  },[]);


  const login=async(email,password)=>{
    const response=await fetch('/login-processing',{
      method:'POST',
      headers:{
        'Content-Type':'application/json'
      },
      body:JSON.stringify(email,password)
    })
    if(response.ok){
      // console.log(await response.json())
      const data=await response.json();
      setUser(data.user);
      sessionStorage.setItem('user',(JSON.stringify(data.user)));
      return data;
    }
    // console.log('Data is this:'+response.json());
  }

  const logout=async()=>{
    const response=await fetch('/logout');
    if(response.ok){
      setUser(null);
      sessionStorage.removeItem('user');
      return true;
      // console.log(await response.json());
    }
    // console.log(response);
  }


  // useEffect(() => {
  //   const checkSession = async () => {
  //       const storedUser = localStorage.getItem('user');
  //       if (storedUser) {
  //           setUser(JSON.parse(storedUser));
  //       } else {
  //           try {
  //               const response = await fetch('/check-session', { credentials: 'include' });
  //               const data = await response.json();
  //               if (data.user) {
  //                   console.log('Session is successfully set')
  //                   setUser(data.user);
  //                   localStorage.setItem('user', JSON.stringify(data.user));
  //               }else{
  //                 setUser(null);
  //                 localStorage.removeItem('user');
  //                 console.log('Session is successfully logged out')
  //               }
  //           } catch (error) {
  //               console.error('Session check failed:', error);
  //               localStorage.removeItem('user');
  //               setUser(null);
  //           }
  //       }
  //   };
  //   checkSession();
  // }, []);

  // const login = async (email, password) => {
  //   const response = await fetch('/login-processing', {
  //     method: 'POST',
  //     headers: { 'Content-Type': 'application/json' },
  //     body: JSON.stringify({ email, password }),
  //   });

  //   const data=await response.json();
  //   console.log('Ovo je poruka od logina:'+data.success);

  // };
  // const logout = async() => {

  // };
  
  return (
    <AuthContext.Provider value={{user,login,logout}}>
      {children}
    </AuthContext.Provider>
  )
}
