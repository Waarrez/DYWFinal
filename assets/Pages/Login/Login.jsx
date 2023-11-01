import React, {useState} from "react";
import axios from "axios";
import {Link} from "react-router-dom";

const Login = () => {

    if(localStorage.getItem('jwtToken')) {
        window.location.href = '/'
    }

    const [username, setUsername] = useState('')
    const [password, setPassword] = useState('')

    const handleLogin = async (e) => {
        e.preventDefault()

        if(username !== '' && password !== '') {
            if(localStorage.getItem('jwtToken')) {
                console.log('Vous êtes déja connecté')
            } else {
                try {
                    const response = await axios.post('/api/login_check', {
                        username,
                        password
                    })

                    const token = response.data.token
                    localStorage.setItem('jwtToken', token)
                    window.location.href = '/'
                } catch (error) {
                    console.error(error)
                    window.location.href = '/login'
                }
            }
        } else {
            console.log('Merci de remplir les champs')
        }

    }

    return (
        <div className="container mt-5 text-center">
            <h2>Connexion</h2>
            <form onSubmit={handleLogin}>
                <label>Utilisateur</label> <br/>
                <input type="text" placeholder="Votre nom d'utilisateur..." value={username} onChange={(e) => setUsername(e.target.value)}/>
                <label htmlFor="">Mot de passe</label>
                <input type="password" placeholder="Votre mot de passe..." value={password} onChange={(e) => setPassword(e.target.value)}/>

                <Link to="/reset-password">Mot de passe oublié ?</Link>
                <button type="submit" className="btn btn-primary">Se connecter</button>
            </form>
        </div>
    )
}

export default Login