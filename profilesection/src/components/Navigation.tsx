import React from 'react';
import { ArrowLeft, ArrowRight } from 'lucide-react';

interface NavigationProps {
  currentPage: number;
  onNext: () => void;
  onPrevious: () => void;
}

const Navigation = ({ currentPage, onNext, onPrevious }: NavigationProps) => {
  return (
    <div className="flex justify-between mt-8 max-w-2xl mx-auto">
      {currentPage > 0 && (
        <button
          onClick={onPrevious}
          className="flex items-center gap-2 text-gray-700 hover:text-black transition-colors"
        >
          <ArrowLeft /> PREVIOUS
        </button>
      )}
      {currentPage < 2 && (
        <button
          onClick={onNext}
          className="flex items-center gap-2 text-gray-700 hover:text-black transition-colors ml-auto"
        >
          NEXT <ArrowRight />
        </button>
      )}
    </div>
  );
};

export default Navigation;