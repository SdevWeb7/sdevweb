import React from "react";
import { NavLink } from "react-router-dom";

export function Links () {
   return (
      <>
         <NavLink to={'/'}>Home</NavLink>
         <NavLink to={'/videos'}>Vidéos</NavLink>
      </>
   )
}