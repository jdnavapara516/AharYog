import React from 'react';
import { Calendar } from 'lucide-react';

const PersonalInfoForm = () => {
  return (
    <div className="max-w-2xl mx-auto space-y-6 animate-fadeIn">
      <div className="form-group">
        <label className="text-xl font-bold">USERNAME:</label>
        <input
          type="text"
          placeholder="ENTER YOUR USERNAME"
          className="w-full p-2 border-b-2 border-gray-300 focus:border-[#e6c88a] bg-transparent outline-none"
        />
      </div>

      <div className="form-group">
        <label className="text-xl font-bold">EMAIL:</label>
        <input
          type="email"
          placeholder="ENTER YOUR EMAIL"
          className="w-full p-2 border-b-2 border-gray-300 focus:border-[#e6c88a] bg-transparent outline-none"
        />
      </div>

      <div className="form-group">
        <label className="text-xl font-bold">GENDER:</label>
        <input
          type="text"
          placeholder="ENTER YOUR GENDER"
          className="w-full p-2 border-b-2 border-gray-300 focus:border-[#e6c88a] bg-transparent outline-none"
        />
      </div>

      <div className="form-group relative">
        <label className="text-xl font-bold">DOB:</label>
        <div className="relative">
          <input
            type="text"
            placeholder="ENTER YOUR DATE OF BIRTH"
            className="w-full p-2 border-b-2 border-gray-300 focus:border-[#e6c88a] bg-transparent outline-none"
          />
          <Calendar className="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400" />
        </div>
      </div>

      <div className="form-group">
        <label className="text-xl font-bold">HEIGHT:</label>
        <input
          type="text"
          placeholder="ENTER YOUR HEIGHT"
          className="w-full p-2 border-b-2 border-gray-300 focus:border-[#e6c88a] bg-transparent outline-none"
        />
      </div>

      <div className="form-group">
        <label className="text-xl font-bold">WEIGHT:</label>
        <input
          type="text"
          placeholder="ENTER YOUR WEIGHT"
          className="w-full p-2 border-b-2 border-gray-300 focus:border-[#e6c88a] bg-transparent outline-none"
        />
      </div>
    </div>
  );
};

export default PersonalInfoForm;