import React, { useEffect, useState } from 'react';
import { Helmet } from 'react-helmet';
import axios from 'axios';

const Home = () => {
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
