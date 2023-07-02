import React, {useEffect, useState} from 'react'
import { Helmet } from 'react-helmet';
import Api from "../../service/Api";
import moment from 'moment';
import Links from "../../components/Link/Links";

const Tutorials = () => {

    const [tutorials, setTutorials] = useState([])
    const [query, setQuery] = useState("")

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const url = query ? `http://127.0.0.1:8001/api/tutorials?title=${query}` : 'http://127.0.0.1:8001/api/tutorials';
                const data = await Api.fetchData(url);
                setTutorials(data['hydra:member']);
                // Faire quelque chose avec les données de l'API
            } catch (error) {
                // Gérer l'erreur de requête API
            }
        };

        fetchDataFromAPI();
        const interval = setInterval(fetchDataFromAPI, 10000);

        return () => {
            clearInterval(interval);
        };
    }, [query]);



    const fetchDataQuery = async (query) => {
        try {
            const data = await Api.fetchData(`http://127.0.0.1:8001/api/tutorials?title=${query}`);
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

            <div className="container mt-5 mb-5">
                <input value={query} onChange={handleQuery} type="text"/>
                <h1>Liste des tutoriels</h1>
                {Object.keys(tutorials).length > 0 ? (
                    Object.keys(tutorials).map((key) => {
                        const data = tutorials[key];
                        return (
                            <div key={data.id} className="card">
                                <div className="card-body">
                                    <h4 className="card-title">{data.title}</h4>
                                    <p className="card-text">{data.content}</p>
                                    <p>Date de publication : {moment(data.createdAt).format('YYYY-MM-DD')}</p>
                                    <Links url={`/tutorial/${data.id}`} name="Voir le tutoriel" />
                                </div>
                            </div>
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