<?php
    /**
     * Content Timeline Markup
     */
    if( $post_args['post_style'] == 'content_timeline' ) :
        $icon_image = $post_args['eael_icon_image'];
        if( empty( $icon_image_url ) ) :
            $icon_image_url = $icon_image['url']; 
        else : 
            $icon_image_url = $icon_image_url; 
        endif;
?>
    <div class="eael-content-timeline-block">
        <div class="eael-content-timeline-line">
            <div class="eael-content-timeline-inner"></div>
        </div>
        <div class="eael-content-timeline-img eael-picture <?php if( 'bullet' === $post_args['eael_show_image_or_icon'] ) : echo 'eael-content-timeline-bullet'; endif;?>">
            <?php if( 'img' === $post_args['eael_show_image_or_icon'] ) : ?>
                <img src="<?php echo esc_url( $icon_image_url ); ?>" alt="Icon Image">
            <?php endif; ?>
            <?php if( 'icon' === $post_args['eael_show_image_or_icon'] ) : ?>
                <i class="<?php echo esc_attr( $post_args['eael_content_timeline_circle_icon'] ); ?>"></i>
            <?php endif; ?>
        </div>

        <div class="eael-content-timeline-content">
            <?php if( '1' == $post_args['eael_show_title'] ) : ?>
                <h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo the_title(); ?></a></h2>
            <?php endif; ?>
            <?php if( '1' == $post_args['eael_show_excerpt'] ) : ?>
                <p><?php echo eael_get_excerpt_by_id( get_the_ID(), $post_args['eael_excerpt_length'] );?></p>
            <?php endif; ?>
            <?php if( '1' === $post_args['eael_show_read_more'] && !empty( $post_args['eael_read_more_text'] ) ) : ?>
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="eael-read-more"><?php echo esc_html__( $post_args['eael_read_more_text'], 'essential-addons-elementor' ); ?></a>
            <?php endif; ?>
            <span class="eael-date"><?php echo get_the_date(); ?></span>
        </div>
    </div>
<?php endif; // $post_args['post_style'] == 'content_timeline' ?>