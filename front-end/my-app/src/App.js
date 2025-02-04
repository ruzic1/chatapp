import logo from './logo.svg';
import ReactDOM from "react-dom/client";
import {BrowserRouter as Router,Routes,Route} from 'react-router-dom';
import { Auth, AuthProvider } from ".//components/AuthenticationState";
import Home from './/components/Home.jsx';
import Layout from './/components/Layout.jsx';
import Login from './components/Login.jsx';
import Register from './/components/Register.jsx';
import Products from './/components/Products.jsx';
import Profile from './/components/Profile.jsx';
import ProtectedRoute from './/components/ProtectedRoute.jsx';
import './App.css';
import Navigation from './/components/Navigation.jsx';
import { useEffect } from 'react';
import { useState } from 'react';


function App() {
  // const [user, setUser] = useState(() => {
  //   const storedUser = sessionStorage.getItem('user');
  //   return storedUser ? JSON.parse(storedUser) : null;
  // });
  // const handleLogin=(e)=>{

  // }
  // useEffect(()=>{
  //   const checkIfSessionIsSet=async()=>{

  //     const response=await fetch('/check-session',{
  //       method:'GET',
  //       headers:{
  //         'Content-Type':'application/json'
  //       }
  //     });
  //     const data=await response.json();
  //     console.log(data);
  //     if(data){
  //       console.log('Sesija postoji');
  //     }else {
  //       console.log('sesija ne postoji');
  //       localStorage.clear();
  //     }

  //   }
  //   checkIfSessionIsSet();

  // })

  return (
    <AuthProvider>
      <Router>
        <Routes>
          <Route path='/' element={<Layout/>}>
            <Route index path='/' element={<Home />}/>
            <Route path='/login' element={<Login/>}/>
            <Route path='/register' element={<Register/>}/>
            <Route path='/products' element={<Products/>}/>
            <Route 
            path='/profile' 
            element={<Profile/>}
            />
            
          </Route>
          
          
        </Routes>
      </Router>
    </AuthProvider>  
    // <>
    // <Navigation/>
    //   <RegistrationLogin/>
    // </>
    // <div className="App">
    //   <header className="App-header">
    //     <img src={logo} className="App-logo" alt="logo" />
    //     <p>
    //       Edit <code>src/App.js</code> and save to reload.
    //     </p>
    //     <a
    //       className="App-link"
    //       href="https://reactjs.org"
    //       target="_blank"
    //       rel="noopener noreferrer"
    //     >
    //       Learn React
    //     </a>
    //   </header>
    // </div>
    
  );
}

export default App;
