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
   }
}
function reducerTodo (state, action) {

   if (action.type === 'DELETE_TODO') {
      return {
         ...state,
         todos: state.todos.filter(todo => todo !== action.payload)
      }
   }
   if (action.type === 'TOGGLE_TODO') {
      return {
         ...state,
         todos: state.todos.map(todo => {
            if (todo === action.payload) {
               return {...todo, isDone: !todo.isDone};
            }
            return todo;
         })
      }
   }
   if (action.type === 'ADD_TODO') {
      return {
         ...state,
         todos: [...state.todos, action.payload]
      }
   }
   if (action.type === 'CLEAR_ALL_TODOS') {
      return {
         ...state,
         todos: []
      }
   }
   if (action.type === 'FILTER') {
      return {
         ...state,
         filter: action.payload
      }
   }
   return state
}