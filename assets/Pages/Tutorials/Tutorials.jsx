import React, {useEffect, useState} from 'react'
import { Helmet } from 'react-helmet';
import Api from "../../service/Api";
import "./Tutorial.css"
import {Link} from "react-router-dom";
import slugify from "slugify";

const Tutorials = () => {

    const [tutorials, setTutorials] = useState([])
    const [query, setQuery] = useState("")

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = query ? await Api.fetchData(`/api/tutorials?title=${query}`) : await Api.fetchData('/api/tutorials');

                setTutorials(data['hydra:member']);
                // Faire quelque chose avec les données de l'API
            } catch (error) {
                // Gérer l'erreur de requête API
            }
        };

        fetchDataFromAPI();
    }, [query]);



    const fetchDataQuery = async (query) => {
        try {
            const data = await Api.fetchData(`/api/tutorials?title=${query}`);
            setTutorials(data['hydra:member']);
            // Faire quelque chose avec les données de l'API
        } catch (error) {
            // Gérer l'erreur de requête API
        }
    };

    const handleQuery = (event) => {
        event.preventDefault();
        const query = event.target.value;
        setQuery(query);
        fetchDataQuery(query);
    };


    return (
        <>
            <Helmet>
                <title>DevYourWebsite | Tutorials</title>
            </Helmet>

            <div className="tutorial-intro">
                <h2>Tutoriels</h2>
                <div className="tutorial-content">
                    <p>Apprenez avec des tutoriels interactifs et <br /> amusants pour tous les niveaux.</p>
                </div>
            </div>

            <div className="tutorial-search">
                <input value={query} onChange={handleQuery} type="text" placeholder="Votre recherche..."/>
            </div>
            <div className="tutorials-list">
                {Object.keys(tutorials).length > 0 ? (
                    Object.keys(tutorials).map((key) => {
                        const data = tutorials[key];
                        const numberOfWordsToShow = 150;
                        const contentWords = data.content.split('');
                        const displayedWords = contentWords.slice(0, numberOfWordsToShow);

                        return (
                            <>
                                <Link to={`/tutorial/${data.slug}`}>
                                    <div key={data.id} className="tutorial-card">
                                        <div className="tutorial-card-title">
                                            <h3>{data.title}</h3>
                                            <p>3 min</p>
                                        </div>
                                        <div className="tutorial-card-content">
                                            <p>{displayedWords}...</p>
                                        </div>
                                        <div className="tutorial-card-category">
                                            {data.categories.map(category => (
                                                <>
                                                    <span key={category.id} className="badge-category">{category.name}</span>
                                                </>
                                            ))}

                                        </div>
                                    </div>
                                </Link>
                            </>
                        );
                    })
                ) : (
                    <div className="loading-container">
                        <div className="loading-spinner"></div>
                    </div>
                )}
            </div>
        </>
    )
}

export default Tutorials