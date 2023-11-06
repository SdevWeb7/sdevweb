import React from "react";
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import { Layout } from "./components/Layout";
import { Todos } from "./pages/Todos";
import { Todo } from "./pages/Todo";
import { PageError } from "./pages/PageError";

const App = () => {

   const router = createBrowserRouter([
      {
         path: "/todos",
         element: <Layout />,
         errorElement: <PageError />,
         children: [
            {
               path: "",
               element: <Todos />
            },
            {
               path: ':id',
               element: <Todo />
            }
         ]
      }
   ]);

   return (
      <RouterProvider router={router} />
   )
}
export default App;