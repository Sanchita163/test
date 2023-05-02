<?php
/**
 * Template Name: Book List
 *
 * This is a custom page template for displaying a list of all the "Books" posts.
 */

get_header(); ?>

<header class="navbar navbar-expand-lg navbar-light" style="background-color: #000;">
  <div class="container" style="background">
    <a class="navbar-brand mx-auto" href="#">
      <img src="http://localhost/Book/wp-content/uploads/2023/05/headerLogo.png" alt="Logo" heaight="300px;" width="500px;" >
    </a>
  </div>
</header>



<?php
// Get all "Books" posts
$args = array(
    'post_type' => 'book',
    'posts_per_page' => -1,
);
$books = new WP_Query($args);

?>

<style>
    .carousel-item {
        height: 500px;
        overflow: hidden;
    }
    
    .carousel-item img {
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease-in-out;
    }

    .carousel-item:hover img {
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .carousel-item {
            height: 300px;
        }
    }
</style>

<?php if ($books->have_posts()) : ?>
    <div id="book-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < $books->post_count; $i++) : ?>
                <li data-target="#book-carousel" data-slide-to="<?php echo $i; ?>" <?php echo $i === 0 ? 'class="active"' : ''; ?>></li>
            <?php endfor; ?>
        </ol>
        <div class="carousel-inner">
            <?php
            $counter = 0;
            $col_width = 4; // number of items to show per slide
            while ($books->have_posts()) : $books->the_post();
                $cover_image = get_field('cover_image');
                if ($cover_image) : ?>
                    <?php if ($counter % $col_width === 0) : ?>
                        <div class="carousel-item <?php echo $counter === 0 ? 'active' : ''; ?>">
                            <div class="row">
                    <?php endif; ?>
                    <div class="col-lg-<?php echo 12 / $col_width; ?>">
                        <div class="book-item">
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url($cover_image['url']); ?>" alt="<?php echo esc_attr($cover_image['alt']); ?>" class="img-fluid">
                            </a>
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                    <?php if (($counter + 1) % $col_width === 0 || $counter === $books->post_count - 1) : ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php
                    $counter++;
                endif;
            endwhile; ?>
        </div>
        <a class="carousel-control-prev" href="#book-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#book-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php endif;

// Reset the post data
wp_reset_postdata(); ?>


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

?>
