<?php
if(!class_exists('cs_mega_custom_menu')){
    

class cs_mega_custom_menu {
    /* --------------------------------------------*
     * Constructor
     * -------------------------------------------- */

    /**
     * Initializes the plugin by setting localization, filters, and administration functions.
     */
    function __construct() {
        // load the plugin translation files
        add_action('init', array($this, 'textdomain'));
        // add custom menu fields to menu
        add_filter('wp_setup_nav_menu_item', array($this, 'cs_mega_add_custom_nav_fields'));
        // save menu custom fields
        add_action('wp_update_nav_menu_item', array($this, 'cs_mega_update_custom_nav_fields'), 10, 3);
        // edit menu walker
        //add_filter('wp_edit_nav_menu_walker', array($this, 'cs_mega_edit_walker'), 10, 2);
    }

// end constructor	
    /**
     * Load the plugin's text domain
     * @since 1.0
     * @return void
     */

    public function textdomain() {
        load_plugin_textdomain('cs_mega', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Add custom fields to $item nav object
     * in order to be used in custom Walker
     * @access      public
     * @since       1.0 
     * @return      void
     */
    function cs_mega_add_custom_nav_fields($menu_item) {
        $menu_item->megamenu = get_post_meta($menu_item->ID, '_menu_item_megamenu', true);
        $menu_item->columns = get_post_meta($menu_item->ID, '_menu_item_columns', true);
        $menu_item->subtitle = get_post_meta($menu_item->ID, '_menu_item_subtitle', true);
        $menu_item->tooltip = get_post_meta($menu_item->ID, '_menu_item_tooltip', true);
        $menu_item->bg = get_post_meta($menu_item->ID, '_menu_item_bg', true);
        return $menu_item;
    }

    /**
     * Save menu custom fields
     * @access      public
     * @since       1.0 
     * @return      void
     */
    function cs_mega_update_custom_nav_fields($menu_id, $menu_item_db_id, $args) {
        // Check if element is properly sent
        $megamenu_value = 'off';
        $columns_value = 'off';
        $subtitle_value = '';
        $tooltip_value = '';
        $bg_value = '';

        if (isset($_REQUEST['menu-item-megamenu'][$menu_item_db_id])) {
            $megamenu_value = $_REQUEST['menu-item-megamenu'][$menu_item_db_id];
        } else {
            $megamenu_value = 'off';
        }

        if (isset($_REQUEST['menu-item-columns'][$menu_item_db_id])) {
            $columns_value = $_REQUEST['menu-item-columns'][$menu_item_db_id];
        } else {
            $columns_value = 'off';
        }

        if (isset($_REQUEST['menu-item-subtitle'][$menu_item_db_id])) {
            $subtitle_value = $_REQUEST['menu-item-subtitle'][$menu_item_db_id];
        } else {
            $subtitle_value = '';
        }

        if (isset($_REQUEST['menu-item-tooltip'][$menu_item_db_id])) {
            $tooltip_value = $_REQUEST['menu-item-tooltip'][$menu_item_db_id];
        } else {
            $tooltip_value = '';
        }

        if (isset($_REQUEST['menu-item-bg'][$menu_item_db_id])) {
            $bg_value = $_REQUEST['menu-item-bg'][$menu_item_db_id];
        } else {
            $bg_value = '';
        }

        update_post_meta($menu_item_db_id, '_menu_item_megamenu', sanitize_text_field($megamenu_value));
        update_post_meta($menu_item_db_id, '_menu_item_columns', sanitize_text_field($columns_value));
        update_post_meta($menu_item_db_id, '_menu_item_subtitle', sanitize_text_field($subtitle_value));
        update_post_meta($menu_item_db_id, '_menu_item_tooltip', sanitize_text_field($tooltip_value));
        update_post_meta($menu_item_db_id, '_menu_item_bg', sanitize_text_field($bg_value));
    }

    /**
     * Define new Walker edit
     * @access      public
     * @since       1.0 
     * @return      void
     */
    function cs_mega_edit_walker($walker, $menu_id) {
        return 'Walker_Nav_Menu_Edit_Custom';
    }

}

}
    
// instantiate plugin's class
$GLOBALS['sweet_custom_menu'] = new cs_mega_custom_menu();
