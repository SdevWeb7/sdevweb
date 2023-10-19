import React, { useEffect, useRef } from "react";

export function MySearch ({toggleSearch}) {

   const searchRef = useRef();
   const inputRef = useRef();

   const event = (e) => {
      if (e.target !== searchRef.current && e.target !== inputRef.current) {
         toggleSearch();
      }
   }
   console.log()

   useEffect(() => {
      setTimeout(() => {
         window.addEventListener('click', event)
      }, 100)
      return () => {
         window.removeEventListener('click', event)
      }
   }, [])

   return (
         <div className={'my-search'} ref={searchRef}>
            <input ref={inputRef} type="text" placeholder='Rechercher' />
         </div>
   )
}