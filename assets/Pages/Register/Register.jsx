import React, {useState} from 'react';
import axios from 'axios';

function generateEmailVerificationCode(length) {
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
    let verificationCode = '';

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        verificationCode += characters.charAt(randomIndex);
    }

    return verificationCode;
}

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
                        isVerify : generateEmailVerificationCode(20)
                    };

                    await axios.post('/api/users', userData);

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
