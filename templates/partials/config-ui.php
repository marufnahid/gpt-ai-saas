<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0"><?php esc_html_e('UI Configurator', 'wpaisaas'); ?></h5>
                <p><?php esc_html_e('See our dashboard options.', 'wpaisaas'); ?></p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0"><?php esc_html_e('Sidebar Colors', 'wpaisaas'); ?></h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0"><?php esc_html_e('Sidenav Type', 'wpaisaas'); ?></h6>
                <p class="text-sm"><?php esc_html_e('Choose between 2 different sidenav types.', 'wpaisaas'); ?></p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)"><?php esc_html_e('Transparent', 'wpaisaas'); ?></button>
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)"><?php esc_html_e('White', 'wpaisaas'); ?></button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2"><?php esc_html_e('You can change the sidenav type just on desktop view.', 'wpaisaas'); ?></p>
            <!-- Navbar Fixed -->
            <div class="mt-3">
                <h6 class="mb-0"><?php esc_html_e('Navbar Fixed', 'wpaisaas'); ?></h6>
            </div>
            <div class="form-check form-switch ps-0">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
            </div>
            <hr class="horizontal dark my-sm-4">
            <a class="btn bg-gradient-dark w-100" href="https://wordpress.org/plugins/wp-ai-saas"><?php esc_html_e('Free Download', 'wpaisaas'); ?></a>
            <a class="btn btn-outline-dark w-100" href="https://wordpress.org/plugins/wp-ai-saas"><?php esc_html_e('View documentation', 'wpaisaas'); ?></a>
            <div class="w-100 text-center">
                <a class="github-button" href="https://github.com/marufnahid/wp-ai-saas" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub"><?php esc_html_e('Star', 'wpaisaas'); ?></a>
                <h6 class="mt-3"><?php esc_html_e('Thank you for sharing!', 'wpaisaas'); ?></h6>
                <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fwordpress.org%2Fplugins%2Fwp-ai-saas&text=Check%20out%20WP%20AI%20SaaS%20-%20a%20revolutionary%20WordPress%20plugin%20for%20AI-powered%20content%20creation%21%20%23WordPress%20%23AI%20%23SaaS
" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-twitter me-1" aria-hidden="true"></i> <?php esc_html_e('Tweet', 'wpaisaas'); ?>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://https://wordpress.org/plugins/wp-ai-saas" class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> <?php esc_html_e('Share', 'wpaisaas'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
