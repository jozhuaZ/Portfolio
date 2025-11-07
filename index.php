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
    <link rel="icon" type="image/png" href="./assets/images/my_pic.jpg">

    <title>Profile - Joshua Zabala</title>
</head>
<body>
    <?php include 'parts/projectOverlay.php' ?>
    
    <?php include 'parts/header.php' ?>

    <!-- my photo and description -->
    <section class="photo-description-container"> <!-- background -->
        <video autoplay muted loop playsinline class="bg-video">
            <source src="./assets/animation/animation_bg2.mp4" type="video/mp4">
        </video>
        <!-- my photo -->
        <div class="profile-photo">
            <img src="./assets/images/my_pic.jpg" alt="Joshua Zabala">
        </div>
        
        <!-- my personal info -->
        <div class="personal-info">
            <h1>Joshua O. Zabala</h1>
            <p>Hello! I am an aspiring Full-Stack Web Developer.</p>
            <button class="cssbuttons-io">
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
    
    <?php include 'sections/aboutMe.php'; ?>

    <?php include 'sections/education.php'; ?>

    <?php include 'sections/techStack.php'; ?>

    <?php include 'sections/projects.php'; ?>

    <?php include 'sections/contact.php'; ?>
    
    <script src="scripts/main.js"></script>
</body>
</html>