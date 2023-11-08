import React, {useEffect, useState} from 'react'
import {Link, useParams} from "react-router-dom";
import Api from "../../service/Api";
import {Helmet} from "react-helmet";
import ReactPlayer from 'react-player';
import hero from './img/hero.jpg'

const Tutorial = () => {

    const {slug} = useParams()

    const [tutorial, setTutorial] = useState({})
    const [username, setUsername] = useState("")
    const [content, setContent] = useState("")
    const [video, setVideo] = useState(false)

    useEffect(() => {
        const fetchDataFromAPI = async () => {
            try {
                const data = await Api.fetchData(`/api/tutorial/${slug}`);
                setTutorial(data)
            } catch (error) {

            }
        };

        fetchDataFromAPI();
    }, []);

    const loadVideo = () => {
        setVideo(true)
    }

    const test = tutorial[0]

    return (
        <>
            <Helmet>
                <title>DevYourWebsite | Tutorial</title>
            </Helmet>

            {Object.keys(tutorial).length > 0 ? (
                Object.keys(tutorial).map((key) => {
                    const data = tutorial[key];

                    return (
                        <>
                            <div key={tutorial.id} className="tutorial-item">
                                <div className="tutorial-item-title">
                                    <h2>{data.title} </h2>
                                    <span className="buttons-blue">{data.categories.map(category => category.name)}</span>
                                </div>
                                <div className="tutorial-item-video">
                                    {video ? <ReactPlayer
                                            width="100%"
                                            height="100%"
                                            url="https://www.youtube.com/watch?v=fyFnrjC40Lo&list=RDfyFnrjC40Lo&start_radio=1"
                                            controls={true}
                                            playing={true}
                                            volume={0.2}
                                        /> :
                                        <div className="tutorial-load-image" style={{backgroundImage : `url(${hero})`, backgroundRepeat : "no-repeat", backgroundSize : "cover"}}>
                                            <button onClick={loadVideo} className="play-button">▶</button>
                                        </div>
                                    }
                                </div>
                                <div className="tutorial-item-content">
                                    <h2>Description</h2>
                                    <p>{data.content}</p>
                                </div>
                                <div className="tutorial-item-comments">
                                    <h2>
                                       {data.commentaries.length > 1
                                           ?
                                           <h2>{data.commentaries.length} commentaires :</h2>
                                           :
                                           <h2>{data.commentaries.length} commentaire :</h2>}
                                   </h2>
                                   {data.commentaries.map(commentary => (
                                       <>
                                           <hr />
                                           <div className="tutorial-item-comment">
                                               <p>{commentary.users.username}, écrit le </p>
                                               <p className="tutorial-item-commentary">{commentary.content}</p>
                                           </div>
                                       </>
                                   ))}
                                    <hr />
                                    <div className="tutorial-item-form">
                                        <h2>Laisser un commentaire :</h2>
                                        <div className="tutorial-item-form-username">
                                            <label htmlFor="">Nom d'utilisateur</label>
                                            <input onChange={(e) => setUsername(e.target.value)} name="username" type="text"/>
                                        </div>
                                        <div className="tutorial-item-form-message">
                                            <label htmlFor="">Votre message</label>
                                            <textarea onChange={(e) => setContent(e.target.value)} name="comment" id=""></textarea>
                                        </div>
                                        <button className="buttons-blue">ENVOYER</button>
                                    </div>
                                </div>
                            </div>

                        </>
                    );
                })
            ) : (
                <div className="loading-container">
                    <div className="loading-spinner"></div>
                </div>
            )}
        </>
    )
}

export default Tutorial