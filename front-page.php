<?php

get_header();
?>
  <main id="main-container" class="main-container petrol">
  
  <!-- HERO -->  
  <section id="hero"> 
      <?php
      get_template_part("template-parts/hero/hero_page")
      ?>
      
    </section><!--#hero -->
    
    <!-- PRESENTAZIONE SCUOLA -->
    <section id="presentazione-scuola" class="container mt-5"> 
      <div class="row">
        <div id="container-presentazione" class="col-12 col-lg-8">
          <div id="nostro-istituto">
            <h2>Il nostro istituto</h2>
            <p>L’istituto Martino Martini è una scuola secondaria di secondo grado sita nel comune di Mezzolombardo, facilmente raggiungibile attraverso i mezzi di trasporto.
            Nell’istituto sono presenti 8 indirizzi di studio, 4 di ambito liceale e 4 di ambito tecnico.</p>
          </div><!--#nostro-istituto -->
      
      
          <div id="mission-vision">
            <h3>La scuola secondo noi</h3>
            <p>Grazie alla pluralità di indirizzi di studio che caratterizzano la nostra offerta formativa, ciascuno dei quali offre alla comunità scolastica nuovi stimoli ed opportunità, l’Istituto Martino Martini ha fatto propria un’idea di scuola i cui valori si fondano sulla <strong>flessibilità,</strong> sull’<strong>innovazione</strong> e sulla <strong>personalizzazione.</strong>
              Attenti a cogliere le opportunità di miglioramento offerte dalle innovazioni in campo didattico, sia di natura tecnologica che metodologica, i docenti del Martini lavorano collegialmente da anni sulle tematiche dell’accoglienza e dell’inclusione dei ragazzi, accettando la difficile sfida del successo formativo di tutti gli studenti.
              L’idea di fondo è quella di offrire ai ragazzi un ambiente di apprendimento sereno e motivante, ma nel contempo attento alla costruzione di competenze solide, indispensabili per il progetto di vita post-diploma e spendibili sia in ambito lavorativo che universitario.
              </p>
          </div><!--#mission-vision -->
        </div><!--#container-presentazione -->
    

        <div id="sidebar-presentazione" class="offset-lg-1 col-12 col-lg-3 order-1 order-lg-0">
          <h4 class="d-lg-none">Area Docenti</h4>
            <div class="row mt-4 mt-lg-0">
              <a id="btn-lg-default" href="#" target="blank" class="col-12">
                <button>Registro elettronico</button>
              </a>
              <a id="btn-lg-default-outline" href="#" target="blank" class="col-12">
                <button>Orari docenti</button>
              </a>
              <a id="btn-lg-default-outline" href="#" target="blank" class="col-12">
                <button>GestOre</button>
              </a>
            </div><!--.row -->

          <frame> 
            <!--QUI CI VA IL CALENDARIO  -->
          </frame>
        </div><!--#sidebar-presentazione -->
        
        <div id="button-navigazione" class="col-12 my-4"> 
        <h4 class="d-lg-none">Scopri di più</h4>
          <div class="row mt-4 mt-lg-0">
            <div class="col-6 col-md-3">
              <a id="btn-lg-default-outline" href="#" target="blank">
                  <button><span>DIDATTICA</span> <p>Corso ITE serale</p></button>
              </a>
            </div>
            <div class="col-6 col-md-3">
              <a id="btn-lg-default-outline" href="https://martinomartini.local/didattica-2/offerta-formativa/" target="blank">
                <button><span>DIDATTICA</span> <p>Offerta formativa</p></button>
              </a>
            </div>
            <div class="col-6 col-md-3">
              <a id="btn-lg-secondary-outline" href="#" target="blank">
                <button><span>SERVIZI</span> <p>Open days</p></button>
              </a>
            </div>
            <div class="col-6 col-md-3">
              <a id="btn-lg-secondary-outline" href="#" target="blank">
                <button><span>SERVIZI</span> <p>ASL</p></button>
              </a>
            </div>
          </div><!--.row -->
        </div><!--#button-navigazione -->
      </div><!--.row -->
    </section><!--#presentazione-scuola .container-->
   
    <!--LOOP NEWS  -->
    <section id="loop-news-home" class="container"> 
      <div class="row mt-5 mt-lg-0">
        <div class="cards-container">
          <h4>Ultime news </h4>
          <div class="container-news">
        
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
              <article class="card">
                <!--<div class="card-bg"> -->
                    <div class="card-img-top card-img position-relative">
                      <a class="img-loop" href="<?php the_permalink();?>">
                        <?php the_post_thumbnail("news-thumb");?>
                        <div></div>
                      </a>
                      <div class="position-absolute" id="card_article_badge"> 
                        <?php get_template_part("template-parts/common/badges-argomenti"); ?>
                      </div>
                    </div>
                    <div class="card-body">
                      <p class="card-title primary"> <?php the_title(); ?> </p>
                      <a href="<?php the_permalink();?>" id="btn-mini-default"> 
                        <button class="w-auto">
                          <span>Scopri</span>
                        </button>
                      </a>
                    </div>
                  <!-- </div> -->
              </article> <!--.card -->
            <?php endwhile; ?>
          </div><!--.container-news -->
          <div class="button-container w-100 mt-4 mt-lg-0">
            <a id="btn-lg-default-outline" href="<?php get_page_by_path('novità')?>" class="col-12 p-0">
              <button>Vai alla sezione</button>
            </a>
          </div>
          
        </div><!-- .cards-container-->

        <!--LOOP PROGETTI  -->
        <div class="col-12 col-lg-4 offset-lg-1 mt-5 mt-lg-0 pl-0" id="progetti-home">
          <h4>Alcuni dei nostri progetti </h4>
          <div class="container-progetti">

            <?php
                $loop = new WP_Query( array( 
                  'post_type'         => 'scheda_progetto',
                  'post_status'       => 'publish', 
                  'orderby'           => 'count', 
                  'order'             => 'DESC', 
                  'posts_per_page'    => 2, )
                );
            
              while ($loop -> have_posts()) : $loop -> the_post(); ?> 

              <article class="card-progetti"> 
                <div class="row-img">
                  <a class="img-loop" href="<?php the_permalink();?>">
                    <?php 
                    if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
                          echo get_the_post_thumbnail($post->ID);
                        }?> 
                    <div></div> 
                  </a>
                </div><!--.row-img -->
              
                  <div class="card--body">
                    <a href="<?php the_permalink();?>">
                      <h5 class="h6 primary"><?php echo mb_strimwidth(get_the_title(), 0, 60,);?></h5>
                      <p class="text-sm"><?php echo substr(strip_tags(dsi_get_meta("descrizione")), 0, 60);?>...</p>
                    </a>
                  </div>
              
              </article>
            <?php endwhile; ?>
          </div><!--.container-progetti -->

        <div class="mt-4 mt-lg-0 pl-0 pr-0 w-100">
          <a id="btn-lg-default-outline" href="">
            <button>Vedi tutti</button>
          </a>
        </div><!--.col-12 -->
      </div> <!--.row -->
    </section><!--#loop-news-home .container -->
    
    <!--SPAZI E STORIA  -->
    <section id="spazi-storia" class="container mt-5"> 
      <div class="row mb-5">
        <div id="gli-spazi-img" class="col-lg-6 col-12 mb-3 mb-lg-0">
          <img class="w-100" src="https://www.tandemconstruction.com/sites/default/files/styles/project_slider_main/public/images/project-images/IMG-Fieldhouse-10.jpg?itok=Whi8hHo9" alt="">
        </div><!--#gli-spazi-img -->

        <div id="gli-spazi-txt" class="col-lg-6 col-12">
          <h4>Gli spazi</h4>
          <p>La scuola si compone di due sedi: la sede di via Perlasca e la sede di via Filzi. L’edificio di via Perlasca , costruito secondo criteri improntati al risparmio energetico e alla sostenibilità ambientale, ospita gli studenti in ambienti luminosi e spaziosi, con laboratori attrezzati, una grande palestra, un auditorium e ampi spazi verdi all’esterno. L’edificio di via Filzi, sede scolastica storica di Mezzolombardo, è stato di recente rinnovato per ospitare classi e laboratori dell’istituto in crescita negli ultimi anni scolastici. </p>
          <a id="btn-lg-default-outline" href="https://martinomartini.local/luogo/"><button class="w-auto">Scopri</button></a>
        </div><!--#gli-spazi-txt -->
      </div><!--.row -->
      
      <div class="row">
        <div id="storia-img" class="col-lg-6 col-12 mb-3 mb-lg-0 order-lg-2">
          <img class="w-100"src="https://www.tandemconstruction.com/sites/default/files/styles/project_slider_main/public/images/project-images/IMG-Fieldhouse-10.jpg?itok=Whi8hHo9" alt="">
        </div><!--#storia-img --> 
        <div id="storia-txt" class="col-lg-6 col-12">
          <h4>La storia di Martino Martini</h4>
          <p>Missionario gesuita nato nel 1614 a Trento, Martino Martini fu un noto geografo e cartografo che visse a lungo nella Cina imperiale, viaggiando entro i suoi confini allo scopo di raccogliere informazioni di natura scientifica e geografica. 
          Il nostro istituto, che da sempre promuove diversi progetti nell’ambito dell’internazionalizzazione, prosegue idealmente la missione di Martino Martini riconoscendo il valore fondamentale per la nostra società della conoscenza approfondita del nuovo e del diverso e promuovendo la diffusione dei saperi tradizionali quale strumento ineludibile per la formazione di cittadini consapevoli e responsabili.</p>
          <a id="btn-lg-default-outline" href="https://martinomartini.local/la-scuola-2/presentazione/"><button class="w-auto">Scopri</button></a>
        </div><!--#storia-txt -->
      </div><!--.row -->
    </section><!--#spazi-storia .container --> 
  </main>
  <?php
get_footer();
