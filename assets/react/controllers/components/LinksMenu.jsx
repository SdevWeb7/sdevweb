import { classMaker } from "./classMaker";
import React from "react";

export function LinksMenu ({user}) {

   return (
      <>
         <a href="/" className={classMaker("/")}>Home</a>
         <a href="/react" className={classMaker("/react")}>Vidéos</a>

         {user ?
            <>
               <a href="/logout" className={classMaker('/logout')}>Déconnexion</a>
            </> :
            <>
               <a href="/login" className={classMaker("/login")}>Connexion</a>
               <a href="/register" className={classMaker("/register")}>Inscription</a>
            </>
         }
      </>
   )
}