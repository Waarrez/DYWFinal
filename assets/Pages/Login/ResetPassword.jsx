import React from 'react'
import {Helmet} from "react-helmet";

const ResetPassword = () => {
    return (
       <>
           <Helmet>
               <title>DevYourWebsite | Changer le mot de passe</title>
           </Helmet>
           <div className="container mt-5 text-center">
               <h2>Réinitialiser le mot de passe</h2>
           </div>
       </>
    )
}

export default ResetPassword