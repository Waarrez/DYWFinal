import React, {useState} from 'react';
import axios from 'axios';

const Register = () => {
    const [email, setEmail] = useState('');
    const [username, setUsername] = useState('');
    const [password, setPassword] = useState('');
    const [confirmPassword, setConfirmPassword] = useState('');
    const [error, setError] = useState("")

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

                    await axios.post('/api/users', userData);

                } catch (error) {
                    if (error.response && error.response.status === 422) {
                        const errorMessage = error.response.data.detail
                        setError("Le nom d'utilisateur est dèja utilisé !");
                        console.log(error)
                    } else {
                        setError('Une erreur s\'est produite lors de la requête.');
                    }
                }
            } else {
                setError('Mot de passe incorrect');
            }
        } else {
            setError('Erreur');
        }
    };

    return (
        <div className="container text-center mt-5">
            <h1>Inscription</h1>

            {error ?
                <div className="alert-error">
                    {error}
                </div>
                :
                ''
            }

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
