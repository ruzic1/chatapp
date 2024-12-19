import React from 'react';
import { Outlet } from 'react-router-dom';
import Navbar from './Navbar.jsx';

const Layout=()=>{
    return(
        <>
            <header>
                {/* this is where header goes */}
                <Navbar/>
            </header>

            <main >
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