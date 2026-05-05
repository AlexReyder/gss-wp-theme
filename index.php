<?php
get_header();
?>

<main class="site-main">
    <div class="g-container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_title('<h1>', '</h1>');
                the_content();
            }
        }
        ?>
    </div>
</main>

<?php
get_footer();