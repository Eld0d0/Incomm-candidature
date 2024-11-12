<?php
wp_head();
get_header();

$ingredients = get_post_meta(get_the_ID(), '_ingredients', true);
$cooking_time = get_post_meta(get_the_ID(), '_cooking_time', true);
$steps = get_post_meta(get_the_ID(), '_steps', true);
?>
<main id="content" class="site-main">
    <div class="page-header">
        <h1><?php the_title(); ?></h1>
    </div>
    <div class="page-content">
        <!-- Contenu principal de la recette -->
        <section class="recipe-description">
            <h2>Description</h2>
            <div class="description">
                <?php the_content(); ?>
            </div>
            <div class="recipe-image">
                <?php
                if (has_post_thumbnail()) {
                    the_post_thumbnail('full', array('class' => 'recipe-image-frame'));
                }
                ?>
            </div>
        </section>

        <!-- Liste des ingrédients -->
        <?php
        if ($ingredients) { ?>
            <section class="recipe-ingredients">
                <h2>Ingrédients</h2>
                <ul>
                    <?php
                    $ingredients_list = explode("\n", $ingredients);
                    foreach ($ingredients_list as $ingredient) {
                        echo '<li>' . esc_html($ingredient) . '</li>';
                    }
                    ?>
                </ul>
            </section>
        <?php } ?>

        <!-- Temps de cuisson -->
        <?php
        if ($cooking_time) { ?>

            <section class="recipe-cooking-time">
                <h2>Temps de Cuisson</h2>
                <p><?php echo esc_html($cooking_time); ?> minutes</p>
            </section>
        <?php } ?>

        <!-- Étapes de la recette -->
        <?php
        if ($steps) { ?>
            <section class="recipe-steps">
                <h2>Étapes</h2>
                <ol>
                    <?php
                    $steps_list = explode("\n", $steps);
                    foreach ($steps_list as $steps) {
                        echo '<li>' . esc_html($steps) . '</li>';
                    }
                    ?>
                </ol>
            </section>
        <?php } ?>
    </div>
</main>
<?php
get_footer();
