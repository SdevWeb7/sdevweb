import React, { useEffect, useState } from 'react';
import { motion } from "framer-motion";
import eventBus from "../hooks/eventBus";

export function Toast ({content, duration, color = 'grey'}) {

   const style = {color: color}
   const [open, setOpen] = useState(true)
   const [contents, setContents] = useState(content)

   const handleLikeUpdated = (datas) => {
      setOpen(true)
      setContents(datas)
   }

   useEffect(() => {
      setTimeout(() => {
         setOpen(false)
      }, duration * 1000)

      eventBus.on('likeUpdated', handleLikeUpdated);

      return () => {
         eventBus.off('likeUpdated', handleLikeUpdated);
      }
   }, [open])

   const variants = {
      hidden: {x: -180, opacity: 0},
      visible: {x: 0, opacity: 1}
   }

   return (
   <>
      {contents && contents.length > 0 && <motion.div className="my-toast" style={style} initial={'hidden'} animate={open ? 'visible' : 'hidden'} variants={variants} exit={'hidden'}>
         <button onClick={() => setOpen(false)}>X</button>
         {contents.length > 0 && contents.map(message => <p key={Date.now()}>{message}</p>)}
      </motion.div>}
   </>
   )
}
export default Toast;