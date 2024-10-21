<?php

/**
 * Definisce post type per PN2127
 */

add_action('init', 'register_pn2127_post_type');
function register_pn2127_post_type()
{

    /** pn2127 **/
    $labels = array(
        'name'          => _x('PN2127', 'Post Type General Name', 'martino_martini'),
        'singular_name' => _x('PN2127', 'Post Type Singular Name', 'martino_martini'),
        'add_new'       => _x('Aggiungi un File', 'Post Type Singular Name', 'martino_martini'),
        'add_new_item'  => _x('Aggiungi un File', 'Post Type Singular Name', 'martino_martini'),
        'edit_item'      => _x('Modifica il File', 'Post Type Singular Name', 'martino_martini'),
        'view_item'      => _x('Visualizza il File', 'Post Type Singular Name', 'martino_martini'),
    );
    $args   = array(
        'label'         => __('PN2127', 'martino_martini'),
        'labels'        => $labels,
        'supports'      => array('title'),
        'hierarchical'  => true,
        'public'        => true,
        'menu_position' => 28,
        'menu_icon'     => 'dashicons-admin-site-alt',
        'has_archive'   => true,
        'map_meta_cap'    => true,
    );
    register_post_type('pn2127', $args);
}

// registro un nuovo field
add_action('cmb2_init', 'martini_add_pn2127_metaboxes');
function martini_add_pn2127_metaboxes()
{

    $prefix = '_martini_pn2127_';

    $cmb_aftercontent = new_cmb2_box(array(
        'id'           => $prefix . 'box_elementi_dati',
        'title'        => __('pn2127', 'martino_martini'),
        'object_types' => array('pn2127'),
        'context'      => 'normal',
        'priority'     => 'high',
    ));

    $cmb_aftercontent->add_field(array(
        'name'             => 'Tipologia di documento',
        'id'               => $prefix . 'wiki_test_radio', // da modificare e aggiungere il prefix
        'type'             => 'radio',
        'show_option_none' => false,
        'options'          => array(
            'apprendimento' => __('Percorsi educativi e formativi per il potenziamento delle competenze', 'cmb2'),
        ),
    ));

    // box per caricare file del documento pn2127 sulle scuole

    $cmb_aftercontent->add_field(array(
        'id' => $prefix . 'file_pn2127',
        'name'    => __('Carica file', 'martino_martini'),
        'desc' => __('Archivio file del documento pn2127 della scuola', 'martino_martini'),
        'type' => 'file_list',
        // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // 'query_args' => array( 'type' => 'image' ), // Only images attachment
        // Optional, override default text strings
        'text' => array(
            'add_upload_files_text' => __('Aggiungi un nuovo allegato', 'martino_martini'), // default: "Add or Upload Files"
            'remove_image_text' => __('Rimuovi allegato', 'martino_martini'), // default: "Remove Image"
            'remove_text' => __('Rimuovi', 'martino_martini'), // default: "Remove"
        ),
        'attributes' => array(
            'data-validation' => 'required',
        ),
    ));
}
