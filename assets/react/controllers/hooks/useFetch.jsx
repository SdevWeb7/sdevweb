import { useEffect, useState } from "react";

export function useFetch (url, options = {}) {
   const [errors, setErrors] = useState(null);
   const [datas, setDatas] = useState(null);
   const [loading, setLoading] = useState(true);

   useEffect(() => {
      fetch(url, {
         ...options,
         headers: {
            "Accept": 'application/ld+json',
            ...options.headers
         }
      }).then(r => r.json()).then(data => setDatas(data)).catch(e => setErrors(e)).finally(() => setLoading(false));
   }, [url])

   return {
      errors,
      datas,
      loading
   }
}