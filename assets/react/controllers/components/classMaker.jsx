export function classMaker (target) {

   let classname = ''
   if (location.pathname === target) {
      classname += 'active'
   }
   return classname;
}