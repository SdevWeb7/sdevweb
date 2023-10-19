import React from "react";
import { motion } from "framer-motion";
import { useScrollY } from "../hooks/useScrollY";
import { Links } from "./Links";
import { MyBurger } from "./MyBurger";
import { MySearchSvg } from "./MySearchSvg";

export function Header ({user = null}) {

   const {isScrolledTop} = useScrollY({baseState: true});

   const variants = {
      visible: {y: 0},
      hidden: {y: -50}
   }

   return (
      <>
         <motion.header className={'my-header'} animate={isScrolledTop ? "visible" : 'hidden'} variants={variants} transition={{duration: .3, type: 'tween', ease: 'easeInOut'}}>

            <nav className={'my-navbar'}>
               <Links user={user} />
            </nav>

            <hr/>

            <MySearchSvg />

            <MyBurger user={user} />
         </motion.header>
      </>
   )
}
export default Header;