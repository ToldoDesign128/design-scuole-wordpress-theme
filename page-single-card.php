<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Design_Scuole_Italia
 */

get_header();
?>

<main id="main-container" class="main-container">
    <section id="debug" class="resize-container" style="resize: both;overflow: hidden auto;">

        <?php get_template_part("template-parts/common/breadcrumb"); ?>
        <?php 
        have_posts();
        the_post();
        
        
        if ( has_post_thumbnail() ) {
            // the_post_thumbnail();
        }

        
        
        ?>
        <div class="container">
            <div class="row variable-gutters">
                <div class="col-2">
                    <?php get_template_part("martini-template-parts/single/card"); ?>
                </div>
            </div>
            <div class="row variable-gutters">
                <div class="col-4">
                    <?php get_template_part("martini-template-parts/single/card"); ?>
                </div>
            </div>
            <div class="row variable-gutters">
                <div class="col-8">
                    <?php get_template_part("martini-template-parts/single/card"); ?>
                </div>
            </div>
            <div class="row variable-gutters">
                <div class="col-md-12">
                    <?php get_template_part("martini-template-parts/single/card"); ?>
                </div>
            </div>
        </div>
        <?php 
        get_template_part("martini-template-parts/single/card"); 
        ?>
        <?php 
        // get_template_part("martini-template-parts/single/card", '111', '111111'); 
        ?>

<section id="loop-news-home" class="container">

    <div class="row mt-5 mt-lg-0 mr-0 ml-0">

        <!--LOOP NEWS  -->
        <div class="col-12 col-lg-7">
          <?php get_template_part("martini-template-parts/loop/loop-news-home") ?>
        </div><!-- col-12 col-lg-7 -->
        
        <!--LOOP PROGETTI  -->
        <div class="col-12 col-lg-4 offset-lg-1">
          <?php get_template_part("martini-template-parts/loop/loop-progetti-home") ?>
        </div><!-- col-12 col-lg-4 offset-lg-1 -->
        
    </div>
    <!--.row -->

  </section>


<section id="loop-news-home" class="container">

<div class="row mt-5 mt-lg-0 mr-0 ml-0">

    <!--LOOP NEWS  -->
    <div class="col-12 col-lg-7">
    <div class="cards-container m-0 p-0">

        <div class="container m-0 p-0">

        <div class="row">

            <h4 class="col-12">Ultime news </h4>

            <div class="container-news col-12 row mb-lg-4">
            
            <?php
                $loop = new WP_Query( array( 
                'post_type'         => 'post', 
                'post_status'       => 'publish', 
                'orderby'           => 'count', 
                'order'             => 'DESC', 
                'posts_per_page'    => 3,)
                );

                while ($loop -> have_posts()) : $loop -> the_post(); 

            ?>
            <div class="col-12 col-lg-4">
            
                
                <?php get_template_part("martini-template-parts/single/card"); ?>

            </div>

                <?php endwhile; ?>

            </div><!--.container-news -->

            <div class="button-container col-12 mb-4 mb-lg-0 mt-lg-0 pr-3">

                <a class="btn-lg-default-outline w-100" href="novita" class="col-12 p-0">

                <button>Vai alla sezione</button>

                </a>

            </div>    
        </div>
        </div><!-- container m-0 p 0 -->
        </div><!-- .cards-container-->
    </div><!-- col-12 col-lg-7 -->
    
    <!--LOOP PROGETTI  -->
    <div class="col-12 col-lg-4 offset-lg-1">
      
<div class="p-0" id="progetti-home">

<div class="container m-0 p 0">

  <div class="row">
      
    <h4 class="col-12">Alcuni dei nostri progetti </h4>

    <div class="container-progetti col-12 mb-4 martini-card-horizontal">
      
      <?php
        $loop = new WP_Query( array( 
          'post_type'         => 'scheda_progetto',
          'post_status'       => 'publish', 
          'orderby'           => 'count', 
          'order'             => 'DESC', 
          'posts_per_page'    => 2, )
        );
        
        while ($loop -> have_posts()) : $loop -> the_post(); 
        
      ?> 
                <?php get_template_part("martini-template-parts/single/card"); ?>
                <?php get_template_part("martini-template-parts/single/card"); ?>
                <?php get_template_part("martini-template-parts/single/card"); ?>
      <?php endwhile; ?>

    </div><!--.container-progetti -->
        
    <div class="col-12 mt-4 mt-lg-0 pl-0 pr-0 w-100">

      <a class="btn-lg-default-outline" href="scheda-progetto">
        <button>Vedi tutti</button>
      </a>

    </div><!--.col-12 -->

  </div><!-- row -->

</div><!-- container m-0 p 0 -->

</div><!-- cards-container col-12 col-lg-4 offset-lg-1 p-0 -->
    </div><!-- col-12 col-lg-4 offset-lg-1 -->
    
</div>
<!--.row -->

</section>

        <?php
        while ( have_posts() ) :
            the_post();
            set_views($post->ID);
            ?>
            <section class="section bg-white">
                <div class="container">
                    <div class="row variable-gutters">
                        <div class="col-md-12 article-title-author-container">
                            <div class="title-content">
                                <h1><?php the_title(); ?></h1>
                            </div><!-- /title-content -->
                        </div><!-- /col-md-6 -->
                    </div><!-- /row -->
                </div><!-- /container -->
            </section>

            <section class="section bg-white">
                <div class="container ">
                    <article class="article-wrapper">


                        <div class="row variable-gutters">
                            <div class="col-lg-12">
                                <?php
                                the_content();
                                ?>
                            </div>
                        </div>
                        <div class="row variable-gutters">
                            <div class="col-lg-12">
                                <?php
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="row variable-gutters">
                            <div class="col-lg-12">
                                <?php get_template_part( "template-parts/single/bottom" ); ?>
                            </div><!-- /col-lg-9 -->
                        </div><!-- /row -->

                    </article>
                </div>
            </section>
        <?php
        endwhile; // End of the loop.
        ?>
    </section>
</main><!-- #main -->


<?php
get_footer();
