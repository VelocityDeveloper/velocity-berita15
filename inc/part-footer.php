<footer class="site-footer pb-3" id="colophon">

    <div class="container bg-light p-3 p-md-4">
        <div class="row">
            <?php 
            for ($x = 1; $x <= 4; $x++) : 
                if (is_active_sidebar('footer-widget-' . $x)) {
                    echo '<div class="col-md py-md-3">';
                    dynamic_sidebar('footer-widget-' . $x);
                    echo '</div>';
                } 
            endfor;
            ?>
        </div>
    </div>

    <div class="site-info text-start bg-light container border-top px-md-4 px-3 py-2">
        <small>
            © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.
            <br>
            Design by <a class="opacity-50" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->

</footer>