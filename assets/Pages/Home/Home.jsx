import React, { useEffect, useState } from 'react';
import { Helmet } from 'react-helmet';
import jwt_decode from 'jwt-decode';

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

            <div>
                <h1>Page Accueil</h1>
            </div>
        </>
    );
};

export default Home;
