import React, {useState} from 'react'
import {Link} from "react-router-dom";
import axios from "axios";

const Navbar = ({user}) => {

    const handleLogout = () => {
        if(user) {
            localStorage.clear()
            window.location.href = '/'
        }
    }

    return (
        <nav className="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div className="container-fluid">
                <a className="navbar-brand" href="#">DevYourWebsite</a>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarColor01">
                    <ul className="navbar-nav me-auto">
                        <li className="nav-item">
                            <Link className="nav-link" to="/">Accueil</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/tutorials">Tutoriels</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/forum">Forum</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/live">Live</Link>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/admin">Admin</Link>
                        </li>
                    </ul>
                    <div className="d-flex">
                        {user ?
                            <>
                                <a className="btn btn-danger" onClick={handleLogout}>Déconnexion</a>
                            </>
                            :
                            <>
                                <a className="btn btn-info" href="/login">Connexion</a>
                                <a className="btn btn-info" href="/register">Inscription</a>}
                            </>
                        }
                    </div>
                </div>
            </div>
        </nav>
    )
}

export default Navbar