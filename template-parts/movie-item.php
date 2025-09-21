<?php
$english_name = get_post_meta(get_the_ID(), '_hrm_movie_english_name', true);
$year = get_post_meta(get_the_ID(), '_hrm_movie_release_year', true);
$genres = get_the_terms( get_the_ID(), 'genre' );
?>
<div class="c-movie--list">
    <div class="c-movie__cover">
        <?php if (has_post_thumbnail()):
            the_post_thumbnail('medium');
        else: ?>
            <img width="212" alt="<?php the_title(); ?>" src="<?php echo get_template_directory_uri() ?>/assets/img/cover.jpg" />
        <?php endif; ?>
        <div class="c-movie__cover__badges">
               <span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/hot.png" alt="Hot" />
            </span>
            <span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/subtitle.png" alt="Subtitle" />
            </span>
            <span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/sound.png" alt="Dubbed" />
            </span>
        </div>
    </div>
    <div class="c-movie__content">
        <h2 class="c-movie__title"><?php the_title(); ?></h2>
        <div class="c-movie__en-name"><?php echo $english_name ?: "6.5 per meter"; ?></div>
        <div class="c-movie__info-grid">
            <div class="c-movie__release"><?php echo $year?: "2023"; ?></div>
            <div class="c-movie__rate">
                <span class="c-movie__rate__total">(۱۲رای)</span>
                <span class="c-movie__rate__score">۳.۵</span>
                <span class="c-movie__rate__star">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.0359 8.25777L15.1427 12.0528L16.0621 17.4128C16.0818 17.5277 16.0689 17.6459 16.025 17.7539C15.981 17.8619 15.9077 17.9555 15.8134 18.024C15.719 18.0925 15.6074 18.1333 15.4911 18.1417C15.3748 18.1501 15.2584 18.1258 15.1552 18.0715L10.3415 15.5409L5.52835 18.0709C5.42514 18.1252 5.30879 18.1495 5.19248 18.1411C5.07617 18.1327 4.96453 18.0919 4.87018 18.0234C4.77583 17.9548 4.70254 17.8613 4.65859 17.7533C4.61464 17.6452 4.60178 17.5271 4.62148 17.4121L5.54085 12.0521L1.6471 8.25777C1.56353 8.17635 1.50441 8.07315 1.47646 7.95986C1.4485 7.84657 1.45281 7.72772 1.48891 7.61676C1.52501 7.5058 1.59145 7.40716 1.68071 7.33201C1.76997 7.25686 1.87849 7.20819 1.99398 7.19152L7.3746 6.41027L9.78085 1.53402C9.99148 1.10715 10.6915 1.10715 10.9021 1.53402L13.3084 6.41027L18.689 7.19152C18.8042 7.20863 18.9124 7.25753 19.0013 7.33274C19.0903 7.40794 19.1565 7.50647 19.1926 7.61725C19.2286 7.72802 19.233 7.84665 19.2053 7.95981C19.1777 8.07296 19.119 8.17615 19.0359 8.25777Z" fill="#F3B209"/><path d="M5.52835 18.0709L10.9021 15.5409V1.53402C10.6915 1.10715 9.99148 1.10715 9.78085 1.53402L7.3746 6.41027L1.99398 7.19152C1.87849 7.20819 1.76997 7.25686 1.68071 7.33201C1.59145 7.40716 1.52501 7.5058 1.48891 7.61676C1.45281 7.72772 1.4485 7.84658 1.47646 7.95986C1.50441 8.07315 1.56353 8.17635 1.6471 8.25777L5.54085 12.0521L4.62148 17.4121C4.60178 17.5271 4.61464 17.6452 4.65859 17.7533C4.70254 17.8613 4.77583 17.9548 4.87018 18.0234C4.96453 18.0919 5.07617 18.1327 5.19248 18.1411C5.30879 18.1495 5.42514 18.1252 5.52835 18.0709Z" fill="#F3B209"/></svg>
                </span>
            </div>
        </div>
        <div class="c-movie__info-grid c-movie__info-grid--ratings">
            <div class="c-movie__imdb">
                <span class="c-movie__imdb__top">۱۰ /</span>
                <span class="c-movie__imdb__rate">۴.۵ </span>
                <img src="http://illia.local/wp-content/themes/hrm-movie-website/assets/img/imdb.png" alt="IMDB">
            </div>
            <div class="c-movie__imdb">
                <span class="c-movie__imdb__top">۱۰ /</span>
                <span class="c-movie__imdb__rate">۶.۴ </span>
                <img src="http://illia.local/wp-content/themes/hrm-movie-website/assets/img/rotten-tomatoes.png" alt="Rotten Tomatoes">
            </div>
            <div class="c-movie__imdb">
                <span class="c-movie__imdb__rate">۴۵ </span>
                <img src="http://illia.local/wp-content/themes/hrm-movie-website/assets/img/metacritic.png" alt="Metacritic">
            </div>
        </div>
    </div>
</div>
