<?php
/*
 * Auto ThickBox Plus Utils
 * Copyright (C) 2012 attosoft <http://attosoft.info/en/>
 * This file is distributed under the same license as the Auto ThickBox Plus package.
 * attosoft <contact@attosoft.info>, 2012.
 */

class auto_thickbox_utils {

/*
 * Retrieves the translated string from both 'auto-thickbox' and 'default' domain
 */
function __( $text ) {
	$ret = __($text, 'auto-thickbox');
	return $ret != $text ? $ret : __($text);
}

function _e( $text ) {
	echo $this->__($text);
}

// @since 2.8.0
function esc_attr( $text ) {
	return function_exists( 'esc_attr' ) ? esc_attr( $text ) : attribute_escape( $text );
}

function esc_attr__( $text ) {
	return $this->esc_attr($this->__($text));
}

function esc_attr_e( $text ) {
	echo $this->esc_attr__($text);
}

// @param msgid key list (variable-length arguments)
function _s() {
	$num_args = func_num_args();
	for ($i = 0; $i < $num_args; $i++) {
		$text = func_get_arg($i);
		$ret = $this->__($text);
		if ($ret != $text)
			return $ret;
	}
	return func_get_arg(0);
}

// @param msgid key list (variable-length arguments)
function _es() {
	$args = func_get_args();
	echo call_user_func_array(array(&$this, '_s'), $args);
}

/**
 * @since 3.0
 * @see /wp-includes/general-template.php
 */
function disabled( $disabled, $current = true, $echo = true ) {
	if (function_exists( 'disabled' ))
		return disabled( $disabled, $current, $echo );
	else if (function_exists( '__checked_selected_helper' ))
		return __checked_selected_helper( $disabled, $current, $echo, 'disabled' );

	$result = $disabled == $current ? " disabled='disabled'" : '';
	if ( $echo ) echo $result;
	return $result;
}

/**
 * @see /wp-admin/includes/template.php or /wp-includes/general-template.php
 * @note '$current = true' and '$echo' is defined since WordPress 2.8
 */
function checked( $checked, $current = true, $echo = true ) {
	if ( version_compare('2.8', get_bloginfo('version')) > 0 )
		checked( $checked, $current );
	else
		return checked( $checked, $current, $echo );
}

// @note '$plugin' is defined since WordPress 2.8
function plugins_url( $path, $plugin = '' ) {
	if (!$plugin) $plugin = __FILE__;
	return version_compare('2.8', get_bloginfo('version')) > 0 ? plugins_url( ATBP_SLUG . '/' . $path ) : plugins_url( $path, $plugin );
}

} # auto_thickbox_options
?>