import React from "react";
import { useScrollY } from "../hooks/useScrollY";
import { motion } from "framer-motion";

export function Footer () {
   const {isScrolledTop} = useScrollY({baseState: false});

   const variants = {
      visible: {y: 0},
      hidden: {y: 40}
   }

   return (
      <>
         <motion.footer className={'my-footer'} animate={isScrolledTop ? 'hidden' : 'visible'} variants={variants} transition={{duration: .3, type: 'tween', ease: 'easeInOut'}}>
            <p>Footer</p>
         </motion.footer>
      </>
   )
}
export default Footer;