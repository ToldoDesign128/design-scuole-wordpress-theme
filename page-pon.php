<?php

/** Page for PON */

get_header();

?>

<main id="main-container" class="main-container">

    <?php get_template_part("martini-template-parts/hero/hero_title"); ?>
    <?php get_template_part("template-parts/common/breadcrumb"); ?>
    <section id="container-spazi" class="container">

        <?php
        $loop = new WP_Query(array(
            'post_type'         => 'pon',
            'post_status'       => 'publish',
            'orderby'           => 'date',
            'order'             => 'ASC',
            'orderby'           => 'title',
            'posts_per_page'    => 999,
        )); ?>


        <!-- loop corsi apprendimento -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Apprendimento e socialità</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'apprendimento') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi competenze -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Competenze di base</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'competenze') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi laboratori -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Laboratori didattici innovativi</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'laboratori') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi pensiero -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Pensiero computazionale e didattica digitale</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'pensiero') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi potenziamento -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Potenziamento della cittadinanza europea</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'potenziamento') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi pubblicità -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Pubblicità PON</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'pubblicità') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi smart -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Smart class primo ciclo</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'smart') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi smartsec -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Smart class secondo ciclo</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'smartsec') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi socialità -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Socialità, apprendimento, accoglienza</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'socialità') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
        <!-- loop corsi socialità -->
        <details class="row align-items-center my-5 mx-3">
            <summary class="h4 col-12 pl-0 ml-lg-n2">Percorsi per le competenze trasversali e l'orientamento (PCTO) all'estero</summary>

            <?php
            while ($loop->have_posts()) : $loop->the_post();
                $radio_input = get_post_meta(get_the_ID(), '_martini_pon_wiki_test_radio', true);
                $file = get_post_meta(get_the_ID(), '_martini_pon_file_pon', true);

                if ($radio_input == 'progetti_trasversali') { ?>
                    <article>
                        <div class="row mt-3 ml-4 align-items-center">
                            <a href="<?php echo array_values($file)[0]; ?>">
                                <svg xmlns="http:www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                </svg>
                                <?php the_title(); ?>
                            </a>
                        </div>
                    </article><?php
                            }
                        endwhile;
                                ?>
        </details>
    </section>
</main>

<?php
get_footer();
?>