import React from 'react'
import { Helmet } from 'react-helmet';
import TwitchEmbedVideo from 'react-twitch-embed-video';

const Live = () => {


    return (
        <div className="container mt-5">
            <TwitchEmbedVideo
                channel="devyourwebsite"
                autoplay={true}
                muted={false}
                height="600"
                width="1200"
                layout="video"
            />
        </div>
    )
}

export default Live