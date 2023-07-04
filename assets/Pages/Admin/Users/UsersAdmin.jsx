import React, {useEffect, useState} from 'react'
import Api from "../../../service/Api";
import moment from "moment/moment";
import Links from "../../../components/Link/Links";
import axios from "axios";

const UsersAdmin = () => {

    const [users, setUsers] = useState([])

    useEffect(() => {

        const fetchDataFromApi = async () => {
            try {
                const url = '/api/users'
                const data = await Api.fetchData(url)
                setUsers(data['hydra:member'])
            } catch (error) {

            }
        }

        fetchDataFromApi()

        const interval = setInterval(fetchDataFromApi, 10000);

        return () => {
            clearInterval(interval);
        };

    }, [])

    console.log(users)

    const handleDelete = async () => {
        try {
            await axios.delete(`/api/users/${id}`);
            // Faire quelque chose après la suppression réussie
            console.log('Utilisateur supprimé');
        } catch (error) {
            // Gérer l'erreur de requête API
        }
    };

    return (
        <>
            <div className="container mt-5 text-center">
                <h1>Touts les utilisateurs</h1> <br/>

                {Object.keys(users).length > 0 ? (
                    Object.keys(users).map((key) => {
                        const data = users[key];
                        return (
                            <div key={data.id} className="card">
                                <div className="card-body">
                                    <h4 className="card-title">{data.email}</h4>
                                    <p className="card-text">{data.username}</p>
                                    <p>
                                        {data.roles[0] === "ROLE_ADMIN" ? <span className="badge bg-success">Administrateur</span> : <span className="badge bg-primary">Utilisateur</span>}
                                    </p>
                                    <p>Date de création : {moment(data.createdAt).format('YYYY-MM-DD')}</p>
                                    <Links url={`/admin/user/${data.id}`} name="Modifier l'utilisateur"/> <br/><br/>
                                    <a className="btn btn-danger" onClick={handleDelete} href="">Supprimer</a>
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

export default UsersAdmin