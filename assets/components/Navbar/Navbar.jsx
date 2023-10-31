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
            {navbarAdmin ?
                <>

                </>
                :
                <>
                    <header className="navbar">
                        <div className="navbar-logo">
                            <a>DEV<span>YOUR</span>WEBSITE</a>
                        </div>
                        <div className="navbar-items">
                            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg>ACCUEIL</a>
                            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 576 512"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg>TUTORIELS</a>
                            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 512 512"><path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z"/></svg>FORUM</a>
                            <a href=""><svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 576 512"><path d="M0 128C0 92.7 28.7 64 64 64H320c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2V384c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1V320 192 174.9l14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>LIVE</a>
                        </div>
                    </header>
                </>

            }
        </>
    )
}

export default Navbar