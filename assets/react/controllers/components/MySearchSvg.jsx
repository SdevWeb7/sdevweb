import React, { useState } from "react";
import { MySearch } from "./MySearch";

export function MySearchSvg () {
   let [showSearch, setShowSearch] = useState(false);

   const toggleSearch = () => {
      setShowSearch(v => !v);
   }

   return (
      <>
         <div className="my-search-svg">
            <svg onClick={toggleSearch}><use href="/sprite.svg#search"></use></svg>
         </div>

         {showSearch && <MySearch toggleSearch={toggleSearch} show={showSearch} />}
      </>
   )
}