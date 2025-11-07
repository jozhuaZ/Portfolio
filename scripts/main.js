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