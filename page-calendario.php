<?php
/* Template Name: Calendario
 *
 * didattica template file
 *
 * @package Design_Scuole_Italia
 */

get_header();


?>

<main id="main-container" class="main-container">

    <section id="text-block" class="section bg-white mt-5 mb-5">
        <div class="container">
            <div class="row">

                <div class="col-12">
                <h2>Calendario d'istituto</h2>
                    <?php echo do_shortcode('[calendar id="613"]'); ?>
                </div>

            </div><!-- /row -->
        </div><!-- /container -->
    </section>



</main>



<?php
get_footer();