<?php

/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 */
if(!class_exists('Walker_Nav_Menu_Edit_Custom')) {
    
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {

    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     * @param string $output Passed by reference.
     */
    function start_lvl(&$output, $depth = 0, $args = array()) {
        
    }

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     * @param string $output Passed by reference.
     */
    function end_lvl(&$output, $depth = 0, $args = array()) {
        
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';
        ob_start();
        $item_id = esc_attr($item->ID);
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );
        $original_title = '';
        if ('taxonomy' == $item->type) {
            $original_title = get_term_field('name', $item->object_id, $item->object, 'raw');
            if (is_wp_error($original_title))
                $original_title = false;
        } elseif ('post_type' == $item->type) {
            $original_object = get_post($item->object_id);
            $original_title = $original_object->post_title;
        }
        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr($item->object),
            'menu-item-edit-' . ( ( isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );
        $title = $item->title;
        if (!empty($item->_invalid)) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf(esc_html__('%s (Invalid)', 'jobcareer'), $item->title);
        } elseif (isset($item->post_status) && 'draft' == $item->post_status) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf(esc_html__('%s (Pending)', 'jobcareer'), $item->title);
        }
        $title = empty($item->label) ? $title : $item->label;
        ?>
        <li id="menu-item-<?php echo intval($item_id); ?>" class="<?php echo implode(' ', $classes); ?>">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html($title); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html($item->type_label); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo wp_nonce_url(
                                add_query_arg(
                                        array(
                            'action' => 'move-up-menu-item',
                            'menu-item' => $item_id,
                                        ), remove_query_arg($removed_args, urlencode(admin_url('nav-menus.php')))
                                ), 'move-menu_item'
                        );
                        ?>" class="item-move-up"><abbr title="<?php esc_attresc_html_e('Move up', 'jobcareer'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo wp_nonce_url(
                                add_query_arg(
                                        array(
                            'action' => 'move-down-menu-item',
                            'menu-item' => $item_id,
                                        ), remove_query_arg($removed_args, urlencode(admin_url('nav-menus.php')))
                                ), 'move-menu_item'
                        );
                        ?>" class="item-move-down"><abbr title="<?php esc_attresc_html_e('Move down', 'jobcareer'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo intval($item_id); ?>" title="<?php esc_attresc_html_e('Edit Menu Item', 'jobcareer'); ?>" href="<?php
            echo ( isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item'] ) ? admin_url('nav-menus.php') : add_query_arg('edit-menu-item', $item_id, remove_query_arg($removed_args, admin_url('nav-menus.php#menu-item-settings-' . $item_id)));
            ?>"><?php esc_html_e('Edit Menu Item', 'jobcareer'); ?></a>
                </span>
                </dt>
            </dl>	
            <div class="menu-item-settings" id="menu-item-settings-<?php echo intval($item_id); ?>">
                        <?php if ('custom' == $item->type) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo intval($item_id); ?>">
                    <?php esc_html_e('url', 'jobcareer'); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->url); ?>" />
                        </label>
                    </p>
                        <?php endif; ?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo intval($item_id); ?>">
        <?php esc_html_e('Navigation Label', 'jobcareer'); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo intval($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->title); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo intval($item_id); ?>">
        <?php esc_html_e('Title Attribute', 'jobcareer'); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo intval($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->post_excerpt); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo intval($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo intval($item_id); ?>" value="_blank" name="menu-item-target[<?php echo intval($item_id); ?>]"<?php checked($item->target, '_blank'); ?> />
        <?php esc_html_e('Open link in a new window/tab', 'jobcareer'); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo intval($item_id); ?>">
        <?php esc_html_e('CSS Classes (optional)', 'jobcareer'); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr(implode(' ', $item->classes)); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo intval($item_id); ?>">
        <?php esc_html_e('Link Relationship (XFN)', 'jobcareer'); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->xfn); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo intval($item_id); ?>">
                            <?php esc_html_e('Description', 'jobcareer'); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo intval($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo intval($item_id); ?>]"><?php echo esc_html($item->description); // textarea_escaped  ?></textarea>
                        <span class="description">
                <?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'jobcareer'); ?>
                        </span>
                    </label>
                </p>        
        <?php
        /* New fields insertion starts here */
        ?>      
                <p class="field-custom description description-wide custom_onof">
                    <label class="pbwp-checkbox" for="edit-menu-item-megamenu-<?php echo intval($item_id); ?>">
        <?php esc_html_e('Active Mega Menu', 'jobcareer'); ?><br />
                        <input type="hidden" value="off" name="cs_title_switch">
                        <input type="checkbox" id="edit-menu-item-megamenu-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-custom" name="menu-item-megamenu[<?php echo intval($item_id); ?>]" <?php if (esc_attr($item->megamenu) == 'on') {
            echo 'checked="checked"';
        } ?>  />
                        <span class="pbwp-box"></span>
                    </label> 
                </p>
                <p class="field-custom description description-wide">
                    <label class="pbwp-checkbox" for="edit-menu-item-columns-<?php echo intval($item_id); ?>">
        <?php esc_html_e('No. of Columns', 'jobcareer'); ?><br />
                        <select id="edit-menu-item-columns-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-custom" name="menu-item-columns[<?php echo intval($item_id); ?>]">
                            <option <?php if ($item->columns == 'one-columns') echo 'selected=selected'; ?> value="one-columns"><?php esc_html_e('1 Columns', 'jobcareer') ?></option>
                            <option <?php if ($item->columns == 'two-columns') echo 'selected=selected'; ?> value="two-columns"><?php esc_html_e('2 Columns', 'jobcareer') ?></option>
                            <option <?php if ($item->columns == 'three-columns') echo 'selected=selected'; ?> value="three-columns"><?php esc_html_e('3 Columns', 'jobcareer') ?></option>
                            <option <?php if ($item->columns == 'four-columns') echo 'selected=selected'; ?> value="four-columns"><?php esc_html_e('4 Columns', 'jobcareer') ?></option>
                        </select>
                    </label>
                </p>
                <p class="field-custom description description-wide">
                    <label class="pbwp-checkbox" for="edit-menu-item-subtitle-<?php echo intval($item_id); ?>">
                        <?php esc_html_e('Sub Title', 'jobcareer'); ?><br />
                        <input type="text" id="edit-menu-item-subtitle-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-custom" name="menu-item-subtitle[<?php echo intval($item_id); ?>]" value="<?php echo esc_html($item->subtitle) ?>" />
                    </label> 

                    <label class="pbwp-checkbox" for="edit-menu-item-tooltip-<?php echo intval($item_id); ?>">
                        <?php esc_html_e('Tooltip', 'jobcareer'); ?><br />
                        <input type="text" id="edit-menu-item-tooltip-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-custom" name="menu-item-tooltip[<?php echo intval($item_id); ?>]" value="<?php echo esc_html($item->tooltip) ?>" />
                    </label>

                    <label class="pbwp-checkbox" for="edit-menu-item-bg-<?php echo intval($item_id); ?>">
                <?php esc_html_e('Background Image', 'jobcareer'); ?><br />
                        <input type="text" id="edit-menu-item-bg-<?php echo intval($item_id); ?>" class="widefat code edit-menu-item-custom" name="menu-item-bg[<?php echo intval($item_id); ?>]" value="<?php echo esc_html($item->bg) ?>" />
                        <input type="button" name="edit-menu-item-bg-<?php echo intval($item_id); ?>" class="uploadfile left" value="<?php esc_html_e('Browse', 'jobcareer'); ?>"/>
                    </label> 
                </p>             
                        <?php
                        /* New fields insertion ends here */
                        ?>
                <div class="menu-item-actions description-wide submitbox">
                    <?php if ('custom' != $item->type && $original_title !== false) : ?>
                        <p class="link-to-original">
                        <?php printf(esc_html__('Original: %s', 'jobcareer'), '<a href="' . esc_url($item->url) . '">' . esc_html($original_title) . '</a>'); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo intval($item_id); ?>" href="<?php
                    echo wp_nonce_url(
                            esc_url(
                                    add_query_arg(
                                            array(
                        'action' => 'delete-menu-item',
                        'menu-item' => $item_id,
                                            ), remove_query_arg($removed_args, urlencode(admin_url('nav-menus.php')))
                                    ), 'delete-menu_item_' . $item_id
                    ));
                    ?>"><?php esc_html_e('Remove', 'jobcareer'); ?></a> <span class="meta-sep"> | </span> <a class="item-cancel submitcancel" id="cancel-<?php echo intval($item_id); ?>" href="<?php echo esc_url(add_query_arg(array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg($removed_args, urlencode(admin_url('nav-menus.php'))))); ?>#menu-item-settings-<?php echo intval($item_id); ?>"><?php esc_html_e('Cancel', 'jobcareer'); ?></a>
                </div>
                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo intval($item_id); ?>]" value="<?php echo intval($item_id); ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->object_id); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->object); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->menu_item_parent); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->menu_order); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo intval($item_id); ?>]" value="<?php echo esc_attr($item->type); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
            <?php
            $output .= ob_get_clean();
        }

    }
    
}