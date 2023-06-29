import React, {useState} from 'react'
import {Link} from "react-router-dom";
import axios from "axios";

const Navbar = () => {

    const [isLogin, setIsLogin] = useState();

    const fetchSessionData = async () => {
        try {
            const response = await axios.get('/api/session');
            setIsLogin(response.data);
            // Utilisez les données de session comme bon vous semble
        } catch (error) {
            console.error(error);
        }
    };

    // Appelez la fonction pour récupérer les données de session
    fetchSessionData();

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
                    </ul>
                    <div className="d-flex">
                        {isLogin ?
                            <>
                                <a className="btn btn-info" href="">Mon profil</a>
                                <a className="btn btn-danger" href="/logout">Déconnexion</a>
                            </> :

                            <>
                                <a className="btn btn-info" href="/login">Connexion</a>
                                <a className="btn btn-info" href="">Inscription</a>
                            </>
                        }
                    </div>
                </div>
            </div>
        </nav>
    )
}

export default Navbar