<?php

/*
Theme Name: Hello Elementor Child
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

// Création du CPT Recette
function creer_cpt_recettes()
{
    $data = [
        'labels' => [
            'name' => 'Recettes',
            'singular_name' => 'Recette',
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'recettes'],
        'supports' => ['title', 'editor', 'thumbnail'],
    ];
    register_post_type('recette', $data);
}
add_action('init', 'creer_cpt_recettes');



// Ajout du meta box liste d'ingrédient
function add_ingredient_meta_boxes() {
    add_meta_box(
        'recipe_ingredient',
        'Liste des ingrédients',
        'ingredient_meta_box',
        'recette',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_ingredient_meta_boxes');

function ingredient_meta_box($post) {
    $ingredients = get_post_meta($post->ID, '_ingredients', true);

    $ingredients_array = !empty($ingredients) ? explode("\n", $ingredients) : [];
    ?>

    <label for="ingredients">Ingrédients (un ingrédient par ligne) :</label>
    <br>
    <textarea id="ingredients" name="ingredients" rows="6" cols="50"><?php echo esc_textarea(implode("\n", $ingredients_array)); ?></textarea>
    
    <?php
}

// Ajout du meta box étapes
function add_etapes_meta_boxes() {
    add_meta_box(
        'recipe_etapes',
        'Étapes',
        'etapes_meta_box',
        'recette',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_etapes_meta_boxes');

function etapes_meta_box($post) {
    $steps = get_post_meta($post->ID, '_steps', true);

    $steps_array = !empty($steps) ? explode("\n", $steps) : [];
    ?>
    <label for="steps">Étapes (une étape par ligne) :</label>
    <br>
    <textarea id="steps" name="steps" rows="4" cols="50"> <?php echo esc_textarea(implode("\n", $steps_array)); ?></textarea>
    <?php
}

// Ajout du meta box du temps de cuisson
function add_temps_cuisson_meta_boxes() {
    add_meta_box(
        'recipe_temps_cuisson',
        'Temps de cuisson',
        'temps_cuisson_meta_box',
        'recette',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_temps_cuisson_meta_boxes');

function temps_cuisson_meta_box($post) {

    $cooking_time = get_post_meta($post->ID, '_cooking_time', true);
    
    ?>
    
    <label for="cooking_time">Temps de Cuisson :</label>
    <br>
    <input type="text" id="cooking_time" name="cooking_time" value="<?php echo esc_attr($cooking_time); ?>" />
    <?php
}


function save_recipe_meta_data($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['ingredients'])) {
        update_post_meta($post_id, '_ingredients', sanitize_textarea_field($_POST['ingredients']));
    }

    if (isset($_POST['cooking_time'])) {
        update_post_meta($post_id, '_cooking_time', sanitize_text_field($_POST['cooking_time']));
    }

    if (isset($_POST['steps'])) {
        update_post_meta($post_id, '_steps', sanitize_textarea_field($_POST['steps']));
    }
}
add_action('save_post', 'save_recipe_meta_data');




// Dépendance pour le carrousel slider
function ajouter_slider_slick() {
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);
    wp_add_inline_script('slick-js', "
        jQuery(document).ready(function($){
            $('.recettes-slider').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    ");
}
add_action('wp_enqueue_scripts', 'ajouter_slider_slick');



