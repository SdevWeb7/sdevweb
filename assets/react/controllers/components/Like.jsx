import React, { useState } from "react";
import eventBus from "../hooks/eventBus";

export function Like ({isLiked, videoId, nbLikes}) {

   const [nbLike, setNbLike] = useState(nbLikes)
   const [liked, setLiked] = useState(isLiked);

   const handleLike = async (e) => {
      e.preventDefault();
      const result = await fetch(`https://127.0.0.1:8000/like/${videoId}`, {
         headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
         },
         credentials: 'include'
      })

      if (!result.ok) {
         eventBus.emit('ToastMessage', ['Problème de connexion']);
      } else {
         const json = await result.json()
         if (typeof json.nbLikes === 'number') {
            setLiked(v => v === 'unlike' ? 'like' : 'unlike')
            setNbLike(json.nbLikes)
            eventBus.emit('ToastMessage', [json.likeState]);
         } else {
            eventBus.emit('ToastMessage', ['Veuillez vous connecter']);
         }
      }
   }

   const icon = `/sprite.svg#svg-${liked}`
   const style = {width: '20px', height: '20px', position: 'absolute', top: '10px', right: '10px', cursor: 'pointer'}
   const nbLikesStyle = {textAlign: 'left', marginLeft: '20px'}


   return (
      <>
         <p style={nbLikesStyle}>{nbLike} Like(s)
         <svg style={style} onClick={handleLike}><use href={icon}></use></svg>
         </p>
      </>
   )
}
export default Like;