<?php
/**
 * Adapt REST API fields
 */

namespace ms\PostsLoader;

defined('ABSPATH') || exit;

class Backend
{

    public function __construct()
    {
        add_action('rest_api_init', array($this, 'register_rest_images'));
    }

    /**
     * Register Featured image and its alt title for post
     *
     * @since 1.0.0
     */
    public function register_rest_images()
    {
        // Add featured image URL
        register_rest_field(array('post'),
            'feature_img_url',
            array(
                'get_callback' => array($this, 'get_rest_featured_image'),
                'update_callback' => null,
                'schema' => null,
            )
        );
        // Add featured image alt
        register_rest_field(array('post'),
            'feature_img_alt',
            array(
                'get_callback' => array($this, 'get_rest_featured_image_alt'),
                'update_callback' => null,
                'schema' => null,
            )
        );
    }

    /**
     * Callback for featured image field
     *
     * @since 1.0.0
     */
    public function get_rest_featured_image($object, $field_name, $request)
    {
        if ($object['featured_media']) {
            $img = wp_get_attachment_image_src($object['featured_media'], 'thumbnail');
            return $img[0];
        }
        return false;
    }

    /**
     * Callback for featured image alt
     *
     * @since 1.0.0
     */
    public function get_rest_featured_image_alt($object, $field_name, $request)
    {
        if ($object['featured_media']) {
            $alt = get_post_meta($object['id'], '_wp_attachment_image_alt', true);
            return $alt ? $alt : '';
        }
        return false;
    }
}
