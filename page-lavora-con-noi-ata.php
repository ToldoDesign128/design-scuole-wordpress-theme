<?php
get_header()
?>
<main id="main-container" class="main-container">
    <?php get_template_part("martini-template-parts/hero/hero_title") ?>
    <?php get_template_part("template-parts/common/breadcrumb"); ?>

    <section id="input-lavora-con-noi-ata" class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <?php echo do_shortcode('[contact-form-7 id="743" title="Lavora con noi - ATA"]') ?>

                <p class="disclaimer mt-4 text-sm primary bold">Attenzione: per inviare più candidature è necessario compilare più volte il modulo</p>
            </div>
        </div>
    </section>
    <!-- Scheda per controllo crawler -->
    <div class="container d-none">
        <?php get_template_part("martini-template-parts/scheda-servizio");?>
    </div>
</main>

<?php
get_footer()

?>
