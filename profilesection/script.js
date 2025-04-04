document.addEventListener('DOMContentLoaded', () => {
  let currentPage = 0;
  const forms = ['personalInfoForm', 'diseaseForm', 'goalsForm'];
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');

  // Navigation functions
  function showPage(pageIndex) {
    document.querySelectorAll('.form-page').forEach(form => {
      form.classList.remove('active');
    });
    document.getElementById(forms[pageIndex]).classList.add('active');
    
    // Update navigation buttons
    prevBtn.style.display = pageIndex > 0 ? 'flex' : 'none';
    nextBtn.style.display = pageIndex < forms.length - 1 ? 'flex' : 'none';
    
    // Add entrance animation
    const currentForm = document.getElementById(forms[pageIndex]);
    currentForm.style.animation = 'none';
    currentForm.offsetHeight; // Trigger reflow
    currentForm.style.animation = 'slideIn 0.5s ease forwards';
  }

  // Selection buttons functionality
  document.querySelectorAll('.selection-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      if (this.classList.contains('custom-input')) {
        // Show custom input field
        const formId = this.closest('form').id;
        const customInput = document.getElementById(
          formId === 'diseaseForm' ? 'customDiseaseInput' : 'customGoalInput'
        );
        customInput.classList.toggle('show');
      } else if (this.textContent !== 'NONE') {
        // Toggle selection
        this.classList.toggle('selected');
        
        // Add pulse animation
        this.classList.add('pulse');
        setTimeout(() => {
          this.classList.remove('pulse');
        }, 1000);

        // If this button is selected, deselect "NONE" button
        const noneBtn = this.closest('.button-grid').querySelector('.selection-btn:last-child');
        if (noneBtn) {
          noneBtn.classList.remove('selected');
        }
      } else {
        // If "NONE" is clicked, deselect all other buttons
        const buttons = this.closest('.button-grid').querySelectorAll('.selection-btn');
        buttons.forEach(button => button.classList.remove('selected'));
        this.classList.add('selected');
      }
    });
  });

  // Custom input add button functionality
  document.querySelectorAll('.add-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const input = this.previousElementSibling;
      const value = input.value.trim();
      
      if (value) {
        // Create new selection button
        const newBtn = document.createElement('button');
        newBtn.type = 'button';
        newBtn.className = 'selection-btn selected';
        newBtn.textContent = value.toUpperCase();
        
        // Add to button grid before the last two buttons (OTHER and NONE)
        const buttonGrid = this.closest('form').querySelector('.button-grid');
        buttonGrid.insertBefore(newBtn, buttonGrid.lastElementChild.previousElementSibling);
        
        // Clear and hide input
        input.value = '';
        this.closest('.custom-input-field').classList.remove('show');
        
        // Add click handler to new button
        newBtn.addEventListener('click', function() {
          this.classList.toggle('selected');
          // Deselect "NONE" button when this is selected
          const noneBtn = buttonGrid.querySelector('.selection-btn:last-child');
          if (this.classList.contains('selected')) {
            noneBtn.classList.remove('selected');
          }
        });
        
        // Add entrance animation
        newBtn.classList.add('fade-in');

        // Deselect "NONE" button
        const noneBtn = buttonGrid.querySelector('.selection-btn:last-child');
        noneBtn.classList.remove('selected');
      }
    });
  });

  // Navigation button click handlers
  prevBtn.addEventListener('click', () => {
    if (currentPage > 0) {
      currentPage--;
      showPage(currentPage);
    }
  });

  nextBtn.addEventListener('click', () => {
    if (currentPage < forms.length - 1) {
      currentPage++;
      showPage(currentPage);
    }
  });

  // Initialize first page
  showPage(0);
});