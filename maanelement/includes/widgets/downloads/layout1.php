<?php
echo' <!-- Start work
		============================================= -->
        <div id="portfolio" class="portfolio-area">
                <div class="portfolio-items-area">
                    <div class="row">
                        <div class="col-xl-12 portfolio-content">
                            <div class="mix-item-menu active-theme text-center">';
$tax_args = array(
    'taxonomy'      => 'download_category',
    'number'        => $settings['show_cat'],
    'include'        => $settings['cat'],
    'hide_empty' => false,
);
$categories = get_terms($tax_args);
echo '<button class="active" data-filter="*">All</button>';
foreach($categories as $category) {

    echo '<button data-filter=".'.$category->slug.'" class="">' . $category->name . '</button>';
}
echo '</div>
        <!-- End Mixitup Nav-->
        <div class="magnific-mix-gallery masonary">
            <div id="portfolio-grid" class="portfolio-items">';
$the_query = new \WP_Query(array(
    'post_type' => 'download',
    'posts_per_page' => $settings['post_per'],
    'tax_query' => array(
        array(
            'taxonomy' => 'download_category',
            'field' => 'term_id',
            'terms' => $settings['cat'],
        )
    )
));
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $download_id = get_the_ID();
        $post_categories = get_the_terms( $download_id, 'download_category' );
        foreach ($post_categories as $cats){
            $cat[] = $cats->slug;
        }
        $filter = implode(' ', $cat);
        echo '<div class="pf-item video '.$filter.' wow fadeInLeft">
                                        <div class="work-box">
                                            <div class="work-pic">
                                                '.get_the_post_thumbnail().'
                                                <a href="'.get_the_post_thumbnail_url().'" class="item work-popup popup-link">      <i class="fas fa-search"></i>
                                                </a>
                                            </div>';
        echo '<div class="work-desc">
                                                <div class="work-meta">
                                                    <ul class="space-between">
                                                        <li>By- ' . get_the_author_posts_link() . '</li>
                                                        <li>Comments '.get_comments_number().'</li>
                                                    </ul>
                                                </div>
                                                <a href="'.get_the_permalink().'">
                                                    <h5 class="work-title">
                                                        '.get_the_title().'
                                                    </h5>
                                                </a>
                                                <div class="work-bottom space-between">
                                                    <div class="work-price">
                                                        <span class="value">';edd_price();echo'</span>
                                                        <div class="price-rating d-flex align-items-center">
                                                            '.maan_avarage_rating().'
                                                        </div>
                                                    </div>
                                                    <div class="work-btns">
                                                        <ul>
                                                            <li>'.edd_get_total_sales().' Sale</li>
                                                            <li><a href="'.get_the_permalink().'" class="btn-7">Preview</a></li>
                                             <li><a class="btn-cart" href="'.esc_url(home_url('/').'checkout?edd_action=add_to_cart&download_id='.get_the_ID()).'"><i class="fas fa-shopping-cart"></i></a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
    }
    wp_reset_postdata();
}
echo '</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="work-view text-center mt-70">
                    <a href="'.get_post_type_archive_link( 'download' ).'" class="btn-4">View All Item</a>
                </div>
        </div>
        <!-- End Work -->';