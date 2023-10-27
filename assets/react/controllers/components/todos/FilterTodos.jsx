import React from "react";

export function FilterTodos ({filterTodos, filterRef, clearTodos}) {

   return (
      <div className="filter-todos" ref={filterRef}>
         <button className={'all-todo'} onClick={()=> filterTodos('all')}>All</button>

         <button className={'all-to-do'} onClick={()=> filterTodos('todo')}>Todos</button>
         <button className={'all-completed active'} onClick={() => filterTodos('completed')}>Completed</button>

         <button onClick={() => clearTodos()}>Clear</button>
      </div>
   )


}