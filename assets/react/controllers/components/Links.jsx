import React from "react";
import { classMaker } from "./classMaker";

export function Links () {

   return (
      <>
         <a href="/" className={classMaker("/")}>Home</a>
         <a href="/react" className={classMaker("/react")}>Vidéos</a>
   </>
   )

}
