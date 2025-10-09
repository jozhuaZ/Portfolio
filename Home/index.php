<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link href="styles.css" rel="stylesheet">

    <!-- favicon here -->
    <link rel="icon" type="image/png" href="../assets/images/my_pic.jpg">

    <title>Profile - Joshua Zabala</title>
</head>
<body>
    <!-- navigation -->
    <header>
        <nav class="header-navigation">
            <h1>JoshDev</h1>
            <ul>
                <li><a href="#about-me">About Me</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#tech-stack">Tech Stack</a></li>
                <li><a href="#project">Projects</a></li>
                <li><a href="#contact">Contact Me</a></li>
            </ul>
        </nav>
    </header>
    <!-- my photo and description -->
    <section class="photo-description-container"> <!-- background -->
        <video autoplay muted loop playsinline class="bg-video">
            <source src="../assets/animation/animation_bg2.mp4" type="video/mp4">
        </video>
        <!-- my photo -->
        <div class="profile-photo">
            <img src="../assets/images/my_pic.jpg" alt="Joshua Zabala">
        </div>
        
        <!-- my personal info -->
        <div class="personal-info">
            <h1>Joshua O. Zabala</h1>
            <p>Hello! I am an aspiring Full-Stack Web Developer.</p>
            <button class="cssbuttons-io" onclick="">
                <span>
                    <svg width="20px" height="20px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="ic_fluent_mail_48_regular" fill="#ffffff" fill-rule="nonzero">
                                <path d="M37.75,9 C40.6494949,9 43,11.3505051 43,14.25 L43,33.75 C43,36.6494949 40.6494949,39 37.75,39 L10.25,39 C7.35050506,39 5,36.6494949 5,33.75 L5,14.25 C5,11.3505051 7.35050506,9 10.25,9 L37.75,9 Z M40.5,18.351 L24.6023984,27.0952699 C24.2689733,27.2786537 23.8727436,27.2990297 23.5253619,27.1563978 L23.3976016,27.0952699 L7.5,18.351 L7.5,33.75 C7.5,35.2687831 8.73121694,36.5 10.25,36.5 L37.75,36.5 C39.2687831,36.5 40.5,35.2687831 40.5,33.75 L40.5,18.351 Z M37.75,11.5 L10.25,11.5 C8.73121694,11.5 7.5,12.7312169 7.5,14.25 L7.5,15.499 L24,24.573411 L40.5,15.498 L40.5,14.25 C40.5,12.7312169 39.2687831,11.5 37.75,11.5 Z" id="🎨-Color"></path>
                            </g>
                        </g>
                    </svg>
                    Contact Me
                </span>
            </button>
        </div>
    </section>
    
    <!-- about me -->
    <section id="about-me" class="about-me">
        <!-- <div class="section-content-wrapper"> -->
            <h2 class="heading-title">About Me</h2>
            <article>
                Hello World! I am Joshua, a 3rd-year IT student with a strong passion for web development.
                
                My journey is driven by a profound curiosity about how systems work and are built, pushing me to constantly seek deeper understanding. I thrive in dynamic environments, demonstrating an ability to adapt to changes quickly and embrace new challenges. 
                
                I bring a collaborative spirit to every project, working effectively within a team to turn innovative ideas into functional solutions. This combination of passion and adaptability fuels my goal of becoming a skilled Full-Stack Developer.
            </article>
            <aside>
                <div class="profile-photo2">
                    <img src="../assets/images/my_pic2.jpg" alt="Joshua Zabala">
                </div>
            </aside>
        <!-- </div> -->
    </section>

    <!-- education/academic journey -->
    <section id="education" class="education">
        <!-- <div class="section-content-wrapper"> -->
            <h2 class="heading-title">Education Timeline</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-date">2023 - Present</div>
                    <div class="timeline-content">
                        <h3>Bachelor of Science in Information Technology</h3>
                        <p>Camarines Sur Polytechnic Colleges</p>
                        <p>Nabua, Camarines Sur</p>
                    </div>
                </div>
    
                <div class="timeline-item">
                    <div class="timeline-date">2021 - 2023</div>
                    <div class="timeline-content">
                        <h3>Senior High School (STEM Strand)</h3>
                        <p>University of Saint Anthony, Senior High School</p>
                        <p>Iriga City, Camarines Sur</p>
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </section>

    <!-- tech stacks -->
    <section id="tech-stack" class="tech-stack">
        <!-- <div class="section-content-wrapper"> -->
            <h2 class="heading-title">Tech Stack</h2>
            <!-- core techs -->
            <h3 class="subheading-title">Core Technology</h3>
            <div class="techs">
                <div class="tech-container">
                    <img src="../assets/images/html.png" alt="HTML" class="tech-img">
                    <h4 class="tech-title">
                        HTML
                    </h4>
                    <p>70%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/css.png" alt="CSS" class="tech-img">
                    <h4 class="tech-title">
                        CSS
                    </h4>
                    <p>50%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/js.png" alt="JavaScript" class="tech-img">
                    <h4 class="tech-title">
                        JavaScript
                    </h4>
                    <p>50%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/php.png" alt="PHP" class="tech-img">
                    <h4 class="tech-title">
                        PHP
                    </h4>
                    <p>50%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/mysql.png" alt="MySQL" class="tech-img">
                    <h4 class="tech-title">
                        MySQL
                    </h4>
                    <p>60%</p>
                    <div class="slider"></div>
                </div>
            </div>
            <!-- framework and libraries -->
            <h3 class="subheading-title">Framework & Libraries</h3>
            <div class="techs">
                 <div class="tech-container">
                     <img src="../assets/images/codeigniter.png" alt="CodeIgniter" class="tech-img">
                     <h4 class="tech-title">
                         CodeIgniter
                     </h4>
                     <p>30%</p>
                     <div class="slider"></div>
                 </div>
                <div class="tech-container">
                    <img src="../assets/images/react.png" alt="React" class="tech-img">
                    <h4 class="tech-title">
                        React
                    </h4>
                    <p>60%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/tailwindcss.png" alt="TailwindCSS" class="tech-img">
                    <h4 class="tech-title">
                        TailwindCSS
                    </h4>
                    <p>50%</p>
                    <div class="slider"></div>
                </div>
             </div>
            <!-- tools and platforms -->
            <h3 class="subheading-title">Tools & Platforms</h3>
            <div class="techs">
                <div class="tech-container">
                    <img src="../assets/images/git.png" alt="Git" class="tech-img">
                    <h4 class="tech-title">
                        Git
                    </h4>
                    <p>30%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/github.png" alt="GitHub" class="tech-img">
                    <h4 class="tech-title">
                        GitHub
                    </h4>
                    <p>40%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/bitbucket.png" alt="BitBucket" class="tech-img">
                    <h4 class="tech-title">
                        BitBucket
                    </h4>
                    <p>30%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/vscode.png" alt="VSCode" class="tech-img">
                    <h4 class="tech-title">
                        VSCode
                    </h4>
                    <p>60%</p>
                    <div class="slider"></div>
                </div>
                <div class="tech-container">
                    <img src="../assets/images/lucid.png" alt="LucidChart" class="tech-img">
                    <h4 class="tech-title">
                        LucidChart
                    </h4>
                    <p>40%</p>
                    <div class="slider"></div>
                </div>
            </div>
        <!-- </div> -->
    </section>

    <!-- projects -->
    <section id="project" class="project">
        <!-- <div class="section-content-wrapper"> -->
            <h2 class="heading-title">Projects</h2> 
            
            <div class="project-section-wrapper">
    
            <!-- Project 1 -->
                <div class="project-container" data-project="project1">
                    <img src="../assets/images/projects/project_1.png" alt="Project 1" class="project-img">
                    
                    <div class="project-info">
                        <h3 class="subheading-title">P.R.E.S.S.</h3> 
                        <p class="short-description">An entrance exam scheduling built with ReactJS, PHP and MySQL.</p>
                        
                        <p class="full-description">
                            The system is designed to streamline the student admission process for a college. The system allows incoming students to pre-register online, receive an exam schedule automatically, and get notified through email.
                            <br>
                            The project was built using ReactJS for the frontend, providing an interactive interface, and PHP with MySQL for the backend to handle data storage and server-side operations. To visualize registration statistics, I integrated React Chart, which dynamically displays data through an intuitive pie chart.
                            <br>
                            For automated communication, I implemented EmailJS, enabling the system to send confirmation and exam schedule emails to examinees immediately after successful registration. Image uploads of payments are securely stored using Cloudinary, ensuring efficient cloud-based image management.
                            <br>
                            This project demonstrates a full-stack implementation that combines automation, data visualization, and user-friendly design to simplify college pre-registration and entrance examination scheduling workflows.
                        </p>
                        <div class="texts">
                            <a class="repository-link" href="https://github.com/jozhuaZ/Portfolio" target="_blank">Repository</a>
                            <p class="description" onclick="toggleProjectExpansion(this)">Show more</p> 
                        </div>
                    </div>
                </div>
                
                <!-- Project 2-->
                <div class="project-container" data-project="project2">
                    <img src="../assets/images/projects/project_2.png" alt="Project 2" class="project-img">
                    
                    <div class="project-info">
                        <h3 class="subheading-title">My Portfolio</h3> 
                        <p class="short-description">My personal portfolio page built with plain HTML, CSS, JavaScript, and vanilla PHP.</p>
                        
                        <p class="full-description">This very website demonstrates my proficiency in core web technologies. It is designed to be fully responsive and uses JavaScript and PHP for smooth scrolling and navigation highlighting. It serves as a living document of my skills and ongoing learning journey in web development.</p>
                        
                        <div class="texts">
                            <a class="repository-link" href="https://github.com/jozhuaZ/Portfolio" target="_blank">Repository</a>
                            <p class="description" onclick="toggleProjectExpansion(this)">Show more</p> 
                        </div>
                    </div>
                </div>
    
                <!-- Project 2-->
                <div class="project-container" data-project="project3">
                    <video class="project-img" muted>
                        <source src="../assets/videos/project_3.mp4" alt="Project 3" type="video/mp4">
                    </video>
                    
                    <div class="project-info">
                        <h3 class="subheading-title">Simple Website</h3> 
                        <p class="short-description">A group project developed during First Year, using HTML and CSS.</p>
                        
                        <p class="full-description"></p>
                        
                        <div class="texts">
                            <a class="repository-link" href="https://github.com/jozhuaZ/ExamScheduling" target="_blank">Repository</a>
                            <p class="description" onclick="toggleProjectExpansion(this)">Show more</p> 
                        </div> 
                    </div>
                </div>
            </div>
        <!-- </div> -->
    </section>
    <div class="project-overlay" onclick="closeAllExpandedProjects()"></div>

        
    <!-- contacts -->
    <section id="contact" class="contact">
        <!-- <div class="section-content-wrapper"> -->

            <h2 class="heading-title">Contact Me</h2>
            
            <div class="contact-content">
                
                <!-- Left Side: Collaboration & Info -->
                <div class="contact-info">
                    <div class="info-text">
                        <h3>Let's Collaborate and Build Something Great!</h3>
                        <p>I'm always open to discussing new projects, creative ideas, or opportunities to be part of your vision. Feel free to reach out directly via email or connect with me on social media. I look forward to hearing about your ideas!</p>
    
                        <div class="contact-detail">
                            <!-- Icon for Email -->
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <a href="mailto:joshuazabala693@gmail.com">joshuazabala693@gmail.com</a>
                        </div>
                    </div>
    
                    <!-- Social Links at the bottom left -->
                    <div class="social-links">
                        <a href="https://www.github.com/jozhuaZ" target="_blank" class="social-icon github" aria-label="Github Profile">
                            <!-- GitHub Icon SVG (Use your existing accent colors) -->
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.372 0 0 5.372 0 12c0 5.303 3.438 9.8 8.207 11.385.6.111.82-.257.82-.57 0-.28-.01-1.017-.015-2.001-3.337.724-4.043-1.611-4.043-1.611-.546-1.384-1.332-1.753-1.332-1.753-1.089-.745.083-.73.083-.73 1.205.084 1.838 1.234 1.838 1.234 1.07 1.832 2.808 1.303 3.493.996.108-.775.419-1.303.76-1.603-2.665-.304-5.466-1.332-5.466-5.93 0-1.31.468-2.383 1.233-3.224-.124-.304-.535-1.524.117-3.176 0 0 1.006-.322 3.3-1.232 0 0 .954-.265 1.85-.27 0 0 .9-.005 1.85.27 2.295.91 3.3 1.232 3.3 1.232.652 1.652.24 2.872.118 3.176.764.841 1.232 1.914 1.232 3.224 0 4.61-2.805 5.623-5.474 5.922.43.37.817 1.107.817 2.233 0 1.614-.015 2.915-.015 3.314 0 .317.218.682.827.568C20.562 21.8 24 17.303 24 12 24 5.372 18.628 0 12 0z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/joshua.zabal.1/" target="_blank" class="social-icon facebook" aria-label="Facebook Profile">
                            <!-- Facebook Icon SVG -->
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12c5.961 0 10.994-4.321 11.885-10.027.126-.816.19-1.642.19-2.473 0-6.627-5.373-12-12-12zm-2.028 17.218v-5.945h-1.996V9.664h1.996V7.781c0-1.984 1.185-3.07 3.018-3.07 1.981 0 3.018.148 3.018.148v3.313h-1.706c-.838 0-1.1.521-1.1 1.054v1.89h2.919l-.468 2.58h-2.451v5.945h-3.003z"/></svg>
                        </a>
                    </div>
                </div>
    
                <!-- Right Side: Contact Form -->
                <form class="contact-form">
                    <div class="input-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" required placeholder="John Doe">
                    </div>
    
                    <div class="input-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" required placeholder="name@example.com">
                    </div>
    
                    <div class="input-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required placeholder="Project Inquiry">
                    </div>
    
                    <div class="input-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required placeholder="Let's build a stunning portfolio together..."></textarea>
                    </div>
    
                    <button type="submit" class="submit-button">
                        Send Message
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-send"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    </button>
                    <p id="form-message" style="display: none; margin-top: 15px;"></p>
                </form>
            </div>
        <!-- </div> -->
    </section>
</body>
</html>

<script>
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

    // Optional: Close overlay if clicked outside the expanded card
    document.querySelector('.project-overlay')?.addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            closeAllExpandedProjects();
        }
    });
</script>