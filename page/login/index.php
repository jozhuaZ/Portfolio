<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../loginStyles.css">

    <link rel="icon" type="image/png" href="../../assets/images/my_pic.jpg">


    <title>JoshDev | Login</title>
</head>

<body class="layout">
    <!-- HEADER -->
    <!-- <header>
        <nav class="header-navigation">
            <h1>JoshDev</h1>
        </nav>
    </header> -->

    <!-- flash messages -->
    <?php include '../../parts/flashMessage.php'; ?>

    <!-- MAIN SECTION -->
    <main class="main-content">
        <video autoplay muted loop playsinline class="bg-video">
            <source src="../../assets/animation/animation_bg2.mp4" type="video/mp4">
        </video>

        <form class="login-form" method="post" action="../../database/login.php">
            <h2>Login</h2>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required placeholder="Enter your email">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required placeholder="Enter your password">
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </main>


    <!-- FOOTER -->
    <?php include '../../parts/footer.php'; ?>
</body>

</html>