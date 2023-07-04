import React, { useEffect, useState } from 'react';
import jwt_decode from "jwt-decode";

const Admin = () => {
    const [user, setUser] = useState(null);
    const [isAdmin, setIsAdmin] = useState(false);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        const token = localStorage.getItem('jwtToken');

        if (token) {
            const decodedToken = jwt_decode(token);
            setUser(decodedToken);

            if (decodedToken.roles && decodedToken.roles.includes("ROLE_ADMIN")) {
                setIsAdmin(true);
            } else {
                window.location.href = "/";
            }
        } else {
            window.location.href = "/";
        }

        setLoading(false);
    }, []);

    if (loading) {
        return <div>Loading...</div>;
    }

    if (!isAdmin) {
            return null; // or display a message or redirect to a different page
    }

    return (
        <div className="container mt-5 text-center">
            <h2>Page d'administration</h2>
        </div>
    );
}

export default Admin;
