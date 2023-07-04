import React, {useEffect, useState} from 'react'
import {useParams} from "react-router-dom";
import Api from "../../service/Api";
import {Helmet} from "react-helmet";
import ReactPlayer from 'react-player';

const Tutorial = () => {

    const {id} = useParams()

    const [tutorial, setTutorial] = useState([])

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = await Api.fetchData(`/api/tutorials/${id}`);
                setTutorial(data)
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
                <title>DevYourWebsite | Tutorial</title>
            </Helmet>
            
           <div className="container mt-5 text-center">
               
               {Object.keys(tutorial).length > 0 ? (
                   <>
                        <h1>{tutorial.title} - {tutorial.categories.map(category => ( <p key={category.id}>{category.name}</p> ))}</h1>
                        <p>{tutorial.content}</p>
                        <br/>
                        <div className="d-flex justify-center">
                            <ReactPlayer url="https://www.youtube.com/watch?v=SAaqHJbEPW8" controls={true} />
                        </div>

                        <br/>

                        <h2>Commentaires</h2>
                       {tutorial.commentaries.map(commentary => (
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

export default Tutorial