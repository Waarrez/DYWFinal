import React, {useEffect, useState} from 'react'
import {useParams} from "react-router-dom";
import Api from "../../../service/Api";
import moment from "moment";
import axios from "axios";

const EditUser = () => {

    const {id} = useParams()

    const [user, setUser] = useState([])

    const [username, setUsername] = useState('')
    const [email, setEmail] = useState('')
    const [createdAt, setCreatedAt] = useState('')

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = await Api.fetchData(`/api/users/${id}`);
                setUser(data)
                setUsername(data.username)
                setEmail(data.email)
                setCreatedAt(data.createdAt)
                // Faire quelque chose avec les données de l'API
            } catch (error) {
                // Gérer l'erreur de requête API
            }
        };

        fetchDataFromAPI();
    }, []);

    const handleSubmit = async (e) => {
        e.preventDefault()

        const updateUser = {
            username,
            email,
            createdAt,
            role : user.role
        }

        try {
            const update = await axios.put(`/api/users/${id}`, updateUser);
            window.location.href = "/admin/users"
            console.log(update)

        } catch (error) {
            // Gérer l'erreur de requête API
        }
    }


    return (
        <>
            {Object.keys(user).length > 0 ? (
                <div className="container mt-5 text-center">
                    <h2>Modifier</h2>
                    <form onSubmit={handleSubmit}>
                        <input onChange={(e)=> setUsername(e.target.value)} type="text" value={username}/> <br/><br/>
                        <input onChange={(e)=> setEmail(e.target.value)} type="email" value={email}/> <br/><br/>
                        <input onChange={(e)=> setCreatedAt(e.target.value)} type="date" value={moment(createdAt).format('YYYY-MM-DD')}/> <br/><br/>
                        <select name="" id="">
                            <option value="ROLE_USER">Utilisateur</option>
                            <option value="ROLE_ADMIN">Administrateur</option>
                        </select> <br/><br/>
                        <button className="btn btn-primary">Modifier</button>
                    </form>
                </div>
            ) : (
                <>
                    <div className="loading-container">
                        <div className="loading-spinner"></div>
                    </div>
                </>
            )}
        </>
    )
}

export default EditUser