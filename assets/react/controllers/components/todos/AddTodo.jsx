import React, { useRef, useState } from "react";
import { ApiRequest } from "./ApiRequest";
import eventBus from "../../hooks/eventBus";

export function AddTodo ({username, addTodo}) {
   const [svgChecked, setSvgChecked] = useState(false)
   const inputRef = useRef()

   const handleAddTodo = async (e) => {
      e.preventDefault()
      const todo = {
         id: Date.now(),
         content: inputRef.current.value,
         isDone: svgChecked
      }

      try {
         await ApiRequest('add-todo', username, todo);
         eventBus.emit('ToastMessage', ['Todo Ajoutée']);
         addTodo(todo)
         inputRef.current.value = ''
      } catch (error) {
         eventBus.emit('ToastMessage', ['Problème de connexion']);
      }
   }


   return (
      <form className={'add-todo'} onSubmit={handleAddTodo}>
         <svg className={`icon-check ${svgChecked ? 'checked' : ''}`} onClick={() => setSvgChecked(v => v ? false : true)}><use href={'/sprite.svg#icon-check'}></use></svg>

         <input ref={inputRef} type="text" placeholder={'Create a todo...'} />

         <svg className={`icon-cross`} style={{transform: 'rotate(45deg)'}} onClick={handleAddTodo}><use href={'/sprite.svg#icon-cross'}></use></svg>
      </form>
   )
}