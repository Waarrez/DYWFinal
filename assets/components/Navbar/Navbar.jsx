import React, {useEffect, useState} from 'react'
import {Link, useLocation} from "react-router-dom";
import jwt_decode from "jwt-decode";
import "./Navbar.css"

const Navbar = () => {

    const [user, setUser] = useState(null);
    const [navbarAdmin, setNavbarAdmin] = useState(false);
    const location = useLocation();

    useEffect(() => {

        const token = localStorage.getItem('jwtToken');

        if (token) {
            const decodedToken = jwt_decode(token);
            setUser(decodedToken);
        }

        if (location.pathname.includes("/admin")) {
            setNavbarAdmin(true);
        } else {
            setNavbarAdmin(false);
        }
    }, [location.pathname]);

    const handleLogout = () => {
        if (user) {
            localStorage.clear();
            window.location.href = '/';
        }
    };


    return (
        <>
            <header className="navbar">
                <div className="navbar-logo">
                    <Link to="/">DEV<span>YOUR</span>WEBSITE</Link>
                </div>
                <div className="navbar-items">
                    <Link to="/tutorials"><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>TUTORIELS</Link>
                    <Link to="/forum"><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 512 512"><path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z"/></svg>FORUM</Link>
                    <Link to="/live"><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 576 512"><path d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>LIVE</Link>
                    {user ? <Link to="/login"><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>{user.username.toUpperCase()}</Link> : <Link to="/login"><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>CONNEXION</Link>}
                    {user ? <Link onClick={handleLogout} to="/logout"><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 512 512"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"/></svg></Link> : ''}
                </div>
            </header>
        </>
    )
}

export default Navbar