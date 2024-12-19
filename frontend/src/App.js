import React, { useState } from 'react';
import './App.css';
import TodoForm from './TodoForm';
import TodoItem from './TodoItem';

function App() {
  const [todos, setTodos] = useState([
    { text: "Learn about React", isCompleted: false, isImportant: false, time: '', showOptions: false },
    { text: "Meet friend for lunch", isCompleted: false, isImportant: false, time: '', showOptions: false },
    { text: "Build really cool todo app", isCompleted: false, isImportant: false, time: '', showOptions: false }
  ]);

  const addTodo = text => {
    const newTodos = [...todos, { text, isCompleted: false, isImportant: false, time: '', showOptions: false }];
    setTodos(newTodos);
  };

  const toggleTodo = index => {
    const newTodos = [...todos];
    newTodos[index].isCompleted = !newTodos[index].isCompleted;
    setTodos(newTodos);
  };

  const removeTodo = index => {
    const newTodos = [...todos];
    newTodos.splice(index, 1);
    setTodos(newTodos);
  };

  const setTime = (index, time) => {
    const newTodos = [...todos];
    newTodos[index].time = time;
    setTodos(newTodos);
  };

  const toggleImportant = index => {
    const newTodos = [...todos];
    newTodos[index].isImportant = !newTodos[index].isImportant;
    setTodos(newTodos);
  };

  const toggleOptions = index => {
    const newTodos = [...todos];
    newTodos[index].showOptions = !newTodos[index].showOptions;
    setTodos(newTodos);
  };

  return (
    <div className="app">
      <h1>Ma Todolist</h1>
      <div className="todo-list">
        {todos.map((todo, index) => (
          <TodoItem
            key={index}
            index={index}
            todo={todo}
            toggleTodo={toggleTodo}
            removeTodo={removeTodo}
            setTime={setTime}
            toggleImportant={toggleImportant}
            toggleOptions={toggleOptions}
          />
        ))}
        <TodoForm addTodo={addTodo} />
      </div>
    </div>
  );
}

export default App;
