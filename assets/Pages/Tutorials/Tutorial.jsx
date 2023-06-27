import React, {useEffect, useState} from 'react'
import {useParams} from "react-router-dom";
import Api from "../../service/Api";

const Tutorial = () => {

    const {id} = useParams()

    const [tutorial, setTutorial] = useState([])
    const [editForm, setEditForm] = useState(false)

    const handleForm = ()  => {
        setEditForm(!editForm)
    }

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = await Api.fetchData(`http://127.0.0.1:8080/dyw/api/tutorials/${id}`);
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
            {
                editForm ?
                    <>
                        <div className="container text-center mt-5">
                            <form action="">
                                <input type="text" value={tutorial.title}/> <br/>
                                <button onClick={handleForm}>Enregistrer les modifications</button>
                            </form>
                        </div>
                    </>
                :

                <>
                    <h1>{tutorial.title}</h1>
                    <button onClick={handleForm}>Modifier le tutorial</button>
                </>

            }


        </>
    )
}

export default Tutorial