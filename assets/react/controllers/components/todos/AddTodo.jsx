import React, { useState } from "react";
import { ApiRequest } from "../../pages/Todo";

export function AddTodo ({username, addTodo, inputRef}) {
   const [svgChecked, setSvgChecked] = useState(false)

   const handleAddTodo = (e) => {
      e.preventDefault()
      const todo = {
         id: Date.now(),
         content: inputRef.current.value,
         isDone: svgChecked
      }
      addTodo(todo)
      inputRef.current.value = ''
      ApiRequest(`https://localhost:8000/api/add-todo/${username}`, todo, ['Todo ajoutée'])
   }


   return (
      <form className={'add-todo'} onSubmit={handleAddTodo}>
         <svg className={`icon-check ${svgChecked ? 'checked' : ''}`} onClick={() => setSvgChecked(v => v ? false : true)}><use href={'/sprite.svg#icon-check'}></use></svg>

         <input ref={inputRef} type="text" placeholder={'Create a todo...'} />

         <svg className={`icon-cross`} style={{transform: 'rotate(45deg)'}} onClick={handleAddTodo}><use href={'/sprite.svg#icon-cross'}></use></svg>
      </form>
   )
}