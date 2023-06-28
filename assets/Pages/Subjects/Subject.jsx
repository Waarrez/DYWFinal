import React, {useEffect, useState} from 'react'
import {useParams} from "react-router-dom";
import Api from "../../service/Api";
import {Helmet} from "react-helmet";

const Subject = () => {

    const {id} = useParams()

    const [subject, setSubject] = useState([])

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = await Api.fetchData(`http://127.0.0.1:8080/dyw/api/subjects/${id}`);
                setSubject(data)
                // Faire quelque chose avec les données de l'API
            } catch (error) {
                // Gérer l'erreur de requête API
            }
        };

        fetchDataFromAPI();
    }, []);

    return (
        <>
            <Helmet>
                <title>DevYourWebsite | Sujet</title>
            </Helmet>

            <div className="container mt-5 text-center">
                {Object.keys(subject).length > 0 ? (
                    <>
                        <h1>{subject.title} - {subject.categories.map(category => ( <p key={category.id}>{category.name}</p> ))}</h1>
                        <p>{subject.content}</p>
                        <br/>
                        <h2>Commentaires</h2>
                        {subject.commentaries.map(commentary => (
                            <>
                                <p key={commentary.id}>{commentary.users.username} - {commentary.content}</p>
                            </>
                        ))}
                    </>
                ) : (
                    <>
                        <div className="loading-container">
                            <div className="loading-spinner"></div>
                        </div>
                    </>
                )}
            </div>
        </>
    )
}

export default Subject