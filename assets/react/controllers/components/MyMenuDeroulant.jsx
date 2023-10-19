import React, { useEffect, useRef } from "react";
import { Links } from "./Links";


export const MyMenuDeroulant = ({toggleMenu, user}) => {

   const menuRef = useRef();
   const event = (e) => {
      if (e.target !== menuRef.current) {
         toggleMenu();
      }
   }

   useEffect(() => {
      setTimeout(() => {
         window.addEventListener('click', event)
      }, 100)
      return () => {
         window.removeEventListener('click', event)
      }
   }, [])

   return (
         <div className={'my-menu-deroulant'} ref={menuRef}>
            <Links menu={'yes'} user={user} />
         </div>
   )
}