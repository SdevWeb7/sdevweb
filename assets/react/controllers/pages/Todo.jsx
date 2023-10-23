import React from "react";

export function Todo ({todo, dispatch}) {

   return (
         <div className="todo">

            <svg className={`icon-check ${todo.isDone ? 'checked' : ''}`} onClick={() => dispatch({type: 'TOGGLE_TODO', payload: todo})}><use href={'/sprite.svg#icon-check'}></use></svg>

            <p>{todo.content}</p>

            <svg className={'icon-cross'} onClick={() => dispatch({type: 'DELETE_TODO', payload: todo})}><use href={'/sprite.svg#icon-cross'}></use></svg>
         </div>
   )
}
export default Todo;