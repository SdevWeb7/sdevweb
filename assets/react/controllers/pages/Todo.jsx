import React from "react";
import eventBus from "../hooks/eventBus";

export function Todo ({username, todo, deleteTodo, toggleTodo}) {

   const handleToggle = () => {
      toggleTodo(todo)
      ApiRequest(`https://localhost:8000/api/toggle-todo/${username}`, todo, 'Action réussi :)')
   }

   const handleDelete = () => {
      deleteTodo(todo)
      ApiRequest(`https://localhost:8000/api/delete-todo/${username}`, todo, 'Todo Supprimée :)')
   }

   return (
         <div className="todo">

            <svg className={`icon-check ${todo.isDone ? 'checked' : ''}`} onClick={handleToggle}><use href={'/sprite.svg#icon-check'}></use></svg>

            <p>{todo.content}</p>

            <svg className={'icon-cross'} onClick={handleDelete}><use href={'/sprite.svg#icon-cross'}></use></svg>
         </div>
   )
}
export default Todo;

export function ApiRequest (url, todo, message) {
   fetch(url, {
      method: 'POST',
      headers: {
         'Content-Type': 'application/json',
      },
      body: JSON.stringify({ todo: todo })
   })
      .then(response => {
         if (response.ok) {
            eventBus.emit('ToastMessage', [message])
         }
      })
      .catch(error => eventBus.emit('ToastMessage', ['Erreur de connexion']));
}