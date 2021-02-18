<?php
/**
* ElegantWP_Customize_Multiple_Select class
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class ElegantWP_Customize_Multiple_Select extends WP_Customize_Control {

public $type = 'tdna-multiple-select';

public function render_content() {

if ( empty( $this->choices ) )
    return;
?>
    <label>
        <?php if ( ! empty( $this->label ) ) : ?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php endif; ?>
        <?php if ( ! empty( $this->description ) ) : ?><span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span><?php endif; ?>
        <select <?php $this->link(); ?> multiple="multiple">
            <?php
                foreach ( $this->choices as $value => $label ) {
                    $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                    echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . esc_html( $label ) . '</option>';
                }
            ?>
        </select>
    </label>
<?php }

}