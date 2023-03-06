<?php
/* Template Name: 2 Livello - ITE serale
 *
 * didattica template file
 *
 * @package Design_Scuole_Italia
 */

get_header();


?>

    <main id="main-container" class="main-container">

        <?php get_template_part("martini-template-parts/hero/hero_title"); ?>


        <?php
        while ( have_posts() ) :
            the_post();
            set_views($post->ID);
            $user_can_view_post = dsi_members_can_user_view_post(get_current_user_id(), $post->ID);

            // get all post meta cmb2
            $percorsi = dsi_get_percorsi_of_scuola($post);
            // print_r($percorsi);
            //$sottotitolo = dsi_get_meta("sottotitolo");

            // $link_struttura_didattica = dsi_get_meta("link_struttura_didattica");

            $carriera = dsi_get_meta("carriera");
            $programma = dsi_get_meta("programma");
            $descrizione = dsi_get_meta("descrizione");
            $corso_di_studio = dsi_get_meta("corso_di_studio");
            $iscrizione_selezioni = dsi_get_meta("iscrizione_selezioni");

            $calendario_classi_descrizione = dsi_get_meta("calendario_classi_descrizione");
            $calendario_classi_file = dsi_get_meta("calendario_classi_file");

            $fasi_scadenze = dsi_get_meta("fasi_scadenze");
            
            $luoghi = dsi_get_meta("luoghi");
           
            $libri_testo_descrizione = dsi_get_meta("libri_testo_descrizione");
            $libri_testo_file = dsi_get_meta("libri_testo_file");

            $link_schede_documenti = dsi_get_meta("link_schede_documenti");
            $file_documenti = dsi_get_meta("file_documenti");
            $altre_info = dsi_get_meta("altre_info");

       
            $mail = dsi_get_meta("mail");
            $telefono = dsi_get_meta("telefono");
            $contatti_telefonici = dsi_get_meta("contatti_telefonici");
            ?>

        <section id="text-block" class="section bg-white">
            <div class="container">
                <div class="row main-content variable-gutters">

                    <div class="col-lg-8 my-5">
                        <div class="row">
                            <h2 id="art-par-descrizione"><?php _e("Cosa si studia", "design_scuole_italia"); ?></h2>
                            <div class="col-12">
                                <div class="article-description wysiwig-text">
                                    <?php the_content(); ?>
                                </div>
                            </div><!-- /col-lg-9 -->
                        </div><!-- /row -->
                        
                    </div><!-- /main content -->

                    <?php
                            // do action per innestare elementi tramite plugin / child theme
                            do_action("dsi_indirizzo_content_after_description");
                            ?>
                            
                            <!-- TABELLA ORARIO SETTIMANALE -->
                             <?php if(($calendario_classi_file || $calendario_classi_descrizione)){ ?>
                                <!-- <h4 id="art-par-calendario" class="mt-4"><?php _e("Calendario delle classi", "design_scuole_italia"); ?></h4> -->

                                <div class="row variable-gutters pt-5">
                                    <div class="col-lg-12">
                                        <div class="col-lg-12 px-0 wysiwig-text">
                                            <?php echo wpautop($calendario_classi_descrizione); ?>
                                        </div>
                                        <div class="card-deck card-deck-spaced">
                                            <?php global $idfile, $nomefile;
                                            if (is_array($calendario_classi_file) && count($calendario_classi_file) > 0) {

                                                foreach ($calendario_classi_file as $idfile => $nomefile) {
                                                    get_template_part("template-parts/documento/file");
                                                }
                                            }
                                            ?>
                                        </div><!-- /card-deck card-deck-spaced -->
                                    </div><!-- /col-lg-9 -->
                                </div><!-- /row -->
                            <?php } ?>


                            <div class="pt-5">
                                    <?php         
                                // print_r($fasi_scadenze);
                                if(is_array($fasi_scadenze) && count($fasi_scadenze)>0) {
                                    ?>
                                    <h4 id="art-par-tempi-scadenze"><?php _e("Tempi e scadenze", "design_scuole_italia"); ?></h4>
                                    <div class="row variable-gutters">
                                        <div class="col-lg-9">
                                            <div class="calendar-vertical mb-5">
                                                <?php
                                                foreach ($fasi_scadenze as $fase){
                                                    $arrdata =  explode("-", $fase["data_fase"]);
                                                    $monthName = date_i18n('M', mktime(0, 0, 0, $arrdata[1], 10)); // March

                                                    ?>
                                                    <div class="calendar-date">
                                                        <div class="calendar-date-day">
                                                            <small><?php echo $arrdata[2]; ?></small>
                                                            <p><?php echo $arrdata[0]; ?></p>
                                                            <small><b><?php echo $monthName; ?></b></small>
                                                        </div><!-- /calendar-date-day -->
                                                        <div class="calendar-date-description rounded">
                                                            <div class="calendar-date-description-content">
                                                                <?php echo wpautop($fase["desc_fase"]); ?>
                                                            </div><!-- /calendar-date-description-content -->
                                                        </div><!-- /calendar-date-description -->
                                                    </div><!-- /calendar-date -->
                                                    <?php
                                                }
                                                ?>
                                            </div><!-- /calendar-vertical -->
                                        </div><!-- /col-lg-9 -->
                                    </div><!-- /row -->
                                    <?php
                                }?>
                            </div>
                            
                            <div class="pt-5">
                                    <?php
                                if(trim($altre_info) != ""){
                                    ?>
                                    <h4 id="art-par-altre-info"><?php _e("Altre informazioni", "design_scuole_italia"); ?></h4>
                                    <div class="row variable-gutters">
                                        <div class="col-lg-9 wysiwig-text">
                                            
                                            <?php echo wpautop($altre_info); ?>
                                        </div><!-- /col-lg-9 -->
                                    </div><!-- /row -->
                                    
                                    <?php
                                }?>
                            </div>


                    <div id="sidebar" class="col-lg-3 offset-lg-1 px-5 px-3 px-lg-3 py-5">
                        <aside class="aside-main aside-sticky">
                            <div class="col-12 col-lg-9" id="program-legend">
                                

                                <!-- Altre informazioni -->
                                 <?php
                                $ulteriori_informazioni = get_post_meta( get_the_ID(), 'martini_info', true );
                                if(trim($ulteriori_informazioni) != ""){
                                    ?>
                                    <h5>Altre informazioni</h5> 
                                    <div class="row variable-gutters">
                                        <div id="quotes" class="col-12 wysiwig-text">
                                            <?php echo wpautop($ulteriori_informazioni); ?>
                                        </div>
                                    </div><!-- /row -->
                                    <?php
                                }
                                ?>
                                <!-- //Altre informazioni -->

                                <!-- Info variabili - titolo -->
                                 <?php
                                $info_variabili_titolo = get_post_meta( get_the_ID(), 'martini_titolo', true );
                                if(trim($info_variabili_titolo) != ""){
                                    ?>
                                    <h5><?php echo wpautop($info_variabili_titolo); ?></h5> 
                                    <?php
                                }
                                ?>
                                <!-- //Info variabili - titolo -->

                                <!-- Info variabili -->
                                 <?php
                                $info_variabili = get_post_meta( get_the_ID(), 'martini_info_variable', true );
                                if(trim($info_variabili) != ""){
                                    ?>
                                    <div class="row variable-gutters">
                                        <div class="col-12 wysiwig-text">
                                            <?php echo wpautop($info_variabili); ?>
                                        </div>
                                    </div><!-- /row -->
                                    <?php
                                }
                                ?>
                                <!-- //Info variabili -->

                                

                                <!-- Campo contatti -->
                                <?php 
                                $emails = get_post_meta( get_the_ID(), 'martini_email', true );
                                // $phone = get_post_meta( get_the_ID(), 'martini_phone', true );
                                $contattiphone = get_post_meta( get_the_ID(), 'martini_phone', true )

                                
                                if(is_array ($emails) && count($emails) && strlen($emails[0])){ ?>
                                <h5>Contatti</h5> 
                                <ul class="link-list">
                                    
                                    <?php foreach ( $emails as $email){?>
                                    
                                    <li>
                                         <a href="mailto:<?php echo $email;?>" target=blank> <?php echo $email;?> </a> 
                                    </li>
                                    <?php }?>
                                   
                                </ul>
                                <?php } ?>

                                <?php
                                if(is_array ($contatti_telefonici) && count($contatti_telefonici) && strlen($contatti_telefonici[0])){ ?>
                                <h6>Telefono</h6>
                                <ul class="">
                                    
                                    <?php foreach ( $contatti_telefonici as $contatti_telefonici){?>
                                    
                                    <li>
                                         <a href="tel:<?php echo $phone;?>"> <?php echo $phone;?> </a> 
                                    </li>
                                    <?php }?>
                                   
                                </ul>

                                <?php } ?>


                                <!--/Campo contatti -->
                                
                                <!-- Campo modulistica -->
                                <?php 
                                $multidocuments_download = get_post_meta( get_the_ID(), 'documents_download', true );
                                if(is_array ($multidocuments_download) && !empty($multidocuments_download)){ ?>
                                <h5>Modulistica</h5> 
                                <ul class="link-list uppercase_text">
                                    
                                    <?php foreach ( $multidocuments_download as $docID => $documenti){?>
                                    
                                    <li>
                                         <a href="<?php echo $documenti;?>" target=blank> <?php echo get_the_title($docID);?> </a> 
                                    </li>
                                    <?php }?>
                                    
                                </ul>
                                <?php } ?>
                                <!--/Campo modulistica -->

                                <!-- Campo link -->
                                <?php 
                                $link_url = get_post_meta( get_the_ID(), 'martini_url', true );
                                
                                if(is_array ($link_url) && count($link_url) && strlen($link_url[0])){ ?>
                                <h5>Link utili</h5> 
                                <ul class="link-list">
                                    
                                    <?php foreach ( $link_url as $link_url){?>
                                    
                                    <li>
                                         <a href="<?php echo $link_url;?>" target=blank> <?php echo $link_url;?> </a> 
                                    </li>
                                    <?php }?>
                                   
                                </ul>
                                <?php } ?>
                                <!--/Campo link -->
                            </div>  
                        </aside>
                    </div> <!--/ sidebar -->
                </div><!-- /row -->
            </div><!-- /container -->
        </section>


    </main>

     <?php
        endwhile; // End of the loop.
        ?>


<?php
get_footer();