import React from "react";
import { useScrollY } from "../hooks/useScrollY";
import { motion } from "framer-motion";
import { classMaker } from "./classMaker";

export function Footer ({user}) {
   const {isScrolledTop} = useScrollY({baseState: false});

   const variants = {
      visible: {y: 0},
      hidden: {y: 40}
   }

   return (
      <>
         <motion.footer className={'my-footer'} animate={isScrolledTop ? 'hidden' : 'visible'} variants={variants} transition={{duration: .3, type: 'tween', ease: 'easeInOut'}}>
            <hr />

            <div className="footer-container">

               {user ?
                  <>
                     <a href="/logout"><svg><use href="/sprite.svg#svg-logout"></use></svg></a>
                     <a href="#">{user}</a>
                  </> :
                  <>
                     <a href="/register" className={classMaker('/register')}>Inscription</a>
                     <a href="/login" className={classMaker('/login')}>Connexion</a>
                  </>
               }
            </div>
         </motion.footer>
      </>
   )
}
export default Footer;