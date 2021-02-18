<?php
/**
* ElegantWP_Customize_Category_Control class
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*/

class ElegantWP_Customize_Category_Control extends WP_Customize_Control {
    public $type = 'elegantwp-dropdown-category';

    protected $dropdown_args = false;

    protected function render_content() {
        $input_id = '_customize-input-' . $this->id;
        $description_id = '_customize-description-' . $this->id;
        $describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';

        if ( ! empty( $this->label ) ) :
            ?><label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label><?php
        endif;

        if ( ! empty( $this->description ) ) :
            ?><span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span><?php
        endif;

        $dropdown_args = wp_parse_args( $this->dropdown_args, array(
            'show_option_all'   => '',
            'show_option_none'  => '',
            'option_none_value' => 0,
            'orderby'           => 'id',
            'order'             => 'ASC',
            'show_count'        => 1,
            'hide_empty'        => 1,
            'child_of'          => 0,
            'exclude'           => '',
            'selected'          => $this->value(),
            'hierarchical'      => 1,
            'name'      => '',
            'id'      => esc_attr( $input_id ),
            'depth'             => 0,
            'tab_index'         => 0,
            'taxonomy'          => 'category',
            'hide_if_empty'     => false,
            'value_field'       => 'term_id',
        ) );

        $dropdown_args['echo'] = false;
        $dropdown = wp_dropdown_categories( $dropdown_args );
        $dropdown = str_replace( '<select', '<select ' . $this->get_link() . ' ' . $describedby_attr, $dropdown );
        echo $dropdown;
    }
}