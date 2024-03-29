import React, { useEffect, useState } from 'react';
import { Helmet } from 'react-helmet';
import jwt_decode from 'jwt-decode';
import image from "./img/image.png"
import "./Home.css"
import {Link} from "react-router-dom";

const Home = () => {

    const [user, setUser] = useState(null);

    useEffect(() => {
        const token = localStorage.getItem('jwtToken');

        if (token) {
            const decodedToken = jwt_decode(token);
            setUser(decodedToken);
        }
    }, []);

    return (
        <>
            <Helmet>
                <title>DevYourWebsite | Accueil</title>
            </Helmet>

            <div className="home-intro">
                <div className="home-intro-content">
                    <p>Plongez dans l'univers du <br /> développement web et <br /> rejoignez notre <br /> communauté de <br /> passionnés !</p>
                </div>
                <div className="home-intro-buttons">
                    <Link className="buttons-blue" to="/register">Inscrivez-vous dès maintenant !</Link>
                </div>
            </div>

            <div className="home-learn">
                <h2>Apprenez sans dépenser</h2>
                <div className="home-learn-presentation">
                    <div className="home-learn-presentation-content">
                        <div className="home-learn-content-tutorials">
                            <h2>Tutoriels</h2>
                            <p>Apprenez avec des tutoriels interactifs et <br /> amusants pour tous les niveaux.</p>
                        </div>
                        <div className="home-learn-content-forum">
                            <h2>Forum d'entraide</h2>
                            <p>Partagez vos connaissances, posez vos questions et rejoignez des discussions stimulantes.</p>
                        </div>
                        <div className="home-learn-content-live">
                            <h2>Diffusion en direct</h2>
                            <p>Je suis également actif sur le réseau Twitch pour vous partager en direct mes sessions de code autour de différents projets</p>
                        </div>
                    </div>
                    <div className="home-learn-présentation-images">
                        <img src={image} alt=""/>
                    </div>
                </div>
            </div>

            <div className="home-questions">
                <h2>Questions fréquentes</h2>
                <div className="home-questions-content">
                    <div className="home-questions-contents">
                        <h2>Comment m'inscrire ?</h2>
                        <p>Rendez-vous sur la page d'inscription et suivez les instructions pour créer votre compte.</p>
                    </div>
                    <div className="home-questions-contents">
                        <h2>Des connaissances requises ?</h2>
                        <p>Pas du tout ! Nos ressources sont conçues pour accompagner les débutants et les développeurs expérimentés.</p>
                    </div>
                    <div className="home-questions-contents">
                        <h2>Est-ce vraiment gratuit ?</h2>
                        <p>Oui, le contenu de mes vidéos est 100% gratuit pour les membres inscrits.</p>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Home;
