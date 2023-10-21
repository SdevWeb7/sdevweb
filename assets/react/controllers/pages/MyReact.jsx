import React from "react";
import { Await, useParams } from "react-router-dom";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { useFetch } from "../hooks/useFetch";
import { Suspense } from "react";
import { CardPlayerFull } from "../components/CardPlayerFull";

export function MyReact () {
   const param = useParams()
   useDocumentTitle(`React ${param.id}`);

   const {datas, loading, error} = useFetch(`https://localhost:8000/api/reacts/${param.id}`)


   if (error) {
      return <div>Erreur</div>
   }
   if (loading) {
      return <div>Chargement...</div>
   }

   return (
      <>
         <Suspense fallback={<div>Chargement...</div>}>
            <Await resolve={datas} errorElement={<div>Erreur</div>}>
               {datas ? <CardPlayerFull video={datas} /> : 'Erreur de chargement'}
            </Await>
         </Suspense>
      </>
   )
}