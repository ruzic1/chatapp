import React from 'react';
import { Outlet } from 'react-router-dom';
import Navbar from './Navbar.jsx';

const Layout=({user,onLogout})=>{
    return(
        <>
            <header>
                {/* this is where header goes */}
                <Navbar user={user} onLogout={onLogout}/>
            </header>

            <main style={{height:'100%'}}>
                <Outlet/>
                {/* this is the main section of code*/ }
            </main>

            <footer>
                {/* this is the footer*/ }
                
            </footer>
        </>
    );    
}

export default Layout;