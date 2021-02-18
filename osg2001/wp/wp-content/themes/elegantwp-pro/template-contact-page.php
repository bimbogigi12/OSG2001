<?php
/**
* The template for displaying contact page with a contact form.
*
* @package ElegantWP WordPress Theme
* @copyright Copyright (C) 2018 ThemesDNA
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
* @author ThemesDNA <themesdna@gmail.com>
*
* Template Name: Contact Form
* Template Post Type: page
*/

session_start();
get_header(); ?>

<div class="elegantwp-main-wrapper clearfix" id="elegantwp-main-wrapper" itemscope="itemscope" itemtype="http://schema.org/Blog" role="main">
<div class="theiaStickySidebar">
<div class="elegantwp-main-wrapper-inside clearfix">

<div class="elegantwp-posts-wrapper" id="elegantwp-posts-wrapper">

<?php while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('elegantwp-post-singular'); ?>>

        <header class="entry-header">
            <?php the_title( sprintf( '<h1 class="post-title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content clearfix">
                <?php
                the_content( sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span> <span class="meta-nav">&rarr;</span>', 'elegantwp-pro' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ) );

                wp_link_pages( array(
                 'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'elegantwp-pro' ) . '</span>',
                 'after'       => '</div>',
                 'link_before' => '<span>',
                 'link_after'  => '</span>',
                 ) );
                 ?>

        <div class="elegantwp-contact-form">
            <?php
                if ( !isset($_SESSION['elegantwp_contact_form_number_one'] ) ) {
                    $_SESSION['elegantwp_contact_form_number_one'] = rand(1, 9);
                }
                
                if ( !isset($_SESSION['elegantwp_contact_form_number_two'] ) ) {
                    $_SESSION['elegantwp_contact_form_number_two'] = rand(1, 9);
                }

                if (isset($_POST['elegantwp_contact_form_submit'])) {
                    if(empty($_POST['elegantwp_contact_form_name']) || empty($_POST['elegantwp_contact_form_email']) || empty($_POST['elegantwp_contact_form_subject']) || empty($_POST['elegantwp_contact_form_question']) || empty($_POST['elegantwp_contact_form_message'])) {
                        ?><div class="elegantwp-error"><?php esc_html_e( 'Please fill in all required fields!', 'elegantwp-pro' ); ?></div><?php
                    } elseif(!is_email(sanitize_email(wp_unslash($_POST['elegantwp_contact_form_email'])))) {
                        ?><div class="elegantwp-error"><?php esc_html_e( 'Invalid email address!', 'elegantwp-pro' ); ?></div><?php
                    } elseif(($_SESSION['elegantwp_contact_form_number_one'] + $_SESSION['elegantwp_contact_form_number_two']) != $_POST['elegantwp_contact_form_question']) {
                        ?><div class="elegantwp-error"><?php esc_html_e( 'You entered the wrong number in captcha!', 'elegantwp-pro' ); ?></div><?php
                    } elseif(!elegantwp_get_option('contact_form_email')) {
                        ?><div class="elegantwp-error"><?php esc_html_e( 'The contact form has not configured correctly. If you are the site Admin, go to the Theme Customizer and provide your email address.', 'elegantwp-pro' ); ?></div><?php
                    } else {
                        wp_mail(esc_html( elegantwp_get_option('contact_form_email') ), sprintf( '[%s] ' . esc_html(sanitize_text_field(wp_unslash($_POST['elegantwp_contact_form_subject']))), get_bloginfo('name') ), esc_html(sanitize_text_field(wp_unslash($_POST['elegantwp_contact_form_message']))),'From: "'. esc_html(sanitize_text_field(wp_unslash($_POST['elegantwp_contact_form_name']))) .'" <' . esc_html(sanitize_email(wp_unslash($_POST['elegantwp_contact_form_email']))) . '>');
                        ?><div class="elegantwp-email-success-message"><?php esc_html_e( 'Thanks for contacting us.', 'elegantwp-pro' ); ?></div><?php
                    }
                    $_SESSION['elegantwp_contact_form_number_one'] = rand(1, 9);
                    $_SESSION['elegantwp_contact_form_number_two'] = rand(1, 9);
                }
            ?>

            <form method="post" action="">
                <input type="hidden" name="elegantwp_contact_form_submit" value="true" />
                <div class="elegantwp-contact-form-label <?php if(isset($_POST['elegantwp_contact_form_submit']) && empty($_POST['elegantwp_contact_form_name'])) { echo esc_attr('elegantwp-contact-form-required'); } ?>"><?php esc_html_e( 'Name', 'elegantwp-pro' ); ?>:</div>
                <div class="elegantwp-contact-form-input"><input type="text" name="elegantwp_contact_form_name" value="<?php if ( isset($_POST['elegantwp_contact_form_name']) ) { echo esc_attr(sanitize_text_field(wp_unslash($_POST['elegantwp_contact_form_name']))); } ?>" /></div>
                
                <div class="elegantwp-contact-form-label <?php if(isset($_POST['elegantwp_contact_form_submit']) && empty($_POST['elegantwp_contact_form_email'])) { echo esc_attr('elegantwp-contact-form-required'); } ?>"><?php esc_html_e( 'Email', 'elegantwp-pro' ); ?>:</div>
                <div class="elegantwp-contact-form-input"><input type="text" name="elegantwp_contact_form_email" value="<?php if ( isset($_POST['elegantwp_contact_form_email']) ) { echo esc_attr(sanitize_email(wp_unslash($_POST['elegantwp_contact_form_email']))); } ?>" /></div>
                
                <div class="elegantwp-contact-form-label <?php if(isset($_POST['elegantwp_contact_form_submit']) && empty($_POST['elegantwp_contact_form_question'])) { echo esc_attr('elegantwp-contact-form-required'); } ?>"><?php echo esc_html($_SESSION['elegantwp_contact_form_number_one']); ?> + <?php echo esc_html($_SESSION['elegantwp_contact_form_number_two']); ?> = ?</div>
                <div class="elegantwp-contact-form-input"><input type="text" name="elegantwp_contact_form_question" value="" /></div>
                
                <div class="elegantwp-contact-form-label <?php if(isset($_POST['elegantwp_contact_form_submit']) && empty($_POST['elegantwp_contact_form_subject'])) { echo esc_attr('elegantwp-contact-form-required'); } ?>"><?php esc_html_e( 'Subject', 'elegantwp-pro' ); ?>:</div>
                <div class="elegantwp-contact-form-input"><input type="text" name="elegantwp_contact_form_subject" value="<?php if ( isset($_POST['elegantwp_contact_form_subject']) ) { echo esc_attr(sanitize_text_field(wp_unslash($_POST['elegantwp_contact_form_subject']))); } ?>" /></div>
                
                <div class="elegantwp-contact-form-label <?php if(isset($_POST['elegantwp_contact_form_submit']) && empty($_POST['elegantwp_contact_form_message'])) { echo esc_attr('elegantwp-contact-form-required'); } ?>"><?php esc_html_e( 'Message', 'elegantwp-pro' ); ?>:</div>
                <div class="elegantwp-contact-form-input"><textarea name="elegantwp_contact_form_message" ><?php if ( isset($_POST['elegantwp_contact_form_message']) ) { echo esc_textarea(sanitize_text_field(wp_unslash($_POST['elegantwp_contact_form_message']))); } ?></textarea></div>
                
                <div class="elegantwp-contact-form-input"><input type="submit" value="<?php esc_attr_e( 'Submit', 'elegantwp-pro' ); ?>" /></div>
            </form>
        </div>

        </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php edit_post_link( esc_html__( 'Edit', 'elegantwp-pro' ), '<span class="edit-link">', '</span>' ); ?>
    </footer><!-- .entry-footer -->

    </article>

<?php endwhile; ?>
<div class="clear"></div>

</div><!--/#elegantwp-posts-wrapper -->

</div>
</div>
</div><!-- /#elegantwp-main-wrapper -->

<?php get_footer(); ?>