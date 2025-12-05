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
                // Nav Highlight Logic
                navLinks.forEach(link => {
                    link.classList.remove("active");
                    if (link.getAttribute("href").substring(1) === entry.target.id) {
                        link.classList.add("active");
                    }
                });
                // Section Reveal Logic
                entry.target.classList.add('is-revealed');
                if (entry.target.id === 'contact') {
                    entry.target.querySelector('.contact-content')?.classList.add('is-visible');
                }
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

    // --- CONTACT FORM SUBMISSION HANDLER ---
    const contactForm = document.querySelector('.contact-form');
    const formMessage = document.getElementById('form-message');

    contactForm?.addEventListener('submit', (e) => {
        e.preventDefault();

        if (formMessage) {
            formMessage.style.display = 'block';
            formMessage.textContent = 'Thank you for your message! I will get back to you soon.';
            formMessage.style.color = '#4a00e0';
        }

        setTimeout(() => {
            contactForm.reset();
            if (formMessage) {
                formMessage.style.display = 'none';
            }
        }, 3000);
    });

    // --- PROJECT OVERLAY FUNCTIONALITY ---
    setupProjectOverlay();
});

// Project data for all three projects
const projectData = {
    project1: {
        title: "P.R.E.S.S.",
        image: "./assets/images/projects/project_1.png",
        isVideo: false,
        description: `The system is designed to streamline the student admission process for a college. The system allows incoming students to pre-register online, receive an exam schedule automatically, and get notified through email.
        
The project was built using ReactJS for the frontend, providing an interactive interface, and PHP with MySQL for the backend to handle data storage and server-side operations. To visualize registration statistics, I integrated React Chart, which dynamically displays data through an intuitive pie chart.

For automated communication, I implemented EmailJS, enabling the system to send confirmation and exam schedule emails to examinees immediately after successful registration. Image uploads of payments are securely stored using Cloudinary, ensuring efficient cloud-based image management.

This project demonstrates a full-stack implementation that combines automation, data visualization, and user-friendly design to simplify college pre-registration and entrance examination scheduling workflows.`,
        repoLink: "https://github.com/jozhuaZ/ExamScheduling"
    },
    project2: {
        title: "My Portfolio",
        image: "./assets/images/projects/project_2.png",
        isVideo: false,
        description: `This very website demonstrates my proficiency in core web technologies. It is designed to be fully responsive and uses JavaScript and PHP for smooth scrolling and navigation highlighting.

The portfolio showcases a clean, modern design with custom CSS animations and interactive elements. Built entirely with vanilla HTML, CSS, and JavaScript, it emphasizes performance and accessibility.

Key features include a dynamic project showcase with modal overlays, an interactive skills section with animated progress bars, and a functional contact form. The site is optimized for all devices and screen sizes.

This serves as a living document of my skills and ongoing learning journey in web development, demonstrating my ability to create professional, user-friendly web experiences without relying on frameworks.`,
        repoLink: "https://github.com/jozhuaZ/Portfolio"
    },
    project3: {
        title: "Simple Website",
        image: "./assets/videos/project_3.mp4",
        isVideo: true,
        description: `A collaborative group project developed during my First Year of college, showcasing fundamental web development skills using HTML and CSS.

This project served as an introduction to web development best practices, including semantic HTML structure, responsive design principles, and CSS styling techniques. Working in a team environment taught valuable lessons about version control, code organization, and collaborative problem-solving.

The website features a clean layout with multiple pages, navigation menus, and styled content sections. While built with basic technologies, it demonstrates a solid understanding of web fundamentals and attention to design details.

This project represents an important milestone in my learning journey, showing where I started and how much I've grown as a developer since then.`,
        repoLink: "https://github.com/jozhuaZ/ExamScheduling"
    }
};

function setupProjectOverlay() {
    const overlay = document.getElementById("overlay");
    const projectContainers = document.querySelectorAll(".project-container");
    const showLessBtn = overlay?.querySelector(".overlay-texts .description");

    // Add click handlers to all "Show more" buttons
    projectContainers.forEach(container => {
        const showMoreBtn = container.querySelector(".description");
        const projectId = container.getAttribute("data-project");

        showMoreBtn?.addEventListener("click", (e) => {
            e.stopPropagation();
            showMore(projectId);
        });
    });

    // Add click handler to "Show Less" button
    showLessBtn?.addEventListener("click", (e) => {
        e.stopPropagation();
        showLess();
    });

    // Close overlay when clicking outside the container
    overlay?.addEventListener("click", (e) => {
        if (e.target === overlay) {
            showLess();
        }
    });

    // Close overlay with Escape key
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && overlay.style.display === "flex") {
            showLess();
        }
    });
}

