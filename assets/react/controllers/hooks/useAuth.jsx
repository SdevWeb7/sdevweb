export async function useAuth () {

   try {
      const response = await fetch('https://127.0.0.1:8000/me')
      const datas = await response.json()

      if (datas && datas.username) {
         return datas.username
      }
      return null
   } catch (e) {
      return null
   }

}