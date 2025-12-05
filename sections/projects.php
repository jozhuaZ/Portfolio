<!-- projects -->
<section id="project" class="project">
    <div class="section-content">
        <h2 class="heading-title">Projects</h2>

        <div class="project-section-wrapper">
            <?php
            // Reset the result pointer if needed
            mysqli_data_seek($project_result, 0);

            $project_counter = 1;
            while ($project = mysqli_fetch_assoc($project_result)):
                $project_id = 'project' . $project_counter;

                // Check if it's a video file
                $is_video = false;
                if (!empty($project['vid'])) {
                    $is_video = true;
                    $media_src = $project['vid'];
                } else {
                    $extension = strtolower(pathinfo($project['image'], PATHINFO_EXTENSION));
                    $is_video = in_array($extension, ['mp4', 'webm', 'ogg']);
                    $media_src = './uploads/' . htmlspecialchars($project['image']);
                }
            ?>
                <div class="project-container" data-project="<?php echo $project_id; ?>">
                    <?php if ($is_video): ?>
                        <video class="project-img" muted>
                            <source src="<?php echo $media_src; ?>" type="video/mp4">
                        </video>
                    <?php else: ?>
                        <img src="<?php echo $media_src; ?>"
                            alt="<?php echo htmlspecialchars($project['title']); ?>"
                            class="project-img">
                    <?php endif; ?>

                    <div class="project-info">
                        <div class="text-content">
                            <h3 class="subheading-title"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="short-description"><?php echo htmlspecialchars($project['short_desc']); ?></p>
                        </div>
                        <div class="texts">
                            <a class="repository-link"
                                href="<?php echo htmlspecialchars($project['repository']); ?>"
                                target="_blank">Repository</a>
                            <p class="description">Show more</p>
                        </div>
                    </div>
                </div>
            <?php
                $project_counter++;
            endwhile;

            // Show message if no projects found
            if ($project_counter === 1):
            ?>
                <p style="text-align: center; color: #666; margin-top: 20px;">No projects found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>