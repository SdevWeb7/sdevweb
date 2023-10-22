import React from "react";
import { useParams } from "react-router-dom";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { useFetch } from "../hooks/useFetch";

export function Todo () {

   const fromUser = useParams()

   useDocumentTitle(`Todo de ${fromUser.id}`);

   const {datas, loading, error} = useFetch(`https://localhost:8000/api/todos/${fromUser.id}`)


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

export default Todo;