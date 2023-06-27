import React from 'react'
import {Link} from "react-router-dom";


const Links = (props) => {

    return (
        <>
            <Link to={props.url}>{props.name}</Link>
        </>
    )
}

export default Links