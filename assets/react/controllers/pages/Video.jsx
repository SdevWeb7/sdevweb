import { Await, useParams } from "react-router-dom";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { useFetch } from "../hooks/useFetch";
import React, { Suspense } from "react";
import { CardPlayerFull } from "../components/CardPlayerFull";

export function Video () {
   const param = useParams()
   useDocumentTitle(`Video ${param.id}`);

   const {datas, loading, error} = useFetch(`https://localhost:8000/api/videos/${param.id}`)


   if (error) {
      return <div>Erreur</div>
   }
   if (loading) {
      return <div>Chargement...</div>
   }

   return (
      <>
      <h1>Vidéo {param.id}</h1>

         <Suspense fallback={<div>Chargement...</div>}>
            <Await resolve={datas} errorElement={<div>Erreur</div>}>
               {datas ? <CardPlayerFull video={datas} /> : 'Erreur de chargement'}
            </Await>
         </Suspense>
      </>
   )
}