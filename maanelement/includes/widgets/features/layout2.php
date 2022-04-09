<?php
echo '
          <!-- Start Why Choose Us
		============================================= -->
        <div class="wh-area">
            <div class="wh-right wh-box-2  grid-'.$settings['grid'].'">';
if( $wp_query->have_posts() ) {
    while( $wp_query->have_posts() ) {
        $wp_query->the_post();
        echo '<div class="wh-box wow fadeInUp">
                    <div class="wh-icon">
                        <i>'.get_the_post_thumbnail().'</i>
                    </div>
                    <div class="wh-desc">
                        <h5 class="work-title"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h5>
                        <p class="mb-0">
                            ' . get_the_excerpt() . '
                        </p>
                    </div>
                </div>';
    }
    wp_reset_postdata();
}
echo'</div>
        </div>
        <!-- End Why Choose Us -->
        ';