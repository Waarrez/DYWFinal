import React, {useEffect, useState} from 'react'
import { Helmet } from 'react-helmet';
import Api from "../../service/Api";
import moment from 'moment';
import Links from "../../components/Link/Links";

const Tutorials = () => {

    const [tutorials, setTutorials] = useState([])

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = await Api.fetchData('http://127.0.0.1:8080/dyw/api/tutorials');
                setTutorials(data['hydra:member'])
                // Faire quelque chose avec les données de l'API
            } catch (error) {
                // Gérer l'erreur de requête API
            }
        };

        fetchDataFromAPI();
        const interval = setInterval(fetchDataFromAPI, 10000)

        return () => {
            clearInterval(interval)
        }
    }, []);

    return (
        <>
            <Helmet>
                <title>DevYourWebsite | Tutorials</title>
            </Helmet>

            <div className="container mt-5 mb-5">
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