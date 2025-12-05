<!-- tech stacks -->
<section id="tech-stack" class="tech-stack">
    <div class="section-content">
        <h2 class="heading-title">Tech Stack</h2>

        <?php
        // Fetch tech stack data
        $tech_query = "SELECT * FROM tech_stack ORDER BY type, name DESC";
        $tech_result = mysqli_query($conn, $tech_query);

        // Group by type
        $tech_by_type = [];
        while ($row = mysqli_fetch_assoc($tech_result)) {
            $tech_by_type[$row['type']][] = $row;
        }

        // Define type labels in display order
        $type_labels = [
            'Core Technology' => 'Core Technology',
            'Framework & Libraries' => 'Framework & Libraries',
            'Tools & Platforms' => 'Tools & Platforms'
        ];

        // Display each type section
        foreach ($type_labels as $type => $label):
            if (isset($tech_by_type[$type]) && count($tech_by_type[$type]) > 0):
        ?>
                <h3 class="subheading-title"><?php echo $label; ?></h3>
                <div class="techs">
                    <?php foreach ($tech_by_type[$type] as $tech): ?>
                        <div class="tech-container">
                            <img src="./uploads/<?php echo htmlspecialchars($tech['image']); ?>"
                                alt="<?php echo htmlspecialchars($tech['name']); ?>"
                                class="tech-img">
                            <h4 class="tech-title">
                                <?php echo htmlspecialchars($tech['name']); ?>
                            </h4>
                            <p><?php echo htmlspecialchars($tech['percentage']); ?>%</p>
                            <div class="slider"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php
            endif;
        endforeach;

        // If no tech stacks found
        if (empty($tech_by_type)):
            ?>
            <p style="text-align: center; color: #666; margin-top: 20px;">No tech stack records found.</p>
        <?php endif; ?>
    </div>
</section>