<!--   Core JS Files   -->
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo esc_url(WPAISAAS_PLUGIN_DIR_URL) . "assets/js/dashboard.js?v=1.0.0" ?>"></script>
<?php wp_footer(); ?>
</body>
</html>