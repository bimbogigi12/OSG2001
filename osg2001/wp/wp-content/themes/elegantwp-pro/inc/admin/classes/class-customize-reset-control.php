<?php
/**
* ElegantWP_Customize_Reset_Control class
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class ElegantWP_Customize_Reset_Control extends WP_Customize_Control {
    public $type = 'elegantwp-reset-button';

    public function render_content() {
        ?>
        <form action="customize.php" method="get">
        <label>
        <span style="font-weight:normal;margin-bottom:10px;" class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <input type="submit" class="reset-button button-secondary" name="elegantwp-reset-submit" value="<?php esc_attr_e( 'Reset Theme Options', 'elegantwp-pro' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any modification you have set in the Theme Customizer will be lost!', 'elegantwp-pro' ) ); ?>' );" />
        </label>
        </form>
        <?php
    }
}