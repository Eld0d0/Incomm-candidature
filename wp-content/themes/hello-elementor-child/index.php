<?php
/*
Template Name: Page d'accueil
*/
get_header();
?>

<main id="content" class="site-main">
    <h1>Dernières Recettes</h1>

    <?php
    $args = array(
        'post_type' => 'recette',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    // Custom Query
    $recettes_query = new WP_Query($args);
    ?>

    <div class="recettes-slider">
        <?php if ($recettes_query->have_posts()) : ?>
            <?php while ($recettes_query->have_posts()) : $recettes_query->the_post(); ?>
                <div class="recette-item">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="recette-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <h2><?php the_title(); ?></h2>
                    </a>
                    <p><?php echo wp_trim_words(get_the_content(), 10, '...'); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Aucune recette trouvée.</p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</main>

<?php get_footer(); ?>