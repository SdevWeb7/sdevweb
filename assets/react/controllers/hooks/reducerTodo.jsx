import React, { useReducer } from "react";

export function useTodos () {
   const [state, dispatch] = useReducer(reducerTodo, {filter: 'all', todos: []})

   return {
      state,
      addTodo: (todo) => dispatch({type: 'ADD_TODO', payload: todo}),
      toggleTodo: (todoId) => dispatch({type: 'TOGGLE_TODO', payload: todoId}),
      deleteTodo: (todo) => dispatch({type: 'DELETE_TODO', payload: todo}),
      filterTodos: (filter) => dispatch({type: 'FILTER', payload: filter}),
      clearTodos: () => dispatch({type: 'CLEAR_ALL_TODOS'}),
      setTodos: (datas) => dispatch({type: 'SET_TODOS', payload: datas ? datas : []})
   }
}
function reducerTodo (state, action) {

   switch (action.type) {
      case 'DELETE_TODO':
         return {
            ...state,
            todos: state.todos.filter(todo => todo !== action.payload)
         }
         break

      case 'TOGGLE_TODO':
         return {
            ...state,
            todos: state.todos.map(todo => {
               if (todo === action.payload) {
                  return {...todo, isDone: !todo.isDone};
               }
               return todo;
            })
         }
         break

      case 'ADD_TODO':
         return {
            ...state,
            todos: [...state.todos, action.payload]
         }
         break

      case 'CLEAR_ALL_TODOS':
         return {
            ...state,
            todos: []
         }
         break

      case 'FILTER':
         return {
            ...state,
            filter: action.payload
         }
         break

      case 'SET_TODOS':
         return {
            ...state,
            todos: action.payload
         }
         break

      default:
         return state

   }
}