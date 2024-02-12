<div class="row pt-4">
    <?php
    for ($x = 1; $x <= 4; $x++) {
        if (is_active_sidebar('home-widget-' . $x)) {
            echo '<div class="col-md-3">';
            dynamic_sidebar('home-widget-' . $x);
            echo '</div>';
        }
    }
    ?>
</div>