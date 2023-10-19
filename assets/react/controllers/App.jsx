import React from "react";
import { createBrowserRouter, RouterProvider } from "react-router-dom";
import { Layout } from "./components/Layout";
import { Home } from "./pages/Home";
import { Videos } from "./pages/Videos";
import { PageError } from "./pages/PageError";
import { Video } from "./pages/Video";

const App = () => {
   const router = createBrowserRouter([
      {
         path: "/react/",
         element: <Layout />,
         errorElement: <PageError />,
         children: [
            {
               path: "",
               element: <Home />
            },
            {
               path: "videos",
               element: <Videos />,
               children: [
                  {
                     path: '',
                     element: <Videos />
                  }
               ]
            },
            {
               path: 'video/:id',
               element: <Video />
            }
         ]
      }
   ]);

   return (
      <RouterProvider router={router} />
   )
}
export default App;