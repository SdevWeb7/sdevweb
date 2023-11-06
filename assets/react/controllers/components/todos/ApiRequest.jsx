export async function ApiRequest (method, todo) {

   return new Promise(async (resolve, reject) => {
      try {
         const response = await fetch(`https://127.0.0.1:8000/${method}`, {
            method: 'POST',
            headers: {
               'Content-Type': 'application/json',
               'Accept': 'application/json'
            },
            body: JSON.stringify({ todo: todo })
         })
         resolve(response)
      } catch (e) {
         reject(e)
      }
   });
}