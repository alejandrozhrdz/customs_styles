<?php get_header();?>

    <?php while(have_posts()): the_post(); ?>


        <div class="hero" style = "background-image:url(<?php echo get_the_post_thumbnail_url() ?>);">
            <div class="contenido-hero">
                <div class="texto-hero">
                    <h1><?php echo esc_html(get_option('blogdescription')); ?></h1>
                    <?php the_content(); ?>

                    <?php $url = get_page_by_title('Sobre Nosotros'); ?>
                    <!-- El título de la pagina varía de acuerdo a la página que se quiera redirigir -->

                    <a class="button" href="<?php echo get_permalink($url->ID); ?>" >Leer más</a>
                </div>
            </div>
        </div>

    <div class="principal contenedor">
        <main class="texto-centrado contenido-paginas">
    
        </main>
    </div>

    <?php endwhile; ?>


<?php get_footer();?>