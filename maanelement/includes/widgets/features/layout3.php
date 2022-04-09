<?php
echo '<!-- Start Comunity
		============================================= -->
		<div class="comunity-area">
				<div class="comunity-wpr grid-'.$settings['grid'].'">';
        if( $wp_query->have_posts() ) {
            while( $wp_query->have_posts() ) {
                $wp_query->the_post();
                echo '<div class="comunity-box wow fadeInUp">
						<div class="comunity-icon">
							'.get_the_post_thumbnail().'
						</div>
						<div class="comunity-info">
							<h5 class="mb-0">
							<a href="'.get_the_permalink().'">
								' . get_the_title() . '
								</a>
							</h5>
						</div>
					</div>';
            }
            wp_reset_postdata();
        }
        echo'</div>
		</div>
		<!-- End Comunity -->';