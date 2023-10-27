import React, { useEffect, useState } from "react";
import { useDocumentTitle } from "../hooks/useDocumentTitle";
import { useFetch } from "../hooks/useFetch";
import { useTodos } from "../hooks/reducerTodo";
import dragula from 'dragula';
import { FilterTodos } from "../components/todos/FilterTodos";
import { AddTodo } from "../components/todos/AddTodo";
import { DragInit } from "../components/todos/DragInit";
import Todo from "./Todo";

export function Todos ({username}) {
   useDocumentTitle('Todos');
   const {datas, loading, error} = useFetch(`https://127.0.0.1:8000/api/all-todos/${username}`)
   const {state, setTodos, clearTodos, filterTodos, addTodo, deleteTodo, toggleTodo} = useTodos()

   useEffect(() => {
      setTodos(datas)
   }, [datas])

   useEffect(() => {
      let drake = dragula([document.querySelector('#dragula')])
      DragInit(drake);
   }, [state.todos])

   let filteredTodos = []
   switch (state.filter) {
      case 'all':
         filteredTodos = state.todos
         break

      case 'todo':
         filteredTodos = state.todos.filter(todo => !todo.isDone)
         break

      case 'completed':
         filteredTodos = state.todos.filter(todo => todo.isDone)
         break
   }

   return (
         <div className="container-todos">
            <h1>TodoList</h1>

            <AddTodo username={username} addTodo={addTodo} />

            <FilterTodos clearTodos={clearTodos} filterTodos={filterTodos} />

            {loading && <div>Chargement...</div>}
            {error && <div>{error.toString()}</div>}

            <div id="dragula">
               {filteredTodos && filteredTodos.map(todo => <Todo key={todo.id} todo={todo} deleteTodo={deleteTodo} toggleTodo={toggleTodo} username={username} />)}
            </div>

         </div>
   )
}