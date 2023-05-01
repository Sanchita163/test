<?php
/**
 * Template Name: Book List
 *
 * This is a custom page template for displaying a list of all the "Books" posts.
 */

get_header();
// Enqueue Swiper CSS and JS files

wp_enqueue_style( 'swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css' );
wp_enqueue_script( 'swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', array( 'jquery' ), '', true );

?>

<style>
.book-slider {
  margin: 20px auto;
  width: 100%;
}

.book-slider .swiper-slide {
  display: flex;
  justify-content: center;
}

.book-item {
  margin: 0 10px;
  text-align: center;
}

.book-item img {
  max-width: 100%;
  height: auto;
}

</style>

<?php

// Get all "Books" posts
$args = array(
    'post_type' => 'book',
    'posts_per_page' => -1,
);
$books = new WP_Query( $args );


// Display the book slider with three books per slide
if ( $books->have_posts() ) :
    ?>
    <div class="book-slider">
        <div class="swiper-wrapper">
            <?php 
            while ( $books->have_posts() ) : $books->the_post();
                $cover_image = get_field( 'cover_image' ); 
                if ( $cover_image ) : ?>
                    <div class="swiper-slide">
                        <div class="book-item" style="width:300;height:600;">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $cover_image['url'] ); ?>" alt="<?php echo esc_attr( $cover_image['alt'] ); ?>" width="300" height="600">
                            </a>
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                <?php endif; 
            endwhile; ?>
        </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-pagination"></div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            var swiper = new Swiper('.book-slider', {
                slidesPerView: 3,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    992: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    }
                }
            });
        });
    </script>

<?php endif;



// Reset the post data
wp_reset_postdata();

// Display the list of "Books" posts
?>
<div class="container py-5">
    <h1 class="mb-4"><?php the_title(); ?></h1>
    <div class="row">
        <?php
        if ( $books->have_posts() ) :
            while ( $books->have_posts() ) : $books->the_post();
        ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <?php $cover_image = get_field( 'cover_image' ); ?>
                        <?php if ( $cover_image ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $cover_image['url'] ); ?>" alt="<?php echo esc_attr( $cover_image['alt'] ); ?>" class="card-img-top">
                            </a>
                        <?php elseif ( has_post_thumbnail() ) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top' ) ); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title(); ?></h5>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                            <p class="card-text"><small class="text-muted"><?php echo get_the_date(); ?> <?php echo get_the_time(); ?></small></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</div>

<?php
get_footer();




