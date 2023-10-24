import React from "react";

export function Todo ({todo, deleteTodo, toggleTodo}) {

   return (
         <div className="todo">

            <svg className={`icon-check ${todo.isDone ? 'checked' : ''}`} onClick={() => toggleTodo(todo)}><use href={'/sprite.svg#icon-check'}></use></svg>

            <p>{todo.content}</p>

            <svg className={'icon-cross'} onClick={() => deleteTodo(todo)}><use href={'/sprite.svg#icon-cross'}></use></svg>
         </div>
   )
}
export default Todo;