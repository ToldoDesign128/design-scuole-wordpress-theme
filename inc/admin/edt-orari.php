<?php
define('ORARI_MENU_SLUG', 'orari-settings');
define('ORARI_OPTION_GROUP', 'orari_option_group');
define('ORARI_PAGE_SLUG', 'orari_page_slug');
define('ORARI_SECTION_ID', 'orari_section_id');
define('ORARI_POST_TYPE', 'orario');
define('ORARI_TAXONOMY', 'orari');

// flush_rewrite_rules();

// Register custom post type 'orari'
function orari_post_type()
{
    $labels = array(
        'name'               => 'Orari',
        'singular_name'      => 'Orario',
        'menu_name'          => 'Orari',
        'name_admin_bar'     => 'Orario',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Orario',
        'new_item'           => 'New Orario',
        'edit_item'          => 'Edit Orario',
        'view_item'          => 'View Orario',
        'all_items'          => 'All Orari',
        'search_items'       => 'Search Orari',
        'parent_item_colon'  => 'Parent Orari:',
        'not_found'          => 'No Orari found.',
        'not_found_in_trash' => 'No Orari found in Trash.',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => !true,
        'publicly_queryable' => !true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => ORARI_TAXONOMY.'/'.ORARI_POST_TYPE),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-clock',
        // 'menu_position'      => null,
        'menu_position'      => 1,
        'supports'           => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'excerpt',
            'comments'
        ),
    );
    register_post_type(ORARI_POST_TYPE, $args);
}
add_action('init', 'orari_post_type');

// Register custom categories for 'orari'
function orari_taxonomies()
{
    $labels = array(
        'name'              => 'Orari Categories',
        'singular_name'     => 'Orari Category',
        'search_items'      => 'Search Orari Categories',
        'all_items'         => 'All Orari Categories',
        'parent_item'       => 'Parent Orari Category',
        'parent_item_colon' => 'Parent Orari Category:',
        'edit_item'         => 'Edit Orari Category',
        'update_item'       => 'Update Orari Category',
        'add_new_item'      => 'Add New Orari Category',
        'new_item_name'     => 'New Orari Category Name',
        'menu_name'         => 'Orari Categories',
    );
    $args = array(
        'hierarchical'      => !true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'public'            => true,
        'show_tagcloud'     => true,
        'rewrite'           => array('slug' => ORARI_TAXONOMY),
    );
    register_taxonomy(ORARI_TAXONOMY, array(ORARI_POST_TYPE), $args);
    register_term_meta(ORARI_TAXONOMY, 'source_url', array(
        'type' => 'string',
        'description' => 'a nice description',
        'single' => true,
        'show_in_rest' => array(
            'schema' => array(
                'type' => 'string',
                'format' => 'url',
                'context' => array( 'view', 'edit' ),
                'readonly' => true,
            )
        ),
    ));
}
add_action('init', 'orari_taxonomies', 0);

// Add custom field "source URL" to orari taxonomy
function orari_taxonomy_custom_fields_edit($tag)
{
    $t_id = $tag->term_id;
    $term_meta = get_option("taxonomy_term_$t_id");
?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="term_meta[source_url]"><?php _e('Source URL'); ?></label>
        </th>
        <td>
            <input type="text" name="term_meta[source_url]" id="term_meta[source_url]" value="<?php echo isset($term_meta['source_url']) ? esc_attr($term_meta['source_url']) : ''; ?>">
            <p class="description"><?php _e('Enter the source URL for this category'); ?></p>
        </td>
    </tr>
<?php
}
add_action(ORARI_TAXONOMY . "_edit_form_fields", 'orari_taxonomy_custom_fields_edit', 10, 1);

// Add custom field "source URL" to orari taxonomy
function orari_taxonomy_custom_fields_add($tag)
{
?>

    <div class="form-field">
        <label for="term_meta[source_url]"><?php _e('Source URL'); ?></label>

        <input type="text" name="term_meta[source_url]" id="term_meta[source_url]" value="">
        <p class="description"><?php _e('Enter the source URL for this category'); ?></p>
    </div>
<?php
}
add_action(ORARI_TAXONOMY . "_add_form_fields", 'orari_taxonomy_custom_fields_add', 10, 1);

