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

    <title>Profile - Joshua Zabala</title>
</head>
<body>
    <!-- navigation -->
    <header>
        <nav class="header-navigation">
            <h1>JoshDev</h1>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about-me">About Me</a></li>
                <li><a href="#education">Academic</a></li>
                <li><a href="#certificate">Certificate</a></li>
                <li><a href="#contact">Contact Me</a></li>
            </ul>
        </nav>
    </header>
    <!-- my photo and description -->
    <section id="home" class="photo-description-container"> <!-- background -->
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
        <h2>About Me</h2>
        <article>
            Hello World! I am Joshua, a 3rd-year IT student with a strong passion for web development
            
        </article>
        <aside>
            <div class="profile-photo2">
                <img src="../assets/images/my_pic2.jpg" alt="Joshua Zabala">
            </div>
        </aside>
    </section>

    <!-- education/academic journey -->
    <section id="education" class="education">
        <h2>Education Timeline</h2>
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
    </section>

    <!-- tech stacks -->
     <!-- core techs -->
     <!-- tools and platforms -->
     <!-- currently learning -->

    <!-- projects -->

    <!-- certs -->

    <!-- contacts -->
</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll(".header-navigation ul li a");

  const options = {
    root: null,
    rootMargin: "0px",
    threshold: 0.6 // triggers when 60% of section is visible
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navLinks.forEach(link => {
          link.classList.remove("active");
          if (link.getAttribute("href").substring(1) === entry.target.id) {
            link.classList.add("active");
          }
        });
      }
    });
  }, options);

  sections.forEach(section => {
    observer.observe(section);
  });
});
</script>
