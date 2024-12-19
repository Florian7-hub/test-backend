import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faExclamationTriangle } from '@fortawesome/free-solid-svg-icons';
import TodoOptions from './TodoOptions';

function TodoItem({ todo, index, toggleTodo, removeTodo, setTime, toggleImportant, toggleOptions }) {
  return (
    <div className={`todo ${todo.isImportant ? 'important' : ''}`}>
      {todo.showOptions && (
        <>
          <button onClick={() => toggleImportant(index)} className="important-toggle">
            <FontAwesomeIcon icon={faExclamationTriangle} />
          </button>
          <input 
            type="time" 
            value={todo.time} 
            onChange={(e) => setTime(index, e.target.value)} 
            className="time-input"
          />
        </>
      )}
      <input 
        type="checkbox" 
        checked={todo.isCompleted} 
        onChange={() => toggleTodo(index)} 
      />
      <span style={{ textDecoration: todo.isCompleted ? "line-through" : "" }}>
        {todo.text}
      </span>
      <button onClick={() => removeTodo(index)}>Remove</button>
      <TodoOptions 
        index={index} 
        toggleOptions={() => toggleOptions(index)} 
      />
    </div>
  );
}

export default TodoItem;
