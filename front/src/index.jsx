import ReactDOM from "react-dom";
import React from "react";
import App from './js/components/App.jsx'

const wrapper = document.getElementById("root");
wrapper ? ReactDOM.render(<App />, wrapper) : false;
