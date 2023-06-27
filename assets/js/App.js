import React from 'react';
import { createRoot } from 'react-dom/client';
import Navbar from "../components/Navbar/Navbar";
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Home from "../Pages/Home/Home";
import Tutorials from "../Pages/Tutorials/Tutorials";
import Live from "../Pages/Live/Live";
import Tutorial from "../Pages/Tutorials/Tutorial";

const App = () => {
    return (
       <>
           <Router>
               <Navbar />
               <Routes>
                   <Route exact path="/" element={<Home />} />
                   <Route path="/tutorials" element={<Tutorials />} />
                   <Route path="/forum"/>
                   <Route path="/live" element={<Live />}/>
                   <Route path="/tutorial/:id" element={<Tutorial />}/>
               </Routes>
           </Router>
       </>
    )
}

createRoot(document.getElementById('root')).render(<App />);