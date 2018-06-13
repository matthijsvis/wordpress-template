<?php include('header.php'); ?>

<body>

<?php show_admin_bar(true) ?>
<header>
    <nav class="nav">
        <?php wp_nav_menu(); ?>
    </nav>
</header>

<div class="pos-alles">
    <main>
        <?php
        if (have_posts()) :

            /* Start the Loop */
            while (have_posts()) : the_post();
                ?>

                <h3><?php the_title() ?></h3>
                <div class="content">
                    <?php echo do_shortcode("[wp_blog_designer]");  ?>
                </div>
            <?php
            endwhile;


        endif;
        ?>
    </main>

    <?php include('aside.php'); ?>

</div>

<?php include('footer.php'); ?>

</body>
</html>