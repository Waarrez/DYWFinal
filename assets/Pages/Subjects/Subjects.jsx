import React, {useEffect, useState} from 'react'
import { Helmet } from 'react-helmet';
import Api from "../../service/Api";
import moment from 'moment';
import Links from "../../components/Link/Links";

const Subjects = () => {

    const [subjects, setSubjects] = useState([])

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = await Api.fetchData('http://127.0.0.1:8001/dyw/api/subjects');
                setSubjects(data['hydra:member'])
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
                <h1>Liste des sujets</h1>
                {Object.keys(subjects).length > 0 ? (
                    Object.keys(subjects).map((key) => {
                        const data = subjects[key];
                        return (
                            <div key={data.id} className="card">
                                <div className="card-body">
                                    <h4 className="card-title">{data.title}</h4>
                                    <p className="card-text">{data.content}</p>
                                    <p>Date de publication : {moment(data.createdAt).format('YYYY-MM-DD')}</p>
                                    <Links url={`/subject/${data.id}`} name="Voir le sujet" />
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

export default Subjects