function showMore(projectId) {
    const overlay = document.getElementById("overlay");
    const project = projectData[projectId];

    if (!project || !overlay) return;

    // Update overlay content
    const overlayImg = overlay.querySelector(".overlay-project-img");
    const overlayDescription = overlay.querySelector(".full-description");
    const overlayRepoLink = overlay.querySelector(".repository-link");

    if (project.isVideo) {
        // Replace image with video element
        const videoElement = document.createElement("video");
        videoElement.className = "overlay-project-img";
        videoElement.controls = true;
        videoElement.muted = true;
        videoElement.innerHTML = `<source src="${project.image}" type="video/mp4">`;
        overlayImg.replaceWith(videoElement);
    } else {
        // Ensure it's an image element
        if (overlayImg.tagName !== "IMG") {
            const imgElement = document.createElement("img");
            imgElement.className = "overlay-project-img";
            imgElement.alt = project.title;
            overlayImg.replaceWith(imgElement);
        }
        overlay.querySelector(".overlay-project-img").src = project.image;
        overlay.querySelector(".overlay-project-img").alt = project.title;
    }

    overlayDescription.textContent = project.description;
    overlayRepoLink.href = project.repoLink;

    // Show overlay
    overlay.style.display = "flex";
    document.body.classList.add("overlay-active");
}

function showLess() {
    const overlay = document.getElementById("overlay");
    overlay.style.display = "none";
    document.body.classList.remove("overlay-active");
}



// ============================
// ADMIN PANEL FUNCTIONALITY - FIXED
// ============================

