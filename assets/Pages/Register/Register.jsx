import React, {useState} from 'react';
import axios from 'axios';

const Register = () => {
    const [email, setEmail] = useState('');
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');

    const handleRegister = async (e) => {
        e.preventDefault();

        if (email !== '' && username !== '' && password !== '' && confirmPassword !== '') {
            if (password === confirmPassword) {
                try {
                    const userData = {
                        email: email,
                        username: username,
                        password: password,
                    };

                    await axios.post('http://127.0.0.1:8001/api/users', userData);

                } catch (error) {
                    console.error(error["request"]["response"]);
                }
            } else {
                console.error('Mot de passe incorrect');
            }
        } else {
            console.error('Erreur');
        }
    };


    return (
        <div className="container text-center mt-5">
            <h1>Inscription</h1>

            <form onSubmit={handleRegister}>
                <input onChange={(e) => setEmail(e.target.value)} type="email" placeholder="Votre email..." /> <br />
                <input onChange={(e) => setUsername(e.target.value)} type="text" placeholder="Votre nom d'utilisateur..." /> <br />
                <input onChange={(e) => setPassword(e.target.value)} type="password" placeholder="Votre mot de passe..." /> <br />
                <input onChange={(e) => setConfirmPassword(e.target.value)} type="password" placeholder="Confirmer mot de passe..." /> <br />

                <button className="btn btn-primary" type="submit">S'inscrire</button>
            </form>
        </div>
    );
};

export default Register;
