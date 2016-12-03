<?php
/**
 * The template for displaying product content within loops.
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


global $product, $woocommerce_loop;

// Store loop count we're currently on
if (empty($woocommerce_loop['loop']))
    $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if (empty($woocommerce_loop['columns']))
    $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);

// Ensure visibility
if (!$product || !$product->is_visible())
    return;

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$classes = array('col-sm-6 col-md-4 col-lg-4');
if (0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'])
    $classes[] = 'first';
if (0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'])
    $classes[] = 'last';

$jobcareer_prod_attach_id = get_post_thumbnail_id(get_the_id());
$jobcareer_prod_attach_src = jobcareer_attachment_image_src($jobcareer_prod_attach_id, 350, 350);
?>

<li class="product">
    <a href="<?php esc_url(the_permalink()) ?>">
    <?php
    if ($jobcareer_prod_attach_src != '') {
        ?>
        <img src="<?php echo esc_url($jobcareer_prod_attach_src) ?>" alt="<?php esc_html(the_title()) ?>">
        <?php   woocommerce_template_loop_rating();
                                                  
    }
    ?>
  
        <?php
//        $categories_list = get_the_term_list(get_the_id(), 'product_cat', '<span class="cs-color cs-label">', ', ', '</span>');
//        if ($categories_list) {
//            printf('%1$s', $categories_list);
//        }
        ?>
        <h4><?php the_title() ?></h4>                                          
        <?php echo woocommerce_template_loop_price() ?>
		</a> 
        <?php jobcareer_loop_add_to_cart(); ?>
                  
    
</li>
