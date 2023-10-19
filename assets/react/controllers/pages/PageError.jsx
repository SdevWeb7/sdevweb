import React from "react";
import { useRouteError } from "react-router-dom";

export function PageError () {

   const error = useRouteError()

   return (
      <>
         <h1>Une erreur est survenue</h1>
         <p>{error?.error?.toString() ?? error?.toString()}</p>
      </>
   )
}