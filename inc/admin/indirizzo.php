<?php

/**
 * Definisce post type e tassonomie relative ai percorsi di studio
 */
add_action( 'init', 'dsi_register_indirizzo_post_type', -10 );
function dsi_register_indirizzo_post_type() {

    /** indirizzo **/
    $labels = array(
        'name'                  => _x( 'Indirizzo di Studio', 'Post Type General Name', 'design_scuole_italia' ),
        'singular_name'         => _x( 'Indirizzo di Studio', 'Post Type Singular Name', 'design_scuole_italia' ),
        'add_new'               => _x( 'Aggiungi un indirizzo', 'Post Type Singular Name', 'design_scuole_italia' ),
        'add_new_item'          => _x( 'Aggiungi un indirizzo', 'Post Type Singular Name', 'design_scuole_italia' ),
        'featured_image'        => __( 'Logo Identificativo', 'design_scuole_italia' ),
        'edit_item'             => _x( 'Modifica l\'indirizzo', 'Post Type Singular Name', 'design_scuole_italia' ),
        'view_item'             => _x( 'Visualizza l\'indirizzo', 'Post Type Singular Name', 'design_scuole_italia' ),
        'set_featured_image'    => __( 'Seleziona Logo' ),
        'remove_featured_image' => __( 'Rimuovi Logo' , 'design_scuole_italia' ),
        'use_featured_image'    => __( 'Usa come Logo' , 'design_scuole_italia' ),
    );
    $args = array(
        'label'                 => __( 'Indirizzo di studio', 'design_scuole_italia' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
//		'taxonomies'            => array( 'tipologia' ),
        'hierarchical'          => false,
        'public'                => true,
        'menu_position'         => 2,
        'menu_icon'             => 'dashicons-awards',
        'has_archive'           => true,
        'capability_type' => array('indirizzo_di_studio', 'indirizzi_di_studio'),
        'rewrite' => array('slug' => 'indirizzo-di-studio','with_front' => false),
        'map_meta_cap'    => true,
        'description'    => __( "Gli indirizzi di studio che è possibile frequentare nella scuola", 'design_scuole_italia' ),

    );
    register_post_type( 'indirizzo', $args );

    $labels = array(
        'name'              => _x( 'Percorsi di studio e formazione', 'taxonomy general name', 'design_scuole_italia' ),
        'singular_name'     => _x( 'Percorsi di studio', 'taxonomy singular name', 'design_scuole_italia' ),
        'search_items'      => __( 'Cerca Percorso', 'design_scuole_italia' ),
        'all_items'         => __( 'Tutti', 'design_scuole_italia' ),
        'edit_item'         => __( 'Modifica', 'design_scuole_italia' ),
        'update_item'       => __( 'Aggiorna', 'design_scuole_italia' ),
        'add_new_item'      => __( 'Aggiungi', 'design_scuole_italia' ),
        'new_item_name'     => __( 'Nuovo Indirizzo', 'design_scuole_italia' ),
        'menu_name'         => __( 'Percorsi di Studio', 'design_scuole_italia' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'         => true,
        'rewrite'           => array( 'slug' => 'percorsi-di-studio' ),
        'show_in_menu'      => true,
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipologia_strutture',
            'edit_terms'    => 'edit_tipologia_strutture',
            'delete_terms'  => 'delete_tipologia_strutture',
            'assign_terms'  => 'assign_tipologia_strutture'
        )
    );

    register_taxonomy( 'percorsi-di-studio', array( "struttura", "scheda_didattica", "indirizzo" ), $args );


}


/**
 * Crea i metabox del post type percorso
 */
add_action( 'cmb2_init', 'dsi_add_indirizzo_metaboxes' );
function dsi_add_indirizzo_metaboxes() {

    $prefix = '_dsi_indirizzo_';

    /**
     * Stato del servizio
     */
    $cmb_stato = new_cmb2_box( array(
        'id'           => $prefix . 'box_stato',
        'title'        => __( 'Stato', 'design_scuole_italia' ),
        'object_types' => array( 'indirizzo' ),
        'context'      => 'side',
        'priority'     => 'core',
    ) );

    $cmb_stato->add_field( array(
        'id' => $prefix . 'stato',
        'desc' => __( 'Lo stato  indica l\'effettiva fruibilità dell\'indirizzo di studio', 'design_scuole_italia' ),
        'type' => 'radio_inline',
        'default' => 'true',
        'options' => array(
            "true" => __( 'Attivo', 'design_scuole_italia' ),
            "false" => __( 'Disattivo', 'design_scuole_italia' ),
        ),
    ) );


    // conditional field
    $cmb_stato->add_field(array(
        'id' => $prefix . 'desc_stato',
        'name' => __( 'Motivo', 'design_scuole_italia' ),
        'desc' => __( 'Descrizione testuale del motivo per cui  non è attivo. Es. Indirizzo momentaneamente sospeso perché....', 'design_scuole_italia' ),
        'type' => 'textarea_small',
        'attributes'    => array(
            'data-conditional-id'     => $prefix.'stato',
            'data-conditional-value'  => "false",
        ),
    ) );


    $cmb_sottotitolo = new_cmb2_box( array(
        'id'           => $prefix . 'box_sottotitolo',
//		'title'        => __( 'Sottotitolo', 'design_scuole_italia' ),
        'object_types' => array( 'indirizzo' ),
        'context'      => 'after_title',
        'priority'     => 'high',
    ) );


    $cmb_sottotitolo->add_field( array(
        'id' => $prefix . 'indirizzi',
        'name'        => __( 'Percorso di studio', 'design_scuole_italia' ),
        'type'             => 'taxonomy_multicheck_hierarchy_child',
        'select_all_button' => false,
        'taxonomy'       => 'percorsi-di-studio',
        'remove_default' => 'true',

    ) );

    $cmb_sottotitolo->add_field( array(
        'id' => $prefix . 'corso_di_studio',
        'name'        => __( 'Corso di studio *', 'design_scuole_italia' ),
        'desc' => __( 'Indicare l\'opzione del corso di studio all\'interno dell\'indirizzo. Vincoli: 160 caratteri spazi inclusi.' , 'design_scuole_italia' ),
        'type' => 'textarea',
        'attributes'    => array(
            'maxlength'  => '160',
            'required'    => 'required'
        ),
    ) );


    $cmb_undercontent = new_cmb2_box( array(
        'id'           => $prefix . 'box_elementi_indirizzo',
        'title'         => __( 'Dettagli Indirizzo', 'design_scuole_italia' ),
        'object_types' => array( 'indirizzo' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );
        
        $cmb_undercontent->add_field( array(
            'id' => $prefix . 'calendario_classi_descrizione',
            'name'        => __( 'Tabella oraria', 'design_scuole_italia' ),
            'desc' => __( 'Testo introduttivo' , 'design_scuole_italia' ),
            'type' => 'wysiwyg',
    
        ) );
        $cmb_undercontent->add_field( array(
            'id' => $prefix . 'calendario_classi_file',
            'name' => __( 'File pdf del calendario' , 'design_scuole_italia' ),
            'type' => 'file_list',
            // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
            // 'query_args' => array( 'type' => 'image' ), // Only images attachment
            // Optional, override default text strings
            'text' => array(
                'add_upload_files_text' => __('Aggiungi un nuovo calendario', 'design_scuole_italia' ), // default: "Add or Upload Files"
                'remove_image_text' => __('Rimuovi calendario', 'design_scuole_italia' ), // default: "Remove Image"
                'remove_text' => __('Rimuovi calendario', 'design_scuole_italia' ), // default: "Remove"
            ),
        ) );


         $cmb_undercontent->add_field( array(
        'id' => $prefix . 'orario_lezioni_info',
        'name'        => __( 'Orario delle lezioni', 'design_scuole_italia' ),
        'desc' => __( 'Ulteriori informazioni sul Servizio, FAQ ed eventuali riferimenti normativi.<br>Se si desidera inserire un video di YouTube è necessaria l\'opzione "Enable privacy-enhanced mode" che permette di pubblicare il video in modalità youtube-nocookie.' , 'design_scuole_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            // 'textarea_rows' => 4, // rows="..."
            'teeny' => false, // output the minimal editor config used in Press This
        ),

    ) );

    $cmb_undercontent->add_field( array(
        'id' => $prefix . 'libri_testo_descrizione',
        'name'        => __( 'Libri di testo', 'design_scuole_italia' ),
        'desc' => __( 'Testo introduttivo' , 'design_scuole_italia' ),
        'type' => 'textarea',
    ) );
    $cmb_undercontent->add_field( array(
        'id' => $prefix . 'libri_testo_file',
        'name' => __( 'File pdf dei libri di testo' , 'design_scuole_italia' ),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => __('Aggiungi un nuovo file', 'design_scuole_italia' ), // default: "Add or Upload Files"
            'remove_image_text' => __('Rimuovi file', 'design_scuole_italia' ), // default: "Remove Image"
            'remove_text' => __('Rimuovi file', 'design_scuole_italia' ), // default: "Remove"
        ),
    ) );

    /**  repeater fasi_scadenze **/
    $group_field_id = $cmb_undercontent->add_field( array(
        'id'          => $prefix . 'fasi_scadenze',
        'name'        => __('<h1>Fasi e Scadenze</h1>', 'design_scuole_italia' ),
        'type'        => 'group',
        'options'     => array(
            'group_title'    => __( 'Fase {#}', 'design_scuole_italia' ), // {#} gets replaced by row number
            'add_button'     => __( 'Aggiungi una fase', 'design_scuole_italia' ),
            'remove_button'  => __( 'Rimuovi la fase', 'design_scuole_italia' ),
            'sortable'       => true,
            // 'closed'      => true, // true to have the groups closed by default
            //'remove_confirm' => esc_html__( 'Are you sure you want to remove?', 'cmb2' ), // Performs confirmation before removing group.
        ),
    ) );

    $cmb_undercontent->add_group_field( $group_field_id, array(
        'name'       => __('Data fase', 'design_scuole_italia' ),
        'desc'       => __('Data fase', 'design_scuole_italia' ),
        'id'         => 'data_fase',
        'type'       => 'text_date',
        'date_format' => 'd-m-Y'
    ) );

    $cmb_undercontent->add_group_field( $group_field_id, array(
        'name'       => __('Fase', 'design_scuole_italia' ),
        'desc'       => __('Esempio: "Iscrizione alla gita" oppure "Pagamento della gita"', 'design_scuole_italia' ),
        'id'         => 'desc_fase',
        'type'       => 'textarea',
    ) );
    /*** fine fasi e scadenze **/

    // $cmb_undercontent->add_field( array(
    //     'id' => $prefix . 'casi_particolari',
    //     'name'        => __( 'Casi particolari', 'design_scuole_italia' ),
    //     'desc' => __( 'Inserire come testo libero, eventuali casi particolari riferiti all\'ottenimento del Servizio in questione.' , 'design_scuole_italia' ),
    //     'type' => 'textarea',

    // ) );

    $cmb_undercontent->add_field( array(
        'id' => $prefix . 'altre_info',
        'name'        => __( 'Ulteriori informazioni', 'design_scuole_italia' ),
        'desc' => __( 'Ulteriori informazioni sul Servizio, FAQ ed eventuali riferimenti normativi.<br>Se si desidera inserire un video di YouTube è necessaria l\'opzione "Enable privacy-enhanced mode" che permette di pubblicare il video in modalità youtube-nocookie.' , 'design_scuole_italia' ),
        'type'    => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),

    ) );
    
        // Contenuti inseriti nella sidebar

    $cmb_undercontent = new_cmb2_box( array(
        'id'           => $prefix . 'box_sidebar',
        'title'         => __( 'Elementi nella sidebar', 'design_scuole_italia' ),
        'object_types' => array( 'indirizzo' ),
        'context'      => 'normal',
        'priority'     => 'high',
    ) );


    $cmb_undercontent->add_field( array(
        'id' => $prefix . 'carriera',
        'name'        => __( 'Carriera e opportunità successive', 'design_scuole_italia' ),
        'desc' => __( 'Descrivere le opportunità di carriera nello studio e nel lavoro successive al diploma. Ad es.: " Questo percorso di studio ti permette di accedere a..."<br>Se si desidera inserire un video di YouTube è necessaria l\'opzione "Enable privacy-enhanced mode" che permette di pubblicare il video in modalità youtube-nocookie.' , 'design_scuole_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),

    ) );



    $cmb_undercontent->add_field( array(
        'id' => $prefix . 'iscrizione_selezioni',
        'name'        => __( 'Iscrizione e selezioni', 'design_scuole_italia' ),
        'desc' => __( 'Indica la procedura - on line e/o attraverso una delle sedi indicate - da seguire per usufruire del percorso.<br>Se si desidera inserire un video di YouTube è necessaria l\'opzione "Enable privacy-enhanced mode" che permette di pubblicare il video in modalità youtube-nocookie.' , 'design_scuole_italia' ),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false, // show insert/upload button(s)
            'textarea_rows' => 4, // rows="..."
            'teeny' => true, // output the minimal editor config used in Press This
        ),
    ) );

   


    // $cmb_undercontent->add_field( array(
    //     'id'         => $prefix . 'mail',
    //     'name'       => __( 'Riferimento mail', 'design_scuole_italia' ),
    //     'desc'       => __( 'Indirizzo di posta elettronica . ', 'design_scuole_italia' ),
    //     'type'       => 'text_email',
    //     /*'attributes' => array(
    //         'data-conditional-id'    => $prefix . 'childof',
    //         'data-conditional-value' => '0',
    //     ),*/
    // ) );


    // $cmb_undercontent->add_field( array(
    //     'id'         => $prefix . 'telefono',
    //     'name'       => __( 'Riferimento telefonico ', 'design_scuole_italia' ),
    //     'desc'       => __( 'Telefono . ', 'design_scuole_italia' ),
    //     'type'       => 'text',
    //     /*
    //     'attributes' => array(
    //         'data-conditional-id'    => $prefix . 'childof',
    //         'data-conditional-value' => '0',
    //     ),
    //     */
    // ) );


            // Gruppo contatti telefonici
    $martini_indirizzi_group_contact = $cmb_undercontent->add_field( array(
        'id'          => 'martini_indirizzi_group_contact',
        'type'        => 'group',
        'description' => __( 'Inserisci i contatti telefonici', 'cmb2' ),
        'repeatable'  => true, // use false if you want non-repeatable group
        'options'     => array(
            'group_title'       => __( 'Contatto {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'        => __( 'Aggiungi contatto', 'cmb2' ),
            'remove_button'     => __( 'Elimina contatto', 'cmb2' ),
        ),
    ) );

    // Id's for group's fields only need to be unique for the group. Prefix is not needed.
    $cmb_undercontent->add_group_field( $martini_indirizzi_group_contact, array(
        'name' => 'Nome contatto',
        'id'   => 'martini_indirizzi_contatto',
        'type' => 'text',
    ) );

    $cmb_undercontent->add_group_field( $martini_indirizzi_group_contact, array(
        'name' => 'Numero di telefono',
        'description' => 'inserisci qui il numero di telefono',
        'id'   => 'martini_indirizzi_numero_contatto',
        'type' => 'text',
    ) );

    // Email text field
    $cmb_undercontent->add_group_field( $martini_indirizzi_group_contact, array(
        'name' => __( 'Email', 'cmb2' ),
        'desc' => __( 'inserisci qui la email', 'cmb2' ),
        'id'   => 'martini_indirizzi_email',
        'type' => 'text_email',
    ) );



        $cmb_undercontent->add_field( array(
        'id' => $prefix . 'luoghi',
        'name'    => __( 'Selezione i <a href="edit.php?post_type=luogo">luoghi</a> in cui viene erogato', 'design_scuole_italia' ),
        'desc' => __( 'In caso l\'indirizzo di studio sia erogato in più luoghi, crea una sede per ogni luogo. ' , 'design_scuole_italia' ),
        'type'    => 'pw_multiselect',
        'options' => dsi_get_luoghi_options(),
        ) );




    // $cmb_ipa = new_cmb2_box( array(
    //     'id'           => $prefix . 'box_ipa',
    //     'title'        => __( 'Codice dell’Ente Erogatore (ipa)', 'design_scuole_italia' ),
    //     'object_types' => array( 'indirizzo' ),
    //     'context'      => 'side',
    //     'priority'     => 'low',
    // ) );

    // $cmb_ipa->add_field( array(
    //     'id' => $prefix . 'ipa',
    //     'desc' => __( 'Specificare il nome dell’organizzazione, come indicato nell’Indice della Pubblica Amministrazione (IPA), che esercita uno specifico ruolo.', 'design_scuole_italia' ),
    //     'type' => 'text'
    // ) );



}

/**
 * Aggiungo label sotto il titolo
 */
add_action( 'edit_form_after_title', 'sdi_indirizzo_add_content_after_title' );
function sdi_indirizzo_add_content_after_title($post) {
    if($post->post_type == "indirizzo")
        _e('<span><i>il <b>Titolo</b> è il <b>Nome dell\'indirizzo di studio</b> Vincoli: massimo 60 caratteri spazi inclusi</i></span><br><br>', 'design_scuole_italia' );
}


/**
 * Aggiungo testo prima del content
 */
add_action( 'edit_form_after_title', 'sdi_indirizzo_add_content_before_editor', 100 );
function sdi_indirizzo_add_content_before_editor($post) {
    if($post->post_type == "indirizzo")
        _e('<h1>Descrizione Estesa e Completa dell\'indirizzo di studio</h1>', 'design_scuole_italia' );
}

/**
 * Aggiungo testo dopo l'editor
 */
add_action( 'edit_form_after_editor', 'sdi_indirizzo_add_content_after_editor', 100 );
function sdi_indirizzo_add_content_after_editor($post) {
    if($post->post_type == "indirizzo")
        _e('<br>Se si desidera inserire un video di YouTube è necessaria l\'opzione "Enable privacy-enhanced mode" che permette di pubblicare il video in modalità youtube-nocookie.<br><br>', 'design_scuole_italia' );
}

// relazione bidirezionale struttura / indirizzo

new dsi_bidirectional_cmb2("_dsi_indirizzo_", "indirizzo", "link_struttura_didattica", "box_sottotitolo", "_dsi_struttura_link_servizi_didattici");


/**
 * aggiungo js per condizionale parent
 */
add_action( 'admin_print_scripts-post-new.php', 'dsi_indirizzo_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'dsi_indirizzo_admin_script', 11 );

function dsi_indirizzo_admin_script() {
    global $post_type;
    if( 'indirizzo' == $post_type )
        wp_enqueue_script( 'struttura-admin-script', get_stylesheet_directory_uri() . '/inc/admin-js/indirizzo.js' );
}

if(!function_exists('dsi_percorsi_di_studio_edit_meta_field')) {
    function dsi_percorsi_di_studio_edit_meta_field($term, $taxonomy) {
        if($term->parent != 0) return false;
        // get meta
        $term_meta = get_term_meta( $term->term_id, 'dsi_order', true ); ?>
        <tr class="form-field">
            <th scope="row" valign="top"><label for="ordinamento"><?php _e( 'Ordinamento', 'design_scuole_italia' ); ?></label></th>
            <td>
                <input type="number" name="ordinamento" id="term_meta[custom_term_meta]" value="<?php echo $term_meta !== false ? esc_attr( $term_meta ) : ''; ?>">
                <p class="description"><?php _e( 'Indicare la posizione facendo attenzione che non sia già occupata','design_scuole_italia' ); ?></p>
            </td>
        </tr><?php
    }
}
add_action( 'percorsi-di-studio_edit_form_fields', 'dsi_percorsi_di_studio_edit_meta_field', 10, 2 );

if(!function_exists('dsi_save_percorsi_di_studio_custom_meta')) {
    // Save extra taxonomy fields callback function.
    function dsi_save_percorsi_di_studio_custom_meta( $term_id, $tt_id ) {
        if (isset($_POST['taxonomy']) && $_POST['taxonomy'] == "percorsi-di-studio"){
            if(term_exists($term_id, "percorsi-di-studio")){
                if ( isset( $_POST['ordinamento'] ) ) {
                    update_term_meta( $tt_id, 'dsi_order', $_POST['ordinamento'] );
                } elseif($_POST['parent']<=0) {
                    global $wpdb;
                    $last_index = $wpdb->get_var( "SELECT meta_value FROM $wpdb->termmeta WHERE meta_key = 'dsi_order' order by meta_value desc limit 1;" );
                    add_term_meta( $tt_id, 'dsi_order', (int) $last_index +1 );
                }
            }
        }
    }
}
add_action( 'edited_percorsi-di-studio', 'dsi_save_percorsi_di_studio_custom_meta', 10, 2 );
add_action( 'create_percorsi-di-studio', 'dsi_save_percorsi_di_studio_custom_meta', 10, 2 );

add_action( 'save_post_indirizzo', 'dsi_update_percorsi_di_studio', 10, 3 );
if(!function_exists('dsi_update_percorsi_di_studio')) {
    function dsi_update_percorsi_di_studio( $post_id, $post, $update ) {
        global $post;
        $pattern = trim(get_shortcode_regex(array('table_from_sheets')), '"');
        
        if (   preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
        && array_key_exists( 2, $matches )
        && in_array( 'table_from_sheets', $matches[2] )
        ) {
            table_from_sheets(shortcode_parse_atts($matches[0][0]), null, true);
        }
    }
}
