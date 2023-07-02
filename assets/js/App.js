import React, {useEffect, useState} from 'react';
import { createRoot } from 'react-dom/client';
import Navbar from "../components/Navbar/Navbar";
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import Home from "../Pages/Home/Home";
import Tutorials from "../Pages/Tutorials/Tutorials";
import Live from "../Pages/Live/Live";
import Tutorial from "../Pages/Tutorials/Tutorial";
import Subjects from "../Pages/Subjects/Subjects";
import Subject from "../Pages/Subjects/Subject";
import "../css/style.css"
import Login from "../Pages/Login/Login";
import Register from "../Pages/Register/Register";
import jwt_decode from "jwt-decode";

const App = () => {

    const [user, setUser] = useState(null);

    useEffect(() => {
        const token = localStorage.getItem('jwtToken');

        if (token) {
            const decodedToken = jwt_decode(token);
            setUser(decodedToken);
        }
    }, []);

    console.log(user)

    return (
       <>
           <Router>
               <Navbar user={user}/>
               <Routes>
                   <Route exact path="/" element={<Home />} />
                   <Route path="/tutorials" element={<Tutorials />} />
                   <Route path="/forum" element={<Subjects/>}/>
                   <Route path="/live" element={<Live />}/>
                   <Route path="/login" element={<Login/>}/>
                   <Route path="/register" element={<Register/>}/>
                   <Route path="/tutorial/:id" element={<Tutorial />}/>
                   <Route path="/subject/:id" element={<Subject />}/>
               </Routes>
           </Router>
       </>
    )
}

createRoot(document.getElementById('root')).render(<App />);