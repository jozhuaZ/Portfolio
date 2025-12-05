<!-- about me -->
<section id="about-me" class="about-me">
    <div class="section-content">
        <h2 class="heading-title">About Me</h2>
        <article>
            <?php echo nl2br(htmlspecialchars($admin_data['description'] ?? 'Hello World! I am Joshua, a 3rd-year IT student with a strong passion for web development.

My journey is driven by a profound curiosity about how systems work and are built, pushing me to constantly seek deeper understanding. I thrive in dynamic environments, demonstrating an ability to adapt to changes quickly and embrace new challenges.

I bring a collaborative spirit to every project, working effectively within a team to turn innovative ideas into functional solutions. This combination of passion and adaptability fuels my goal of becoming a skilled Full-Stack Developer.')); ?>
        </article>
        <aside>
            <div class="profile-photo2">
                <img src="./uploads/<?php echo htmlspecialchars($admin_data['second_image'] ?? 'my_pic2.jpg'); ?>" alt="<?php echo htmlspecialchars($admin_data['name'] ?? 'Joshua Zabala'); ?>">
            </div>
        </aside>
    </div>
</section>