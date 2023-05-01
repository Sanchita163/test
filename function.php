// Custome Book Post Type
//add this code in function.php file

function create_book_post_type() {
    $labels = array(
        'name' => __( 'Books' ),
        'singular_name' => __( 'Book' ),
        'add_new' => __( 'Add New Book' ),
        'add_new_item' => __( 'Add New Book' ),
        'edit_item' => __( 'Edit Book' ),
        'new_item' => __( 'New Book' ),
        'view_item' => __( 'View Book' ),
        'search_items' => __( 'Search Books' ),
        'not_found' => __( 'No books found' ),
        'not_found_in_trash' => __( 'No books found in trash' ),
        'parent_item_colon' => __( 'Parent Book' ),
        'menu_name' => __( 'Books' ),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'book' ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );

    register_post_type( 'book', $args );
}
add_action( 'init', 'create_book_post_type' );



function enqueue_bootstrap() {
    wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' );
    wp_enqueue_script( 'jquery', 'https://code.jquery.com/jquery-3.4.1.slim.min.js', array(), '3.4.1', true );
    wp_enqueue_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js', array(), '1.16.0', true );
    wp_enqueue_script( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js', array(), '4.4.1', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_bootstrap' );

