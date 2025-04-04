import React from 'react';

const diseases = [
  'BLOOD PRESSURE',
  'DAIBETES',
  'MENTAL HELATH ISSUE',
  'DIGESTIVE DISORDERS',
  'ACIDITICY',
  'ASTHAMA',
  'BODY LOSE(OBESITY)',
  'OTHER',
  'NONE'
];

const DiseaseSelectionForm = () => {
  return (
    <div className="max-w-2xl mx-auto animate-fadeIn">
      <h2 className="text-xl font-bold text-center mb-8">
        "PLEASE SELECT THE DISEASES YOU HAVE (IF ANY):"
      </h2>
      <div className="grid grid-cols-3 gap-4">
        {diseases.map((disease, index) => (
          <button
            key={index}
            className={`p-4 rounded-full text-center transition-all duration-300
              ${index % 2 === 0 
                ? 'bg-[#e6c88a] hover:bg-[#d4b77a]' 
                : 'bg-[#f0e0c0] hover:bg-[#e6c88a]'
              }
              transform hover:scale-105`}
          >
            {disease}
          </button>
        ))}
      </div>
    </div>
  );
};

export default DiseaseSelectionForm;