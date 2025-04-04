import React, { useState } from 'react';
import { Leaf, Calendar, ArrowRight, ArrowLeft } from 'lucide-react';
import PersonalInfoForm from './components/PersonalInfoForm';
import DiseaseSelectionForm from './components/DiseaseSelectionForm';
import GoalsSelectionForm from './components/GoalsSelectionForm';
import Navigation from './components/Navigation';

function App() {
  const [currentPage, setCurrentPage] = useState(0);
  const [slideDirection, setSlideDirection] = useState('right');

  const handleNext = () => {
    if (currentPage < 2) {
      setSlideDirection('right');
      setCurrentPage(prev => prev + 1);
    }
  };

  const handlePrevious = () => {
    if (currentPage > 0) {
      setSlideDirection('left');
      setCurrentPage(prev => prev - 1);
    }
  };

  return (
    <div className="min-h-screen bg-[#f5f0eb]">
      <nav className="bg-[#1a1a1a] p-4 flex justify-between items-center">
        <div className="flex items-center gap-2">
          <Leaf className="text-green-500" />
          <span className="text-[#e6c88a] font-serif text-2xl">AaharYog</span>
        </div>
        <div className="flex gap-8 text-[#e6c88a]">
          <a href="#" className="hover:text-white transition-colors">HOME</a>
          <a href="#" className="hover:text-white transition-colors">SERVICES</a>
          <a href="#" className="hover:text-white transition-colors">ABOUT US</a>
        </div>
        <button className="bg-green-500 text-white px-4 py-2 rounded-full flex items-center gap-2">
          Lucifer
        </button>
      </nav>

      <main className="container mx-auto px-4 py-8">
        <h1 className="text-3xl font-bold text-center mb-12">FILL YOUR DETAILS</h1>
        
        <div className="relative overflow-hidden">
          <div className={`transition-transform duration-500 transform ${
            slideDirection === 'right' ? 'translate-x-0' : '-translate-x-full'
          }`}>
            {currentPage === 0 && <PersonalInfoForm />}
            {currentPage === 1 && <DiseaseSelectionForm />}
            {currentPage === 2 && <GoalsSelectionForm />}
          </div>
        </div>

        <Navigation 
          currentPage={currentPage} 
          onNext={handleNext} 
          onPrevious={handlePrevious} 
        />
      </main>

      <footer className="bg-[#1a1a1a] text-[#e6c88a] p-8 mt-12">
        <div className="container mx-auto flex justify-between items-center">
          <div className="flex items-center gap-2">
            <Leaf className="text-green-500" />
            <span className="font-serif text-xl">AaharYog</span>
            <p className="text-sm italic">"WHAT YOU EAT SHAPES YOU"</p>
          </div>
          <div className="text-center">
            <p>ANAND</p>
            <p className="text-sm">STUDENT OF</p>
            <p className="text-sm">CHAROTAR UNIVERSITY OF</p>
            <p className="text-sm">SCIENCE AND TECHNOLOGY</p>
            <p className="text-sm">(CHARUSAT)</p>
          </div>
          <div>
            <p>+91 0123456789</p>
            <p>AAHARYOG2023@GMAIL.COM</p>
            <div className="flex gap-4 mt-2">
              <a href="#" className="hover:text-white transition-colors">FB</a>
              <a href="#" className="hover:text-white transition-colors">IG</a>
              <a href="#" className="hover:text-white transition-colors">TW</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
}

export default App;