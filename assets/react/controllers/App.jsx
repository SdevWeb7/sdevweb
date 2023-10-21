import React from "react";
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import { Layout } from "./components/Layout";
import { Reacts } from "./pages/Reacts";
import { MyReact } from "./pages/MyReact";
import { PageError } from "./pages/PageError";

const App = () => {

   const router = createBrowserRouter([
      {
         path: "/react-api",
         element: <Layout />,
         errorElement: <PageError />,
         children: [
            {
               path: "",
               element: <Reacts />
            },
            {
               path: ':id',
               element: <MyReact />
            }
         ]
      }
   ]);

   return (
      <RouterProvider router={router} />
   )
}
export default App;