<!--github: github.com/matthijsvis/wordpress-template-->

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
        <div class="post">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_title('<h2>', '</h2>');
        the_content();
        endwhile; else: ?>
        <p>sorry, geen posts gevonden</p>
        <?php endif; ?>
        </div>

    </main>

    <?php include('aside.php'); ?>

</div>
<?php include('footer.php'); ?>
</body>
</html>