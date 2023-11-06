import React, { useState } from "react";
import eventBus from "../hooks/eventBus";

export function Like ({isLiked, videoId, nbLikes}) {

   const [nbLike, setNbLike] = useState(nbLikes)
   const [liked, setLiked] = useState(isLiked);

   const icon = `/sprite.svg#svg-${liked}`
   const style = {width: '20px', height: '20px', position: 'absolute', top: '10px', right: '10px', cursor: 'pointer'}
   const nbLikesStyle = {textAlign: 'left', marginLeft: '20px'}


   const handleLike = async (e) => {
      e.preventDefault();
      const result = await fetch(`https://127.0.0.1:8000/like/${videoId}`, {
         method: 'POST',
         headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
         }
      })

      if (!result.ok) {
         eventBus.emit('ToastMessage', ['Problème de connexion']);
      } else {
         const json = await result.json()
         if (json.length === 0) {
            eventBus.emit('ToastMessage', ['Veuillez vous connecter']);
         } else {
            setLiked(v => v === 'unlike' ? 'like' : 'unlike')
            setNbLike(json.nbLikes)
            eventBus.emit('ToastMessage', [json.likeState]);
         }
      }
   }

   return (
      <>
         <p style={nbLikesStyle}>{nbLike} Like(s)
         <svg style={style} onClick={handleLike}><use href={icon}></use></svg>
         </p>
      </>
   )
}
export default Like;