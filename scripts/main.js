document.addEventListener("DOMContentLoaded", () => {
    // --- General Selections ---
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".header-navigation ul li a");
    const techContainers = document.querySelectorAll(".tech-container");
    
    // --- Intersection Observer Setup for Nav Highlight and Section Reveals ---
    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.1 
    };
    
    const sectionObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                navLinks.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href").substring(1) === entry.target.id) {
                        link.classList.add("active");
                    }
                });
                entry.target.classList.add('is-revealed'); 
                if (entry.target.id === 'contact') {
                    entry.target.querySelector('.contact-content')?.classList.add('is-visible');
                }
            } else {
            }
        });
    }, observerOptions);

    // Start observing all sections
    sections.forEach(section => {
        sectionObserver.observe(section);
    });

    // --- Slider progress logic --- 
    techContainers.forEach(container => { 
        const percentText = container.querySelector("p")?.textContent.trim(); 
        const percent = parseInt(percentText.replace("%", "")) || 0; 
        const slider = container.querySelector(".slider"); 
        slider?.style.setProperty("--fill-width", `${percent}%`); 
    });

    // --- CONTACT FORM SUBMISSION HANDLER (Simulated) ---
    const contactForm = document.querySelector('.contact-form');
    const formMessage = document.getElementById('form-message');

    contactForm?.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Simulate form submission success
        if (formMessage) {
            formMessage.style.display = 'block';
            formMessage.textContent = 'Thank you for your message! I will get back to you soon.';
            formMessage.style.color = '#4a00e0';
        }

        // Clear the form after a simulated delay
        setTimeout(() => {
            contactForm.reset();
            if (formMessage) {
                formMessage.style.display = 'none';
            }
        }, 3000);
    });
});

// --- Project Expansion Functions (Global) ---

function toggleProjectExpansion(toggleElement) {
    const container = toggleElement.closest('.project-container');
    const overlay = document.querySelector('.project-overlay');

    if (container.classList.contains('expanded')) {
        // Collapse the project card
        container.classList.remove('expanded');
        overlay.style.display = 'none';
        toggleElement.textContent = 'Show more';
    } else {
        // Expand the project card
        closeAllExpandedProjects(); 
        
        // Then, open the current one
        container.classList.add('expanded');
        overlay.style.display = 'grid'; 
        toggleElement.textContent = 'Show less';
    }
}

function closeAllExpandedProjects() {
    const expandedContainer = document.querySelector('.project-container.expanded');
    const overlay = document.querySelector('.project-overlay');

    if (expandedContainer) {
        expandedContainer.classList.remove('expanded');
        // Reset the text of the toggle link
        expandedContainer.querySelector('.description').textContent = 'Show more';
    }
    overlay.style.display = 'none';
    }

    document.querySelector('.project-overlay')?.addEventListener('click', (e) => {
    if (e.target === e.currentTarget) {
        closeAllExpandedProjects();
    }
});