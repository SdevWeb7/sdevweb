import React from "react";
import { useEffect, useState } from "react";

export function useScrollY ({baseState}) {
   const [baseScroll, setBaseScroll] = useState(0);
   const [isScrolledTop, setIsScrolledTop] = useState(baseState)

   const handleScroll = () => {
      const currentY = window.scrollY;

      if (currentY > baseScroll) {
         setIsScrolledTop(false);
      } else {
         setIsScrolledTop(true);
      }
      setBaseScroll(currentY)
   }

   useEffect(() => {
      window.addEventListener('scroll', handleScroll)

      return () => {
         window.removeEventListener('scroll', handleScroll)
      }
   }, [baseScroll])

   return {
      isScrolledTop
   }
}