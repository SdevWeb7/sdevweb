import React from "react";
import { MySearchSvg } from "./MySearchSvg";

export function Links ({user, menu = null}) {

   if (!menu) {
      return (
         <>
            <a href="/">Home</a>
            <a href="/react">Vidéos</a>

            <div className="profil-nav">

            {user ?
               <>
                  <p>{user}</p>
                  <a href="/logout"><svg><use href="/sprite.svg#svg-logout"></use></svg></a>
               </> :
                  <>
                     <a href="/register">Inscription</a>
                     <a href="/login">Connexion</a>
                  </>
               }
            </div>
         </>
      )
   } else {
      return (
         <>
            <a href="/">Home</a>
            <a href="/react">Vidéos</a>

            {user ?
               <>
                  <a href="/logout">Déconnexion</a>
               </> :
               <>
                  <a href="/register">Inscription</a>
                  <a href="/login">Connexion</a>
               </>
            }
      </>
      )
   }

}
