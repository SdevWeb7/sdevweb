import React, { forwardRef, useEffect, useRef } from "react";
import { LinksMenu } from "./LinksMenu";
import { motion } from "framer-motion";

export const MyMenuDeroulant = ({toggleMenu, user, show}) => {

   const menuRef = useRef();
   const event = (e) => {
      if (e.target !== menuRef.current) {
         toggleMenu();
      }
   }

   useEffect(() => {
      setTimeout(() => {
         window.addEventListener('click', event)
      }, 100)
      return () => {
         window.removeEventListener('click', event)
      }
   }, [])

   const variants = {
      hidden: {x: 250, opacity: 0},
      visible: {x: 0, opacity: 1}
   }

   return (
      <MyMenuDeroulantMotion>
         <motion.div className={'my-menu-deroulant'} ref={menuRef} initial={'hidden'} exit={'hidden'} animate={show ? 'visible' : "hidden"} variants={variants} transition={{duration: .3, type: 'tween', ease: "easeInOut"}}>
            <LinksMenu user={user} />
         </motion.div>
      </MyMenuDeroulantMotion>

   )
}


const Box = forwardRef(({children}, ref) => {
   return <div ref={ref}>{children}</div>
})
const MyMenuDeroulantMotion = motion(Box)

