<?php
remove_filter('the_content', 'edd_append_purchase_link');
remove_filter('edd_after_download_content', 'edd_append_purchase_link');
/**
 * Remove default edd review from content
 *
 * @since 2.5
 */
function maan_remove_review() {
    if ( class_exists( 'EDD_Reviews' ) ) {
        $edd_reviews = edd_reviews();
        remove_filter( 'the_content', array( $edd_reviews, 'load_frontend' ) );
    }
}
add_action( 'template_redirect', 'maan_remove_review' );
/**
 * Avarage rating
 *
 * @since 2.5
 */
function maan_avarage_rating() {
    // make sure edd reviews is active
    if ( ! function_exists( 'edd_reviews' ) )
        return;

    $edd_reviews = edd_reviews();
    // get the average rating for this download
    $average_rating = $edd_reviews->average_rating( false );
    $rating = $average_rating;

    $ratingclass = (int) $edd_reviews->average_rating( false );
    ob_start();
    ?>
    <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating">
        <div class="edd_reviews_rating_box <?php if ($rating==4.5){  ?>four-half-rating<?php }?> <?php echo __( 'stars', 'maan' ).$ratingclass; ?>" role="img">
            <div class="edd_star_rating" aria-label="<?php echo $rating . ' ' . __( 'stars', 'maan' ); ?>">
                <span class="rating-stars"></span>
                <span class="rating-stars"></span>
                <span class="rating-stars"></span>
                <span class="rating-stars"></span>
                <span class="rating-stars-last"></span>
                <p>(<?php echo $edd_reviews->count_reviews();?>)</p>
            </div>
        </div>
        <div style="display:none" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
            <meta itemprop="worstRating" content="1" />
            <span itemprop="ratingValue"><?php echo $rating; ?></span>
            <span itemprop="bestRating">5</span>
        </div>
    </div>
    <?php
    $rating_html = ob_get_clean();
    return $rating_html;
}