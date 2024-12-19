import logo from './logo.svg';
import ReactDOM from "react-dom/client";
import {BrowserRouter as Router,Routes,Route} from 'react-router-dom';
import Home from './/components/Home.jsx';
import Layout from './/components/Layout.jsx';
import Login from './/components/Login.jsx';
import Register from './/components/Register.jsx';
import './App.css';
import Navigation from './/components/Navigation.jsx';


function App() {
  return (
    <Router>
      <Routes>
        <Route path='/' element={<Layout />}>
          <Route index path='/' element={<Home />}/>
          <Route path='/login' element={<Login/>}/>
          <Route path='/register' element={<Register/>}/>
        </Route>
        
        
      </Routes>
    </Router>
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
