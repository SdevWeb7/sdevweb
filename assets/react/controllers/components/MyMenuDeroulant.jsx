import React, { useEffect, useRef } from "react";
import { LinksMenu } from "./LinksMenu";


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
            <LinksMenu user={user} />
         </div>
   )
}