import React from "react";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { useFetch } from "../hooks/useFetch";

export function Todos () {

   useDocumentTitle('Todos');

   const {datas, loading, error} = useFetch('https://localhost:8000/api/todos')

   if (error) {
      return <div>Erreur</div>
   }
   if (loading) {
      return <div>Chargement...</div>
   }

   return (
      <>
      </>
   )
}
export default Todos;