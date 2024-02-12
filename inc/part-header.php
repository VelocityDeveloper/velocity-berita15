<div class="px-3 px-md-0">

    <div class="header-top pb-3 pt-1">
        <div class="row justify-content-md-between">
            <div class="col-md-3 d-none d-md-block text-start">
                <small>
                <?php echo date( 'l d F Y', current_time( 'timestamp', 0 ) ); ?>
                </small>
            </div>
            <div class="col-md-6 text-center">
                <?php echo the_custom_logo(); ?>
            </div>
            <div class="col-md-3 text-end">
                <div class="d-none d-md-block">
                    <?php echo justg_get_sosmed(); ?>
                </div>
                <form action="<?php echo get_site_url();?>" method="get" class="d-flex mt-2 overflow-hidden">
                    <input type="text" name="s" placeholder="Search" class="bg-light form-control form-control-sm rounded-0 me-1 shadow-sm">
                    <button type="submit" class="btn btn-dark btn-sm border-0 bg-color-theme shadow-sm rounded-0 py-1 px-2">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <nav id="main-nav" class="navbar navbar-expand-md d-block navbar-light border-top p-0" aria-labelledby="main-nav-label">
        
        <h2 id="main-nav-label" class="screen-reader-text">
            <?php esc_html_e('Main Navigation', 'justg'); ?>
        </h2>

        <button class="navbar-toggler text-start w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
            <span class="navbar-toggler-icon"></span>
            <small>Menu</small>
        </button>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

            <div class="offcanvas-header justify-content-end">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!-- The WordPress Menu goes here -->
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'primary',
                    'container_class' => 'offcanvas-body',
                    'container_id'    => '',
                    'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 pe-3',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu',
                    'depth'           => 4,
                    'walker'          => new justg_WP_Bootstrap_Navwalker(),
                )
            );
            ?>
        </div><!-- .offcanvas -->

    </nav>
    <div class="bg-color-theme pt-1 mb-2"></div>

    <?php get_berita_iklan('iklan_header'); ?>

</div>