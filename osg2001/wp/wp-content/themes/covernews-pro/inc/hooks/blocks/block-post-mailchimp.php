<?php

$mailchimp_title = esc_html(covernews_get_option('footer_mailchimp_title'));
$mailchimp_shortcode = wp_kses_post(covernews_get_option('footer_mailchimp_shortcode'));

if (!empty($mailchimp_shortcode)) {
    ?>
    <div class="mailchimp-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="block-title text-center">
                        <?php echo esc_html($mailchimp_title); ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <?php echo do_shortcode($mailchimp_shortcode); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}