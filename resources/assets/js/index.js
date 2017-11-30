require('./bootstrap');

import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter } from 'react-router-dom';

import App from './App';

const app = (
    <BrowserRouter>
        <App />
    </BrowserRouter>
);

let el = document.getElementById('root');
if(el){
    ReactDOM.render(app, document.getElementById('root'));
}