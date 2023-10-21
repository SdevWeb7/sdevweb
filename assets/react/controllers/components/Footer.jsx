import React, { useEffect, useState } from "react";
import { useScrollY } from "../hooks/useScrollY";
import { motion } from "framer-motion";
import { classMaker } from "./classMaker";

export function Footer ({user, themeSombre, admin}) {
   const {isScrolledTop} = useScrollY({baseState: false});
   const [iconTheme, setIconTheme] = useState(themeSombre? 'sun' : 'moon')

   const variants = {
      visible: {y: 0},
      hidden: {y: 40}
   }

   const handleTheme = () => {
      setIconTheme(v => v === 'moon' ? 'sun' : 'moon')
      document.querySelector('#html-theme').classList.toggle('dark-theme')

      if (document.cookie.includes('modeSombre=active')) {
         document.cookie = 'modeSombre=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
      } else {
         document.cookie = 'modeSombre=active; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';
      }
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

                     {admin && <>
                        <a href={'/admin'}>Admin</a>
                        <a href="/react-api" className={classMaker("/react-api")}>React</a>
                     </>}
                     <svg className={'svg-theme'} onClick={handleTheme}><use href={`/sprite.svg#icon-${iconTheme}`}></use></svg>
                  </> :
                  <>
                     <a href="/register" className={classMaker('/register')}>Inscription</a>
                     <a href="/login" className={classMaker('/login')}>Connexion</a>
                     <svg className={'svg-theme'} onClick={handleTheme}><use href={`/sprite.svg#icon-${iconTheme}`}></use></svg>
                  </>
               }
            </div>
         </motion.footer>
      </>
   )
}
export default Footer;