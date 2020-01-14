<?php
/**
 * Adapt REST API fields
 */

namespace ms\PostsLoader;

defined('ABSPATH') || exit;

class Frontend
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
    }

    // Register scripts and styles
    public function register_scripts()
    {
        wp_register_script('posts-loader', PLUGIN_DIR . 'app/dist/bundle.js', array(), PLUGIN_VERSION);
    }

    /**
     * Insert scripts and styles, pass data to JS
     *
     * @since 1.0.0
     */
    public function init_component($atts, $component_id)
    {

        // Default values
        $atts = shortcode_atts(array(
            'url' => null,
            'visible_posts' => 4,
            'scroll_by' => 4,
        ), $atts);

        if (empty($atts['url'])) {
            echo 'Posts loader need a valid URL in order to fetch posts!';
        }

        wp_enqueue_script('posts-loader');
        wp_localize_script('posts-loader', 'postsloader_' . $component_id,
            array(
                'url' => $atts['url'],
                'visible_posts' => $atts['visible_posts'],
                'scroll_by' => $atts['scroll_by'],
            )
        );

    }

    /**
     * Show component
     */
    public function showComponent($atts)
    {
        $component_id = uniqid();
        $this->init_component($atts, $component_id);
        ob_start();
        ?>

		<div class="postsloader postsloader--<?php echo $component_id; ?>" data-id="<?php echo $component_id; ?>"></div>

		<?php return ob_get_clean();
    }
}