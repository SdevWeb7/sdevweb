import React, { Suspense } from "react";
import { CardPlayer } from "../components/CardPlayer";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { Await } from "react-router-dom";
import { useFetch } from "../hooks/useFetch";

export function Reacts () {
   useDocumentTitle('Reacts');
   const {datas, loading, error} = useFetch('https://localhost:8000/api/reacts')

   if (error) {
      return <div>Erreur</div>
   }
   if (loading) {
      return <div>Chargement...</div>
   }

   return (
      <>
      <h1>Reacts</h1>

      <div className="container-videos">
         <Suspense fallback={<div>Chargement...</div>}>
            <Await resolve={datas}>
               {datas['hydra:member'] && datas['hydra:member'].map(data => <CardPlayer key={data.id} video={data} />)}
            </Await>
         </Suspense>

      </div>
      </>
   )
}