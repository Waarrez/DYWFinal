import React, {useEffect, useState} from 'react'
import {Link, useLocation} from "react-router-dom";
import jwt_decode from "jwt-decode";

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
                <nav className="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
                    <div className="container-fluid">
                        <a className="navbar-brand" href="#">DevYourWebsite | Admin</a>
                        <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span className="navbar-toggler-icon"></span>
                        </button>
                        <div className="collapse navbar-collapse" id="navbarColor01">
                            <ul className="navbar-nav me-auto">
                                <li className="nav-item">
                                    <Link className="nav-link" to="/admin/users">Utilisateurs</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/admin/tutorials">Tutoriels</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/admin/subjects">Sujets</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/admin/subjects">Tickets</Link>
                                </li>
                                <li className="nav-item">
                                    <Link className="nav-link" to="/admin/categories">Catégories</Link>
                                </li>
                            </ul>
                            <div className="d-flex">
                                <Link to="/">Retour à l'accueil</Link>
                            </div>
                        </div>
                    </div>
                </nav>
            </> :
                <>

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
                                    {user ?
                                        <li className="nav-item">
                                            {user.roles[0] === "ROLE_ADMIN" ? <Link className="nav-link" to="/admin">Admin</Link> : ''}
                                        </li>
                                        :
                                        <>

                                        </>
                                    }
                                </ul>
                                <div className="d-flex">
                                    {user ?
                                        <>
                                            <Link className="btn btn-primary" >Mon profil :  {user.username} </Link>
                                            <Link className="btn btn-danger" onClick={handleLogout}>Déconnexion</Link>
                                        </>
                                        :
                                        <>
                                            <Link className="btn btn-info" to="/login">Connexion</Link>
                                            <Link className="btn btn-info" to="/register">Inscription</Link>
                                        </>
                                    }
                                </div>
                            </div>
                        </div>
                    </nav>
                </>

            }
        </>
    )
}

export default Navbar