<?php

/**
 * Definisce post type per Corsi liberi
 */

add_action( 'init', 'register_corsi_liberi_post_type' );
function register_corsi_liberi_post_type() {

	/** Corsi liberi **/
	$labels = array(
		'name'          => _x( 'Corsi liberi', 'Post Type General Name', 'martino_martini' ),
		'singular_name' => _x( 'Corsi liberi', 'Post Type Singular Name', 'martino_martini' ),
		'add_new'       => _x( 'Aggiungi un File', 'Post Type Singular Name', 'martino_martini' ),
		'add_new_item'  => _x( 'Aggiungi un File', 'Post Type Singular Name', 'martino_martini' ),
		'edit_item'      => _x( 'Modifica il File', 'Post Type Singular Name', 'martino_martini' ),
		'view_item'      => _x( 'Visualizza il File', 'Post Type Singular Name', 'martino_martini' ),
	);
	$args   = array(
		'label'         => __( 'Corsi liberi', 'martino_martini' ),
		'labels'        => $labels,
		'supports'      => array( 'title' ),
		'hierarchical'  => true,
		'public'        => true,
		'menu_position' => 10,
		'menu_icon'     => 'dashicons-book',
		'has_archive'   => true,
        'map_meta_cap'    => true,
	);
	register_post_type( 'corsi-liberi', $args );

}


// registro un nuovo field

add_action( 'cmb2_init', 'martini_add_informatica_metaboxes' );
function martini_add_informatica_metaboxes() {

    $prefix = '_martini_corsi_liberi_';
    
    $cmb_aftercontent = new_cmb2_box( array(
    'id'           => $prefix . 'box_elementi_dati',
    'title'        => __( 'Corsi liberi', 'martino_martini' ),
    'object_types' => array( 'corsi-liberi' ),
    'context'      => 'normal',
    'priority'     => 'high',
    ) );

    $cmb_aftercontent->add_field( array(
        'name'             => 'Tipologia di corso',
        'id'               => $prefix . 'wiki_test_radio', // da modificare e aggiungere il prefix
        'type'             => 'radio',
        'show_option_none' => false,
        'options'          => array(
            'informatica' => __( 'Informatica', 'cmb2' ),
            'inglese'   => __( 'Inglese', 'cmb2' ),
            'italiano'   => __( 'Italiano', 'cmb2' ),
            'tedesco'   => __( 'Tedesco', 'cmb2' ),
        ),
    ) );

    // box per caricare file del corso informatica sulle scuole

    $cmb_aftercontent->add_field( array(
        'id' => $prefix . 'file_informatica',
        'name'    => __( 'Carica file', 'martino_martini' ),
        'desc' => __( 'Archivio file del corso informatica della scuola' , 'martino_martini' ),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => __('Aggiungi un nuovo allegato', 'martino_martini' ), // default: "Add or Upload Files"
            'remove_image_text' => __('Rimuovi allegato', 'martino_martini' ), // default: "Remove Image"
            'remove_text' => __('Rimuovi', 'martino_martini' ), // default: "Remove"
        ),
        'attributes' => array(
            'data-validation' => 'required',
        ),
    ) );
}