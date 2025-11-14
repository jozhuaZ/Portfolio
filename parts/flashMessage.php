<?php if (isset($_SESSION['flash_error'])): ?>
    <div>
        <p>
            <?php
            echo htmlspecialchars($_SESSION['flash_error']);
            unset($_SESSION['flash_error']); // remove session variable after showing msg
            ?>
        </p>
    </div>
<?php endif; ?>