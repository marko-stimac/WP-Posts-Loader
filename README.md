# WP Post Loader

WordPress plugin based on React which uses REST API to load posts dinamically with simple prev/next pagination. You can use shortcode as many times as you wish on the same page with different values. Each item shows a featured image (thumbnail size) and a title with a link.

## How to use 

Use shortcode with URL parameter like this

	[posts-loader url="https://website.com/wp-test/wp-json/wp/v2/posts?_embed&per_page=15"]

You can also pass additional parameters in order to override default values

	// Visible items per each slide
	visible_posts="3"
	// Scroll slide by how many items
	scroll_by="3"

## Additional customization

There are no settings in WordPress in order to keep it clean. If you want to have more control over data and optimize payload, uncomment the class for backend in the main file and adjust other things accordingly. 