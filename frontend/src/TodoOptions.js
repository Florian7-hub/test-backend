import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCog, faExclamationTriangle, faClock } from '@fortawesome/free-solid-svg-icons';

function TodoOptions({ toggleOptions, toggleImportant, showOptions }) {
  return (
    <div className="todo-options">
      <button onClick={toggleOptions}>
        <FontAwesomeIcon icon={faCog} />
      </button>
      {showOptions && (
        <>
          <button onClick={toggleImportant} className="important-toggle">
            <FontAwesomeIcon icon={faExclamationTriangle} />
          </button>
          <input 
            type="time" 
            className="time-input"
          />
        </>
      )}
    </div>
  );
}

export default TodoOptions;
