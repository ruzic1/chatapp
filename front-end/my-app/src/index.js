import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import 'bootstrap/dist/js/bootstrap.min.js';
import {Auth} from './components/AuthenticationState';
import {BrowserRouter } from 'react-router-dom';

const isDevelopment=process.env.NODE_ENV=='development';
const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  isDevelopment
  ?
    <App />
  :
  <React.StrictMode>
    <App />
  </React.StrictMode>
  // isDevelopment
  // ?
  // <Auth>
  //       <App />
  // </Auth>
  // :
  // <React.StrictMode>
  //     <Auth>
  //       <App />
  //     </Auth>
  // </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
