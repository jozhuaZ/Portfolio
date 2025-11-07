<footer class="footer">
    © ALL RIGHTS RESERVED <span id="current-year"></span>
</footer>

<script>
    function updateCopyrightYear() {
        const currentYear = new Date().getFullYear();
        const yearSpan = document.getElementById('current-year');

        if (yearSpan) {
            yearSpan.textContent = currentYear;
        }
    }

    updateCopyrightYear();
</script>