<?php
get_header();

// Get current page number for pagination

$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

// Get posts_per_page setting from WordPress admin (Settings → Reading)
$posts_per_page = get_option( 'posts_per_page' );

// Custom WP_Query to fetch movies
$movies = new WP_Query( array(
    'post_type'      => 'movie',
    'posts_per_page' => $posts_per_page,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'paged'          => $paged, // <-- important for pagination
) );
?>

<div id="primary" class="o-content-area">
    <div class="o-container">
        <main class="o-site-main">
            <div class="o-grid">
                <?php
                if ( $movies->have_posts() ) :

                    while ( $movies->have_posts() ) : $movies->the_post();
                        get_template_part( 'template-parts/content', 'movie' );
                    endwhile;

                    wp_reset_postdata();
                else :
                    echo '<p class="o-grid__no-item">هیچ فیلمی پیدا نشد.</p>';
                endif;
                ?>
            </div>
            <?php
            // Pagination
            echo '<div class="o-pagination">';
            echo paginate_links( array(
                'total'   => $movies->max_num_pages,
                'current' => $paged,
                'mid_size' => 2,
                'prev_text' => __('« صفحه قبلی'),
                'next_text' => __('صفحه بعدی »'),
            ) );
            echo '</div>';
            ?>
        </main>
    </div>
</div>
