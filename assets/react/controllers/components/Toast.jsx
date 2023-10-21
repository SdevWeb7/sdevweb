import React, { useEffect, useState } from 'react';
import { AnimatePresence, motion } from "framer-motion";

export function Toast ({content, duration, color = 'grey'}) {

   const [open, setOpen] = useState(true)
   const style = {color: color}

   useEffect(() => {
      setTimeout(() => {
         setOpen(false)
      }, duration * 1000)
   }, [])

   const variants = {
      hidden: {x: -180, opacity: 0},
      visible: {x: 0, opacity: 1}
   }


   return (
   <AnimatePresence>
         {open &&
            <motion.div className="my-toast" style={style} initial={'hidden'} animate={open ? 'visible' : 'hidden'} variants={variants} exit={'hidden'}>
               <button onClick={() => setOpen(false)}>X</button>
               {content && content.map(message => <p key={Date.now()}>{message}</p>)}
            </motion.div>}
   </AnimatePresence>
   )
}
export default Toast;