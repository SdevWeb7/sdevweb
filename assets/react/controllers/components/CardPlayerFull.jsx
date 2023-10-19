import React from "react";
import ReactPlayer from "react-player";

export function CardPlayerFull ({video}) {

   return (
      <div className={'container-card-player-full'}>
         <h2>{video.title}</h2>

         <p>{video.description}</p>

         <ReactPlayer controls url={video.url} />
      </div>
   )

}