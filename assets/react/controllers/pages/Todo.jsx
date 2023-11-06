import React from "react";
import { ApiRequest } from "../components/todos/ApiRequest";
import eventBus from "../hooks/eventBus";

export function Todo ({todo, deleteTodo, toggleTodo}) {

   const handleToggle = async () => {
      try {
         await ApiRequest('toggle-todo', todo);
         eventBus.emit('ToastMessage', ['Action réussi']);
         toggleTodo(todo)
      } catch (error) {
         eventBus.emit('ToastMessage', ['Problème de connexion']);
      }
   }

   const handleDelete = async () => {
      try {
         await ApiRequest('delete-todo', todo);
         eventBus.emit('ToastMessage', ['Todo Supprimée']);
         deleteTodo(todo)
      } catch (error) {
         eventBus.emit('ToastMessage', ['Problème de connexion']);
      }
   }

   return (
         <div className="todo">

            <svg className={`icon-check ${todo.isDone ? 'checked' : ''}`} onClick={handleToggle}><use href={'/sprite.svg#icon-check'}></use></svg>

            <p>{todo.content}</p>

            <svg className={'icon-cross'} onClick={handleDelete}><use href={'/sprite.svg#icon-cross'}></use></svg>
         </div>
   )
}