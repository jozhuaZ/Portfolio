<!-- education/academic journey -->
<section id="education" class="education">
    <div class="section-content">
        <h2 class="heading-title">Education Timeline</h2>
        <div class="timeline">
            <?php
            // Reset the result pointer to fetch data again
            mysqli_data_seek($education_result, 0);

            if (mysqli_num_rows($education_result) > 0):
                while ($edu = mysqli_fetch_assoc($education_result)):
            ?>
                    <div class="timeline-item">
                        <div class="timeline-date">
                            <?php echo htmlspecialchars($edu['start_year']); ?> -
                            <?php echo $edu['end_year'] == date('Y') ? 'Present' : htmlspecialchars($edu['end_year']); ?>
                        </div>
                        <div class="timeline-content">
                            <h3><?php echo htmlspecialchars($edu['title']); ?></h3>
                            <p><?php echo htmlspecialchars($edu['school']); ?></p>
                            <p><?php echo htmlspecialchars($edu['school_address']); ?></p>
                        </div>
                    </div>
                <?php
                endwhile;
            else:
                ?>
                <p style="text-align: center; color: #666;">No education records found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>