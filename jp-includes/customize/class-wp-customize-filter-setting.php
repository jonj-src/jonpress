<?php
/**
 * Customize API: JP_Customize_Filter_Setting class
 *
 * @package JonPress
 * @subpackage Customize
 * @since 4.4.0
 */

/**
 * A setting that is used to filter a value, but will not save the results.
 *
 * Results should be properly handled using another setting or callback.
 *
 * @since 3.4.0
 *
 * @see JP_Customize_Setting
 */
class JP_Customize_Filter_Setting extends JP_Customize_Setting {

	/**
	 * Saves the value of the setting, using the related API.
	 *
	 * @since 3.4.0
	 *
	 * @param mixed $value The value to update.
	 */
	public function update( $value ) {}
}
