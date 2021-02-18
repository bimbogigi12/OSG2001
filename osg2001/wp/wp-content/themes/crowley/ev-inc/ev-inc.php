<?php
/**
 * Inc.
 *
 * @package ev-inc
 */

/* Base Inc folder. */
define( 'EV_INC_FOLDER', trailingslashit( get_template_directory() . '/ev-inc' ) );

/* Base Inc folder URI. */
define( 'EV_INC_FOLDER_URI', trailingslashit( get_template_directory_uri() . '/ev-inc' ) );

/* Core helpers. */
require_once EV_INC_FOLDER . 'helpers/helpers.php';

/* Core setup. */
require_once EV_INC_FOLDER . 'core/setup.php';
