import React from "react";
import { motion } from "framer-motion";
import { useScrollY } from "../../hooks/useScrollY";
import { Links } from "./Links";
import { MyBurger } from "./MyBurger";
import { MySearchSvg } from "./MySearchSvg";

export function Header () {

   const {isScrolledTop} = useScrollY({baseState: true});

   const variants = {
      visible: {y: 0},
      hidden: {y: -70}
   }

   return (
      <>
         <motion.header className={'my-header'} animate={isScrolledTop ? "visible" : 'hidden'} variants={variants} transition={{duration: .3, type: 'tween', ease: 'easeInOut'}}>

            <nav className={'my-navbar'}>
               <Links />
            </nav>


            <div className="header-right-side">
               <hr/>
               <MySearchSvg />
               <MyBurger />
            </div>

         </motion.header>
      </>
   )
}
export default Header;