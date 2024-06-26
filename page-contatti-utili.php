<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Scuole_Italia
 */

get_header();
?>

<main id="main-container" class="main-container">
        <?php get_template_part("martini-template-parts/hero/hero_title"); ?>
        <?php get_template_part("template-parts/common/breadcrumb"); ?>
        <section id="primary" class="container" >        
            <div class="content mx-5 my-5" role="main" data-target="index" >
            <?php the_content(); ?>
            </div><!-- end content -->
        </section><!-- end primary -->
</main>

<?php
get_footer();