<?php
$english_name = get_post_meta(get_the_ID(), '_hrm_movie_english_name', true);
$year = get_post_meta(get_the_ID(), '_hrm_movie_release_year', true);
$genres = get_the_terms( get_the_ID(), 'genre' );
?>

<article class="c-movie">
    <a class="c-movie__link" aria-label="<?php the_title(); ?>" href="<?php echo get_permalink() ?>"></a>
    <div class="c-movie__thumbnail">
        <?php if (has_post_thumbnail()):
            the_post_thumbnail('medium');
        else: ?>
            <img width="212" alt="<?php the_title(); ?>" src="<?php echo get_template_directory_uri() ?>/assets/img/cover.jpg" />
        <?php endif; ?>
    </div>
    <div class="c-movie__content">
        <h2 class="c-movie__title"><?php the_title(); ?></h2>
        <div class="c-movie__en-name"><?php echo $english_name ?: "6.5 per meter"; ?></div>
        <div class="c-movie__release"><?php echo $year?: "2023"; ?></div>
        <div class="c-movie__excerpt">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>
