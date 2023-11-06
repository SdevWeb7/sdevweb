import React, { useEffect, useState } from "react";
import { classMaker } from "../classMaker";
import { useAuth } from "../../hooks/useAuth";

export function LinksMenu () {

   const [user, setUser] = useState(null)

   useEffect(() => {
      useAuth().then(r => setUser(r))
   }, [])

   return (
      <>
         <a href="/" className={classMaker("/")}>Home</a>
         <a href="/videos" className={classMaker("/videos")}>Vidéos</a>
         <a href="/todos" className={classMaker("/todos")}>Todos</a>

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