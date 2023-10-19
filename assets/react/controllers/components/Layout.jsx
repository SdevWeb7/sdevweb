import React from "react";
import { Outlet } from "react-router-dom";
import { Header } from "./Header";
import { Footer } from "./Footer";
import { ErrorBoundary } from "react-error-boundary";

export function Layout () {

   return (
      <>
         <Header />

         <div className={'my-container-body'}>
            <ErrorBoundary fallback={<div>Problème...</div>}>
               <Outlet />
            </ErrorBoundary>
         </div>

         <Footer />
      </>
   )
}