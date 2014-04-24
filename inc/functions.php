<?php # -*- coding: utf-8 -*-

/**
 * Wrapper for Mlp_Helpers:is_redirect, which returns
 * a blog's redirect setting
 *
 * @since	0.5.2a
 * @param	bool $blogid
 * @return	bool TRUE/FALSE
 */
function mlp_is_redirect( $blogid = FALSE ) {
	return Mlp_Helpers::is_redirect( $blogid );
}

/**
 * wrapper of Mlp_Helpers:get_current_blog_language
 * return current blog's language code ( not the locale used by WordPress,
 * but the one set by MlP)
 *
 * @since	0.1
 * @param   bool $short
 * @return	array Available languages
 */
function mlp_get_current_blog_language( $short = FALSE ) {
	return Mlp_Helpers::get_current_blog_language( $short );
}

/**
 * wrapper of Mlp_Helpers:get_available_languages
 * load the available languages
 *
 * @since	0.1
 * @param  bool $nonrelated
 * @return	array Available languages
 */
function mlp_get_available_languages( $nonrelated = FALSE ) {
	return Mlp_Helpers::get_available_languages( $nonrelated );
}

/**
 * wrapper of Mlp_Helpers:: get_available_language_title
 * load the available language titles
 *
 * @since	0.5.3b
 * @param  bool $nonrelated
 * @return	array Available languages
 */
function mlp_get_available_languages_titles( $nonrelated = FALSE ) {
	return Mlp_Helpers::get_available_languages_titles( $nonrelated );
}

/**
 * wrapper of Mlp_Helpers function to get the element ID in other blogs for the selected element
 *
 * @since	0.1
 * @param	int $element_id ID of the selected element
 * @param	string $type type of the selected element
 * @param	int $blog_id ID of the selected blog
 * @return	array linked elements
 */
function mlp_get_linked_elements( $element_id = 0, $type = '', $blog_id = 0 ) {
	return Mlp_Helpers::load_linked_elements( $element_id, $type, $blog_id );
}

/**
 * wrapper of Mlp_Helpers function for custom plugins to get activated on all language blogs
 *
 * @since	0.1
 * @param	int $element_id ID of the selected element
 * @param	string $type type of the selected element
 * @param	int $blog_id ID of the selected blog
 * @param	string $hook name of the hook that will be executed
 * @param	array $param parameters for the function
 * @return	WP_Error|NULL
 */
function mlp_run_custom_plugin( $element_id = 0, $type = '', $blog_id = 0, $hook = NULL, $param = NULL ) {
	return Mlp_Helpers::run_custom_plugin( $element_id, $type, $blog_id, $hook, $param );
}

/**
 * wrapper of Mlp_Helpers function for function to get the url of the flag from a blogid

 * @since	0.1
 * @param	int $blog_id ID of a blog
 * @return	string url of the language image
 */
function mlp_get_language_flag( $blog_id = 0 ) {
	return Mlp_Helpers::get_language_flag( $blog_id );
}

/**
 * wrapper of Mlp_Helpers function for function to get the linked elements and display them as a list
 *
 * @since	0.8
 * @param	string $args_or_deprecated_text available types: flag, text, text_flag
 * @param	bool $deprecated_echo to display the output or to return. default is display
 * @param string $deprecated_sort
 * @return	string output of the bloglist
 */
function mlp_show_linked_elements( $args_or_deprecated_text = 'text', $deprecated_echo = TRUE, $deprecated_sort = 'blogid' ) {

	$args = is_array( $args_or_deprecated_text ) ?
	$args_or_deprecated_text
	:
	array(
		'link_text' => $args_or_deprecated_text,
		'echo' => $deprecated_echo,
		'sort' => $deprecated_sort,
	);

	$defaults = array(
		'link_text' => 'text', 'echo' => TRUE,
		'sort' => 'blogid', 'show_current_blog' => FALSE,
	);

	$params = wp_parse_args( $args, $defaults );

	$output = Mlp_Helpers::show_linked_elements( $params );

	if ( TRUE === $params[ 'echo' ] )
		echo $output;

	return $output;
}

/**
 * get the linked elements with a lot of more information
 *
 * @since	0.7
 * @param	int $element_id current post / page / whatever
 * @return	array
 */
function mlp_get_interlinked_permalinks( $element_id = 0 ) {
	return Mlp_Helpers::get_interlinked_permalinks( $element_id );
}

/**
 * get the blog language
 *
 * @param  int  $blog_id
 * @param  bool $short Return only the first part of the language code.
 * @return string Second part of language identifier
 */
function get_blog_language( $blog_id = 0, $short = TRUE ) {
	return Mlp_Helpers::get_blog_language( $blog_id, $short );
}

/**
 * Get language representation.
 *
 * @since 1.0.4
 * @param string $iso Two-letter code like "en" or "de"
 * @param string $field Sub-key name: "iso_639_2", "en" or "native",
 *               defaults to "native", "all" returns the complete list.
 * @return boolean|array|string FALSE for unknown language codes or fields,
 *               array for $field = 'all' and string for specific fields
 */
function mlp_get_lang_by_iso( $iso, $field = 'native' ) {
	return Mlp_Helpers::get_lang_by_iso( $iso, $field );
}


if ( ! function_exists( 'blog_exists' ) ) {

	/**
	 * Checks if a blog exists and is not marked as deleted.
	 *
	 * @link   http://wordpress.stackexchange.com/q/138300/73
	 * @param  int $blog_id
	 * @param  int $site_id
	 * @return bool
	 */
	function blog_exists( $blog_id, $site_id = 0 ) {

		global $wpdb;
		static $cache = array ();

		$site_id = (int) $site_id;

		if ( 0 === $site_id )
			$site_id = get_current_site()->id;

		if ( empty ( $cache ) or empty ( $cache[ $site_id ] ) ) {

			if ( wp_is_large_network() ) // we do not test large sites.
				return TRUE;

			$query = "SELECT `blog_id` FROM $wpdb->blogs
					WHERE site_id = $site_id AND deleted = 0";

			$result = $wpdb->get_col( $query );

			// Make sure the array is always filled with something.
			if ( empty ( $result ) )
				$cache[ $site_id ] = array ( 'do not check again' );
			else
				$cache[ $site_id ] = $result;
		}

		return in_array( $blog_id, $cache[ $site_id ] );
	}
}