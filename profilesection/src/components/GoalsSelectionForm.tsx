import React from 'react';

const goals = [
  'WEIGHT LOSS',
  'SUGAR CONTROL',
  'MORE...',
  'MORE...',
  'MORE...',
  'MORE...',
  'MORE...',
  'OTHER',
  'NONE'
];

const GoalsSelectionForm = () => {
  return (
    <div className="max-w-2xl mx-auto animate-fadeIn">
      <h2 className="text-xl font-bold text-center mb-8">
        SELECT YOUR GOALS(IF YOU WANT:
      </h2>
      <div className="grid grid-cols-3 gap-4">
        {goals.map((goal, index) => (
          <button
            key={index}
            className={`p-4 rounded-full text-center transition-all duration-300
              ${index % 2 === 0 
                ? 'bg-[#e6c88a] hover:bg-[#d4b77a]' 
                : 'bg-[#f0e0c0] hover:bg-[#e6c88a]'
              }
              transform hover:scale-105`}
          >
            {goal}
          </button>
        ))}
      </div>
    </div>
  );
};

export default GoalsSelectionForm;