document.addEventListener('DOMContentLoaded', function () {
    // Check if admin elements exist (user is logged in)
    const adminToggleBtn = document.getElementById('admin-toggle-btn');
    const adminSidebar = document.getElementById('admin-sidebar');
    const closeSidebarBtn = document.getElementById('close-sidebar-btn');
    const editContentArea = document.getElementById('edit-content-area');
    const adminNavLinks = document.querySelectorAll('.admin-nav li');

    if (!adminToggleBtn || !adminSidebar) return;

    // Toggle sidebar open
    adminToggleBtn.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent event bubbling
        adminSidebar.classList.add('open');
    });

    // Close sidebar
    closeSidebarBtn.addEventListener('click', function (e) {
        e.stopPropagation(); // Prevent event bubbling
        adminSidebar.classList.remove('open');
    });

    // Close sidebar when clicking outside - FIXED
    document.addEventListener('click', function (e) {
        // Only close if sidebar is open AND click is outside both sidebar and toggle button
        if (adminSidebar.classList.contains('open') &&
            !adminSidebar.contains(e.target) &&
            !adminToggleBtn.contains(e.target)) {
            adminSidebar.classList.remove('open');
        }
    });

    // Prevent sidebar from closing when clicking inside it
    adminSidebar.addEventListener('click', function (e) {
        e.stopPropagation();
    });

    // Section navigation
    adminNavLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.stopPropagation(); // Prevent sidebar from closing
            const section = this.getAttribute('data-section');

            // Update active state
            adminNavLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // Load section content
            loadSection(section);
        });
    });

    // Load section content via AJAX
    function loadSection(section) {
        // Show loading spinner
        editContentArea.innerHTML = `
            <div class="admin-loading">
                <div class="admin-spinner"></div>
            </div>
        `;

        // Fetch section content
        fetch(`admin_handler.php?action=get_form&section=${section}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    editContentArea.innerHTML = data.html;
                    attachFormHandlers();
                } else {
                    showError(data.message || 'Failed to load section');
                }
            })
            .catch(error => {
                console.error('Error loading section:', error);
                showError('An error occurred while loading the section');
            });
    }

    // Attach event handlers to dynamically loaded forms
    function attachFormHandlers() {
        // Handle form submissions
        const forms = editContentArea.querySelectorAll('.admin-form');
        forms.forEach(form => {
            form.addEventListener('submit', handleFormSubmit);
            // Prevent form clicks from closing sidebar
            form.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });

        // Handle edit buttons
        const editBtns = editContentArea.querySelectorAll('.edit-btn');
        editBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent sidebar from closing
                const section = this.getAttribute('data-section');
                const id = this.getAttribute('data-id');
                loadEditForm(section, id);
            });
        });

        // Handle delete buttons
        const deleteBtns = editContentArea.querySelectorAll('.delete-btn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent sidebar from closing
                if (confirm('Are you sure you want to delete this item?')) {
                    const section = this.getAttribute('data-section');
                    const id = this.getAttribute('data-id');
                    deleteItem(section, id);
                }
            });
        });

        // Handle add new buttons
        const addBtns = editContentArea.querySelectorAll('.add-new-btn');
        addBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent sidebar from closing
                const section = this.getAttribute('data-section');
                loadAddForm(section);
            });
        });

        // Handle cancel buttons
        const cancelBtns = editContentArea.querySelectorAll('.cancel-btn');
        cancelBtns.forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevent sidebar from closing
                const section = this.getAttribute('data-section');
                loadSection(section);
            });
        });
    }

    // Handle form submission
    function handleFormSubmit(e) {
        e.preventDefault();
        e.stopPropagation(); // Prevent sidebar from closing

        const form = e.target;
        const formData = new FormData(form);

        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'Saving...';

        // Submit form data
        fetch('admin_handler.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccess(data.message || 'Changes saved successfully');
                    // Reload the section after a short delay
                    setTimeout(() => {
                        const section = formData.get('section');
                        loadSection(section);
                    }, 1000);
                } else {
                    showError(data.message || 'Failed to save changes');
                    submitBtn.disabled = false;
                    submitBtn.textContent = originalText;
                }
            })
            .catch(error => {
                console.error('Error submitting form:', error);
                showError('An error occurred while saving changes');
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            });
    }

    // Load edit form for specific item
    function loadEditForm(section, id) {
        editContentArea.innerHTML = `
            <div class="admin-loading">
                <div class="admin-spinner"></div>
            </div>
        `;

        fetch(`admin_handler.php?action=get_edit_form&section=${section}&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    editContentArea.innerHTML = data.html;
                    attachFormHandlers();
                } else {
                    showError(data.message || 'Failed to load edit form');
                }
            })
            .catch(error => {
                console.error('Error loading edit form:', error);
                showError('An error occurred while loading the edit form');
            });
    }

    // Load add new form
    function loadAddForm(section) {
        editContentArea.innerHTML = `
            <div class="admin-loading">
                <div class="admin-spinner"></div>
            </div>
        `;

        fetch(`admin_handler.php?action=get_add_form&section=${section}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    editContentArea.innerHTML = data.html;
                    attachFormHandlers();
                } else {
                    showError(data.message || 'Failed to load add form');
                }
            })
            .catch(error => {
                console.error('Error loading add form:', error);
                showError('An error occurred while loading the add form');
            });
    }

    // Delete item
    function deleteItem(section, id) {
        // Show loading in button area
        const deleteBtn = document.querySelector(`.delete-btn[data-id="${id}"]`);
        if (deleteBtn) {
            deleteBtn.textContent = 'Deleting...';
            deleteBtn.disabled = true;
        }

        fetch('admin_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=delete&section=${section}&id=${id}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showSuccess(data.message || 'Item deleted successfully');
                    loadSection(section);
                } else {
                    showError(data.message || 'Failed to delete item');
                    if (deleteBtn) {
                        deleteBtn.textContent = 'Delete';
                        deleteBtn.disabled = false;
                    }
                }
            })
            .catch(error => {
                console.error('Error deleting item:', error);
                showError('An error occurred while deleting the item');
                if (deleteBtn) {
                    deleteBtn.textContent = 'Delete';
                    deleteBtn.disabled = false;
                }
            });
    }

    // Show success message
    function showSuccess(message) {
        // Remove any existing messages
        const existingMessages = editContentArea.querySelectorAll('.admin-message');
        existingMessages.forEach(msg => msg.remove());

        const messageDiv = document.createElement('div');
        messageDiv.className = 'admin-message admin-message-success';
        messageDiv.textContent = message;
        editContentArea.insertBefore(messageDiv, editContentArea.firstChild);

        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }

    // Show error message
    function showError(message) {
        // Remove any existing messages
        const existingMessages = editContentArea.querySelectorAll('.admin-message');
        existingMessages.forEach(msg => msg.remove());

        const messageDiv = document.createElement('div');
        messageDiv.className = 'admin-message admin-message-error';
        messageDiv.textContent = message;
        editContentArea.insertBefore(messageDiv, editContentArea.firstChild);

        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
});
