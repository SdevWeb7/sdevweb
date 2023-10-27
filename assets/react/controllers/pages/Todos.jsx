import React, { useEffect, useRef, useState } from "react";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { useFetch } from "../hooks/useFetch";
import Todo, { ApiRequest } from "./Todo";
import { useTodos } from "../hooks/reducerTodo";
import dragula from 'dragula';
import { FilterTodos } from "../components/todos/FilterTodos";
import { AddTodo } from "../components/todos/AddTodo";

export function Todos ({username}) {
   useDocumentTitle('Todos');
   const inputRef = useRef()
   const [todos, setTodos] = useState([])
   const {datas, loading, error} = useFetch(`https://127.0.0.1:8000/api/all-todos/${username}`)
   const {state, clearTodos, filterTodos, addTodo, deleteTodo, toggleTodo} = useTodos()
   const filterRef = useRef()

   useEffect(() => {
      return () => {
         filterRef.current = null;
      };
   }, []);

   useEffect(() => {
      setTodos(datas ? datas : [])
      state.todos = datas ? datas : []
   }, [datas])

   useEffect(() => {
      setTodos(state.todos)
      let drake = dragula([document.querySelector('#dragula')])
      addDrag(drake);
   }, [state.todos])



   let filteredTodos = []
   if (filterRef.current) {
      switch (state.filter) {
         case 'all':
            filteredTodos = state.todos
            filterRef.current.querySelector('.active').classList.remove('active')
            filterRef.current.querySelector('.all-todo').classList.add('active')
            break

         case 'todo':
            filteredTodos = todos.filter(todo => !todo.isDone)
            filterRef.current.querySelector('.active').classList.remove('active')
            filterRef.current.querySelector('.all-to-do').classList.add('active')
            break

         case 'completed':
            filteredTodos = todos.filter(todo => todo.isDone)
            filterRef.current.querySelector('.active').classList.remove('active')
            filterRef.current.querySelector('.all-completed').classList.add('active')
            break
      }
   }

   return (
         <div className="container-todos">
            <h1>TodoList</h1>

            <AddTodo inputRef={inputRef} username={username} addTodo={addTodo} />


            <FilterTodos clearTodos={clearTodos} filterTodos={filterTodos} filterRef={filterRef} />


            {loading && <div>Chargement...</div>}
            {error && <div>{error.toString()}</div>}

            {datas && console.log(datas)}
            <div id="dragula">
               {filteredTodos && filteredTodos.map(todo => <Todo key={todo.id} todo={todo} deleteTodo={deleteTodo} toggleTodo={toggleTodo} username={username} />)}
            </div>

         </div>
   )
}


function addDrag (drake) {
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
}