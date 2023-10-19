import React from "react";
import { Outlet } from "react-router-dom";
import { ErrorBoundary } from "react-error-boundary";

export function Layout () {

   return (
      <>
         <ErrorBoundary fallback={<div>Problème...</div>}>
            <Outlet />
         </ErrorBoundary>
      </>
   )
}