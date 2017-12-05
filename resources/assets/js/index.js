require('./bootstrap');
import React from 'react';
import ReactDOM from 'react-dom';
import App from './App';

const app = (
    <App />
);

let el = document.getElementById('root');
if(el){
    ReactDOM.render(app, document.getElementById('root'));
}