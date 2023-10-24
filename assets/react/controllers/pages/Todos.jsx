import React, { useEffect, useRef, useState } from "react";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { useFetch } from "../hooks/useFetch";
import Todo from "./Todo";
import { useTodos } from "../hooks/reducerTodo";
import dragula from 'dragula';

export function Todos () {
   useDocumentTitle('Todos');
   const [svgChecked, setSvgChecked] = useState(false)
   const inputRef = useRef()
   const [todos, setTodos] = useState([])
   const {datas, loading, error} = useFetch('https://localhost:8000/api/todos')
   const {state, clearTodos, filterTodos, addTodo, deleteTodo, toggleTodo} = useTodos()
   const filterTodo = useRef()

   useEffect(() => {
      setTodos(datas ? datas['hydra:member'] : [])
      state.todos = datas ? datas['hydra:member'] : []
   }, [datas])

   useEffect(() => {
      setTodos(state.todos)

      let drake = dragula([document.querySelector('#dragula')])
      drake.on('drag', (el) => {
         document.querySelectorAll('.todo').forEach(todo => {
            if (todo !== el) {
               todo.classList.add('dragging')
            }
         })
      });
      drake.on('dragend', (el) => {
         document.querySelectorAll('.todo').forEach(todo => {
            if (todo !== el) {
               todo.classList.remove('dragging')
            }
         })
      });
   }, [state.todos])


   const handleAddTodo = (e) => {
      e.preventDefault()
      const todo = {
         id: Date.now(),
         content: inputRef.current.value,
         isDone: svgChecked
      }
      addTodo(todo)
      inputRef.current.value = ''
   }

   let filteredTodos = []
   if (filterTodo.current) {
      if (state.filter === 'all') {
         filteredTodos = state.todos
         filterTodo.current.querySelector('.active').classList.remove('active')
         filterTodo.current.querySelector('.all-todo').classList.add('active')

      } else if (state.filter === 'todo') {
         filteredTodos = todos.filter(todo => !todo.isDone)
         filterTodo.current.querySelector('.active').classList.remove('active')
         filterTodo.current.querySelector('.all-to-do').classList.add('active')

      } else if (state.filter === 'completed') {
         filteredTodos = todos.filter(todo => todo.isDone)
         filterTodo.current.querySelector('.active').classList.remove('active')
         filterTodo.current.querySelector('.all-completed').classList.add('active')
      }
   }

   return (
         <div className="container-todos">
            <h1>TodoList</h1>

            <form className={'add-todo'} onSubmit={handleAddTodo}>
               <svg className={`icon-check ${svgChecked ? 'checked' : ''}`} onClick={() => setSvgChecked(v => v ? false : true)}><use href={'/sprite.svg#icon-check'}></use></svg>

               <input ref={inputRef} type="text" placeholder={'Create a todo...'} />

               <svg className={`icon-cross`} style={{transform: 'rotate(45deg)'}} onClick={handleAddTodo}><use href={'/sprite.svg#icon-cross'}></use></svg>
            </form>


            <div className="filter-todos" ref={filterTodo}>
               <button className={'all-todo'} onClick={()=> filterTodos('all')}>All</button>

               <button className={'all-to-do'} onClick={()=> filterTodos('todo')}>Todos</button>
               <button className={'all-completed active'} onClick={() => filterTodos('completed')}>Completed</button>

               <button onClick={() => clearTodos()}>Clear</button>
            </div>


            {loading && <div>Chargement...</div>}
            {error && <div>{error.toString()}</div>}

            <div id="dragula">
               {filteredTodos.map(todo => <Todo key={todo.id} todo={todo} deleteTodo={deleteTodo} toggleTodo={toggleTodo} />)}
            </div>

         </div>
   )
}