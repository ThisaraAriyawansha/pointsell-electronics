class CustomSelect {
    constructor(selectElement) {
        this.selectElement = selectElement;
        this.customSelect = selectElement.closest('.custom-select');
        this.init();
    }

    init() {
        // Clear previous selectedCustomerId on page load
        localStorage.removeItem('selectedCustomerId');

        // Create trigger
        this.trigger = document.createElement('div');
        this.trigger.className = 'custom-select-trigger';
        this.setTriggerText();
        this.customSelect.appendChild(this.trigger);

        // Create dropdown
        this.dropdown = document.createElement('div');
        this.dropdown.className = 'custom-select-dropdown';
        this.customSelect.appendChild(this.dropdown);

        // Create search input
        this.searchInput = document.createElement('input');
        this.searchInput.type = 'text';
        this.searchInput.className = 'custom-select-search';
        this.searchInput.placeholder = 'Search...';
        this.dropdown.appendChild(this.searchInput);

        // Create options container
        this.optionsContainer = document.createElement('div');
        this.optionsContainer.className = 'custom-select-options';
        this.dropdown.appendChild(this.optionsContainer);

        // Populate options
        this.populateOptions();

        // Add event listeners
        this.addEventListeners();
    }

    setTriggerText() {
        const selectedCustomerId = localStorage.getItem('selectedCustomerId');
        if (selectedCustomerId) {
            const selectedOption = Array.from(this.selectElement.options).find(option => option.value === selectedCustomerId);
            if (selectedOption) {
                this.trigger.textContent = selectedOption.text;
            }
        } else {
            this.trigger.textContent = this.selectElement.options[0].text; // Fallback to first option if no selectedCustomerId in localStorage
        }
    }

    populateOptions() {
        this.optionsContainer.innerHTML = '';
        Array.from(this.selectElement.options).forEach((option) => {
            if (option.value) {  // Skip default/placeholder option
                const optionElement = document.createElement('div');
                optionElement.className = 'custom-select-option';
                optionElement.textContent = option.text;
                optionElement.dataset.value = option.value;

                optionElement.addEventListener('click', () => {
                    this.selectOption(optionElement);
                });

                this.optionsContainer.appendChild(optionElement);
            }
        });
    }

    addEventListeners() {
        // Toggle dropdown
        this.trigger.addEventListener('click', () => {
            this.dropdown.style.display =
                this.dropdown.style.display === 'block' ? 'none' : 'block';
            this.searchInput.value = '';
            this.filterOptions('');
            this.searchInput.focus();
        });

        // Search functionality
        this.searchInput.addEventListener('input', (e) => {
            this.filterOptions(e.target.value.toLowerCase());
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!this.customSelect.contains(e.target)) {
                this.dropdown.style.display = 'none';
            }
        });
    }

    filterOptions(searchTerm) {
        const options = this.optionsContainer.querySelectorAll('.custom-select-option');
        options.forEach(option => {
            const text = option.textContent.toLowerCase();
            option.style.display = text.includes(searchTerm) ? 'block' : 'none';
        });
    }

    selectOption(optionElement) {
        // Remove selected class from all options
        this.optionsContainer.querySelectorAll('.custom-select-option')
            .forEach(opt => opt.classList.remove('selected'));

        // Add selected class to clicked option
        optionElement.classList.add('selected');

        // Update trigger text
        this.trigger.textContent = optionElement.textContent;

        // Update original select element
        this.selectElement.value = optionElement.dataset.value;

        // Store selected value in localStorage
        localStorage.setItem('selectedCustomerId', optionElement.dataset.value);

        // Dispatch change event on original select element
        const event = new Event('change', { bubbles: true });
        this.selectElement.dispatchEvent(event);

        // Hide dropdown
        this.dropdown.style.display = 'none';
    }
}

// Initialize custom selects
document.querySelectorAll('.custom-select').forEach(select => {
    const originalSelect = select.querySelector('select');
    new CustomSelect(originalSelect);
});
