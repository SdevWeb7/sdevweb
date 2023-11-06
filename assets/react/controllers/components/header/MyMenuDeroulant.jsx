import React, { forwardRef, useEffect, useRef } from "react";
import { LinksMenu } from "./LinksMenu";
import { motion } from "framer-motion";
import { createPortal } from "react-dom";

export const MyMenuDeroulant = ({toggleMenu, show}) => {

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
   const burgerVariantClose = {
      visible: {rotate: 0, opacity: 1, transition: {duration: .7}},
      hidden: {rotate: 120, opacity: 0, transition: {duration: .7}}
   }

   return createPortal(
      <MyMenuDeroulantMotion>
         <motion.div className={'my-menu-deroulant'} ref={menuRef} initial={'hidden'} exit={'hidden'} animate={show ? 'visible' : "hidden"} variants={variants} transition={{duration: .3, type: 'tween', ease: "easeInOut"}}>

         <motion.svg initial={'hidden'} animate={show ? 'visible' : 'hidden'} variants={burgerVariantClose}><use href="/sprite.svg#my-burger-close"></use></motion.svg>

            <LinksMenu />

         </motion.div>
      </MyMenuDeroulantMotion>, document.body)
}

const Box = forwardRef(({children}, ref) => {
   return <div ref={ref}>{children}</div>
})
const MyMenuDeroulantMotion = motion(Box)