// Save custom field "source URL" value
function save_orari_taxonomy_custom_fields($term_id)
{
    // console_log('save');
    if (isset($_POST['term_meta'])) {

        $tax_term_id = 'taxonomy_term_' . $term_id;
        $term_meta = get_option($tax_term_id);
        $cat_keys = array_keys($_POST['term_meta']);

        foreach ($cat_keys as $key) {
            if (isset($_POST['term_meta'][$key])) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        update_option($tax_term_id, $term_meta);
    }
}
add_action("edited_" . ORARI_TAXONOMY, 'save_orari_taxonomy_custom_fields', 10, 2);
add_action("created_" . ORARI_TAXONOMY, 'save_orari_taxonomy_custom_fields', 10, 2);


// Remove the 'Orari Add new' submenu page
function remove_orari_add_submenu()
{
    remove_submenu_page("edit.php?post_type=" . ORARI_POST_TYPE, "post-new.php?post_type=" . ORARI_POST_TYPE);
    remove_submenu_page("edit-tags.php?post_type=" . ORARI_POST_TYPE, "edit-tags.php?taxonomy=" . ORARI_TAXONOMY . "&post_type=" . ORARI_POST_TYPE);
}
add_action('admin_menu', 'remove_orari_add_submenu', 11);

// Register a new meta box for the orari custom post type
add_action('add_meta_boxes', 'orari_add_img_url_meta_box');
function orari_add_img_url_meta_box()
{
    add_meta_box('orari-img-url', 'Image URL', 'orari_img_url_meta_box_callback', ORARI_POST_TYPE);
}

// Callback function for the orari_img_url meta box
function orari_img_url_meta_box_callback($post)
{
    // Get the current value of the orari_img_url custom field
    $orari_img_url = get_post_meta($post->ID, 'orari_img_url', true);
?>
    <p>
        <label for="orari_img_url">Image URL:</label>
        <input type="text" id="orari_img_url" name="orari_img_url" value="<?php echo esc_url($orari_img_url); ?>" style="width: 100%;" />
    </p>
<?php
}

// Save the orari_img_url custom field when the orari post is saved
add_action('save_post', 'orari_save_img_url_meta_box_data', 10, 2);
function orari_save_img_url_meta_box_data($post_id, $post)
{
    // Check if the orari_img_url custom field is set and not empty
    if (isset($_POST['orari_img_url']) && !empty($_POST['orari_img_url'])) {
        // Update or add the orari_img_url custom field
        update_post_meta($post_id, 'orari_img_url', esc_url_raw($_POST['orari_img_url']));
    } else {
        // Delete the orari_img_url custom field if it's empty
        delete_post_meta($post_id, 'orari_img_url');
    }
}

function orari_settings_page()
{
    // Output HTML for the Orari tab settings page
?>
    <div class="wrap">
        <h1>Orari Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields(ORARI_PAGE_SLUG);
            do_settings_sections(ORARI_PAGE_SLUG);
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register submenu for custom categories of 'orari'
function orari_submenu()
{
    add_submenu_page(
        /* parent_slug */
        "edit.php?post_type=" . ORARI_POST_TYPE,
        /* page_title  */
        'Orari Settings',
        /* menu_title  */
        'Orari Settings',
        /* capability  */
        'manage_options',
        /* menu_slug   */
        ORARI_MENU_SLUG,
        /* callback    */
        'orari_settings_page',
        /* position    */
        0
    );

    $categories = get_terms(ORARI_TAXONOMY);
    if (!empty($categories)) {
        foreach ($categories as $category) {
            add_submenu_page(
                /* parent_slug */
                "edit.php?post_type=" . ORARI_POST_TYPE,
                /* page_title  */
                $category->name,
                /* menu_title  */
                $category->name,
                /* capability  */
                'manage_options',
                /* menu_slug   */
                "edit.php?post_type=" . ORARI_POST_TYPE . "&" . ORARI_TAXONOMY . "=" . $category->slug
                /* callback    */
                /* position    */
            );
        }
    }
}
add_action('admin_menu', 'orari_submenu');

// Register settings and fields for the Orari tab
add_action('admin_init', 'orari_settings');
function orari_settings()
{
    register_setting(ORARI_PAGE_SLUG, ORARI_OPTION_GROUP);

    add_settings_section(ORARI_SECTION_ID, '', 'orari_section_callback', ORARI_PAGE_SLUG);

    add_settings_field('orari_source_url', 'Source URL', 'orari_source_url_callback', ORARI_PAGE_SLUG, ORARI_SECTION_ID);
    add_settings_field('orari_update_interval', 'Update Interval', 'orari_update_interval_callback', ORARI_PAGE_SLUG, ORARI_SECTION_ID);
    // add_settings_field('orari_upload_url', 'Upload to URL', 'orari_upload_url_callback', ORARI_PAGE_SLUG, ORARI_SECTION_ID);
    add_settings_field('orari_webhook_uuid', 'webhook uuid', 'orari_webhook_url_callback', ORARI_PAGE_SLUG, ORARI_SECTION_ID);
}
add_action('update_option_' . ORARI_OPTION_GROUP, 'orari_cron_job', 10, 3);

// Schedule the Cron job to run based on the specified update interval
function orari_cron_job() {
	if ( ! wp_next_scheduled( 'orari_job' ) ) {
        $update_interval = get_orari_option('orari_update_interval');
		wp_schedule_event( time(), $update_interval, 'orari_job' );
	}
}


function get_orari_option($option, $default = false)
{
    $orari_settings = get_option(ORARI_OPTION_GROUP, $default);
    if (isset($orari_settings[$option]) || !empty($orari_settings[$option])) {
        return $orari_settings[$option];
    }
    return $default;
}

function orari_section_callback()
{
    // Output any necessary instructions or information for the Orari tab settings
    echo 'Enter the information below to set up the Orari tab:';
}

function orari_source_url_callback()
{
    $source_url = esc_attr(get_orari_option('orari_source_url'));

    printf(
        '<input type="text" name="%s" id="%s" value="%s" placeholder="https://example.com/data.json" />',
        ORARI_OPTION_GROUP . '[orari_source_url]',
        'orari_source_url',
        $source_url
    );
}

function orari_update_interval_callback() {
    $schedules = wp_get_schedules();
    $current = get_orari_option('orari_update_interval');
    uasort( $schedules, function( array $a, array $b ) {
        return ( $a['interval'] - $b['interval'] );
    } );
    array_walk( $schedules, function( array &$schedule, $name ) {
        $schedule['name'] = $name;
        $schedule['is_too_frequent'] = ( $schedule['interval'] < WP_CRON_LOCK_TIMEOUT );
    } );
    ?>
    <select class="postform" name="<?php echo ORARI_OPTION_GROUP . '[orari_update_interval]';?>" id="orari_update_interval" required>
        <option <?php selected( $current, '_oneoff' ); ?> value="_oneoff"><?php esc_html_e( 'Non-repeating', 'wp-crontrol' ); ?></option>
        <?php foreach ( $schedules as $sched_name => $sched_data ) { ?>
            <option <?php selected( $current, $sched_name ); ?> value="<?php echo esc_attr( $sched_name ); ?>">
            <?php
                printf(
                    '%s (%s)',
                    esc_html( isset( $sched_data['display'] ) ? $sched_data['display'] : $sched_data['name'] ),
                    esc_html( $sched_name )
                );
            ?>
            </option>
        <?php } ?>
    </select>
    <?php
}

function orari_upload_url_callback($args)
{
    $upload_url = esc_attr(get_orari_option('orari_upload_url'));

    printf(
        '<input type="text" name="%s" id="%s" value="%s" placeholder="https://example.com/upload" />',
        ORARI_OPTION_GROUP . '[orari_upload_url]',
        'orari_upload_url',
        $upload_url
    );
}

function orari_webhook_url_callback()
{
    $orari_webhook_uuid = esc_attr(get_orari_option('orari_webhook_uuid'));

    printf(
        '<input type="text" name="%s" id="%s" value="%s" placeholder="[SECRET TOKEN]" />',
        ORARI_OPTION_GROUP . '[orari_webhook_uuid]',
        'orari_webhook_uuid',
        $orari_webhook_uuid
    );
    $webhook_url = get_site_url() . '/?orari_webhook=' . $orari_webhook_uuid;
    printf(
        '<p>%s<a href="%s">%s</a></p>',
        '',
        $webhook_url,
        $webhook_url
    );
}

add_action('admin_notices', 'orari_notice');
function orari_notice()
{
    $settings_errors = get_settings_errors(ORARI_PAGE_SLUG . '_settings_errors');
    // if we have any errors, exit
    if (!empty($settings_errors)) {
        return;
    }
    if (
        isset($_GET['page'])
        && ORARI_MENU_SLUG == $_GET['page']
        && isset($_GET['settings-updated'])
        && true == $_GET['settings-updated']
    ) {
    ?>
        <div class="notice notice-success is-dismissible">
            <p>
                <strong>Orari settings saved.</strong>
            </p>
        </div>
<?php
    }
}

// Generate and store UUID for the webhook
function orari_generate_webhook_uuid()
{
    $orari_settings = get_option(ORARI_OPTION_GROUP);
    if (!isset($orari_settings['orari_webhook_uuid']) || empty($orari_settings['orari_webhook_uuid'])) {
        $orari_settings['orari_webhook_uuid'] = wp_generate_uuid4();
        update_option(ORARI_OPTION_GROUP, $orari_settings);
    }
}
add_action('init', 'orari_generate_webhook_uuid');

// Webhook URL to trigger orari_job
function orari_webhook_callback()
{
    $orari_webhook_uuid = get_orari_option('orari_webhook_uuid');
    if (isset($_GET['orari_webhook'])){
        if ($_GET['orari_webhook'] == $orari_webhook_uuid) {
            orari_job();
            exit;
        }
        wp_die(__('You do not have permission to access this page.'), 403);
    }
}
add_action('init', 'orari_webhook_callback');






function orari_download_and_parse_file($url, $regexp)
{
    // $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
    // $file_contents = file_get_contents($url, false, $context);
    // console_log($url);

    // $response = wp_remote_get($url);
    // $file_contents = wp_remote_retrieve_body($response);
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $file_contents = curl_exec($ch);
    curl_close($ch);

    $lines = explode("\n", $file_contents);
    $matches = array();
    console_log($file_contents);
    foreach ($lines as $line) {
        preg_match($regexp, $line, $line_matches);
        if (!empty($line_matches)) {
            $matches[] = array_slice($line_matches, 1);
            // $matches[] = $line_matches;
        }
    }
    // console_log($matches);
    return $matches;
}

function orari_parse_edt_resources($file)
{
    // https://regex101.com/r/0npKOq/2
    // /(?:(?<=new Ressource)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)"(?=\);))/gm
    // Group 1 = group
    // Group 2 = name
    // Group 3 = code
    echo orari_download_and_parse_file($file, '/(?:(?<=new\s+Ressource)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)"(?=\);))/');
}

function orari_get_source_urls()
{
    $source_urls = array();
    $terms = get_terms(array(
        'taxonomy' => ORARI_TAXONOMY,
        'hide_empty' => false,
    ));
    // var_dump($terms);
    // console_log($terms);

    // $t_id = $tag->term_id;
    // $term_meta = get_option("taxonomy_term_$t_id");

    foreach ($terms as $term) {
        $source_url = get_option("taxonomy_term_" . $term->term_id)['source_url'];
        // $source_url = get_term_meta($term->term_id, 'orari_source_url', true);
        console_log($source_url);
        // console_log(get_option("taxonomy_term_".$term->term_id));

        if (!empty($source_url)) {
            $source_urls[$term->term_id] = $source_url;
        }
    }
    // console_log($term);
    // console_log($source_urls);
    // exit;
    return $source_urls;
}

function orari_check_source_urls($source_urls)
{
    $valid_urls = array();
    foreach ($source_urls as $term_id => $source_url) {
        if (filter_var($source_url, FILTER_VALIDATE_URL) !== false) {
            $valid_urls[$term_id] = $source_url;
        } else {
            error_log(sprintf('Invalid URL: %s', $source_url));
        }
    }
    return $valid_urls;
}

// check if there is a post of type 'orari' with title X, if not - create new, else update existing. add 'orari_img_url' to the post
function update_orari_post($title, $orari_img_url, $tag_id /* $category_name */)
{
    $orari_post = get_page_by_title($title, OBJECT, ORARI_POST_TYPE);
    if (!$orari_post) {
        // create new post
        $new_post = array(
            'post_title'    => $title,
            'post_status'   => 'publish',
            'post_type'     => ORARI_POST_TYPE,
            'tax_input' => array($tag_id)
        );
        $post_id = wp_insert_post($new_post);
    } else {
        $post_id = $orari_post->ID;
    }
    console_log($tag_id);
    // add 'orari_img_url' to the post
    update_post_meta($post_id, 'orari_img_url', $orari_img_url);

    $status = wp_set_object_terms($post_id, $tag_id, ORARI_TAXONOMY);

    $size = getimagesize($orari_img_url);
    console_log($size);
    update_post_meta($post_id, 'orari_img_size', $size[3]);

    // set category
    // $category_id = get_cat_ID($category_name);
    // if (!$category_id) {
    //     $category_id = wp_create_category($category_name);
    // }
    // wp_set_post_categories($post_id, array($category_id));
    // set tag
    // wp_set_post_tags($post_id, array($tag_id), true);
}

// function orari_(Type $var = null)
// {
//     # code...
// }

// Function to create the job
function orari_job()
{
    $config = array(
        // https://regex101.com/r/0npKOq/2
        // /(?:(?<=new Ressource)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)"(?=\);))/gm
        // Group 1 = group
        // Group 2 = [name]
        // Group 3 = {code}
        '/_ressource.js' => '/(?:(?<=new Ressource)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)"(?=\);))/',

        // https://regex101.com/r/gGSekx/1
        // /(?:(?<=new Periode)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)"\s*(?=\);))/gm
        // Group 1 = {code}
        // Group 2 = period
        // Group 3 = (id)       
        '/_periode.js' => '/(?:(?<=new Periode)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)"\s*(?=\);))/',

        // https://regex101.com/r/f94EIr/1
        // /(?:(?<=new Grille)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)",\s*([a-zA-Z0-9_]+)(?=\);))/gm
        // Group 1 = (id)         
        // Group 2 = group
        // Group 3 = [image]
        '/_grille.js' => '/(?:(?<=new Grille)\s*\()(?:"([^"]+)",\s*"([^"]+)",\s*"([^"]+)",\s*([a-zA-Z0-9_]+)(?=\);))/',
    );
    // phpinfo();
    // exit;
    $source_base_url = get_orari_option('orari_source_url');
    // print('fvfv');
    print($source_base_url);
    $taxonomies_urls = orari_get_source_urls();
    // var_dump($taxonomies_urls);
    // exit;
    foreach ($taxonomies_urls as $term_id => $tax_url) {
        $url = (filter_var($tax_url, FILTER_VALIDATE_URL) !== false)
            ? $tax_url
            : $source_base_url . $tax_url;

        $parsed = array();
        foreach ($config as $file => $pattern) {
            console_log($url . $file);
            console_log($pattern);
            $parsed[$file] = orari_download_and_parse_file($url . $file, $pattern);
            // console_log($parsed[$file]);
        }
        console_log($parsed);

        $period_col_code = array_column($parsed['/_periode.js'], 0);
        $gate_col_id = array_column($parsed['/_grille.js'], 0);

        $res = array();
        while ($resource = array_pop($parsed['/_ressource.js'])) {
            console_log($resource);
            if ($resource[2] == 'vide') {
                console_log('$resource continue ');
                continue;
            }

            $period_key = array_search($resource[2], $period_col_code);
            if ($period_key === false) {
                console_log($resource);
                console_log('$period_key === false');
                continue;
            }
            $period = $parsed['/_periode.js'][$period_key];

            $gate_key = array_search($period[2], $gate_col_id);
            if ($gate_key === false) {
                console_log($resource);
                console_log('$gate_key === false');
                continue;
            }
            $gate = $parsed['/_grille.js'][$gate_key];
            
            // echo '<br>';
            // var_dump($resource);
            // echo '<br>';
            // var_dump($period);
            // echo '<br>';
            // var_dump($gate);
            // echo '<br>';

            if (!empty($period) && !empty($gate)) {
                if ($gate[1] == $resource[0] && $gate[0] == $period[2]) {
                    console_log('[OK] $gate[1] == $resource[0] && $gate[0] == $period[2]');

                    $item = array(
                        'title'   => $resource[1],
                        'img_url' => $url . '/' . $gate[2],
                        'period'  => $period[1],
                    );
                    $res[] = $item;
                    update_orari_post($resource[1], $url . '/' . $gate[2], $term_id);
                } else {
                    console_log('[FAILED] $gate[1] == $resource[0] && $gate[0] == $period[2]');
                }
                // console_log($period);
                // console_log($gate);
            }
        }
        console_log($res);
    }
}
add_action('orari_job', 'orari_job');
