import React, { useState } from "react";
import { MyMenuDeroulant } from "./MyMenuDeroulant";
import { AnimatePresence, motion } from "framer-motion";

export const MyBurger = () => {

   let [showMenu, setShowMenu] = useState(false);

   const burgerVariant = {
         visible: {rotate: 0, opacity: 1, transition: {duration: .5}},
         hidden: {rotate: -120, opacity: 0, transition: {duration: .5}}
   }

   const toggleBurger = () => {
      setShowMenu(v => !v);
   }

   return (
      <>
         <div className="my-burger">
            <AnimatePresence>
               {!showMenu && <motion.svg onClick={toggleBurger} animate={!showMenu ? 'visible' : 'hidden'} exit={'hidden'} variants={burgerVariant}><use href="/sprite.svg#my-burger-open"></use></motion.svg>}
            </AnimatePresence>


            <AnimatePresence>
               {showMenu &&
                  <MyMenuDeroulant toggleMenu={toggleBurger} show={showMenu} />}
            </AnimatePresence>
         </div>
      </>
   )
}


