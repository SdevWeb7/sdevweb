import React, { useState } from "react";

export function FilterTodos ({filterTodos, clearTodos}) {

   const [filterState, setFilterState] = useState('all')

   const handleFilter = (filter) => {
      filterTodos(filter)
      setFilterState(filter)
   }

   return (
      <div className="filter-todos">
         <button className={`all-todo ${filterState === 'all' ? 'active' : ''}`} onClick={()=> handleFilter('all')}>All</button>

         <button className={`all-to-do ${filterState === 'todo' ? 'active' : ''}`} onClick={()=> handleFilter('todo')}>Todos</button>

         <button className={`all-completed ${filterState === 'completed' ? 'active' : ''}`} onClick={() => handleFilter('completed')}>Completed</button>

         <button onClick={() => clearTodos()}>Clear</button>
      </div>
   )
}