<?php get_header(); ?>

<main class="main">
  <!-- パンくずリスト -->
  <?php breadcrumb(); ?>

  <!-- お知らせ記事セクション -->
  <section class="newsDetail">
    <div class="newsDetail__inner">
      <div class="newsDetail__container">
        <?php
        if (have_posts()) :
          while (have_posts()) : the_post();
            // カスタムタクソノミー「news-category」を参照
            $category_name = 'お知らせ';
            $terms = get_the_terms(get_the_ID(), 'news-category');
            if (!empty($terms) && !is_wp_error($terms)) {
              $category_name = $terms[0]->name;
            }
        ?>
            <article class="newsDetail__article">
              <!-- 記事ヘッダー -->
              <div class="newsDetail__header">
                <h1 class="newsDetail__title"><?php the_title(); ?></h1>
                <div class="newsDetail__meta">
                  <time class="newsDetail__date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                    <?php echo get_the_date('Y.m.d'); ?>
                  </time>
                  <span class="newsDetail__category"><?php echo esc_html($category_name); ?></span>
                </div>
              </div>

              <!-- 記事本文 -->
              <div class="newsDetail__body">
                <div class="newsDetail__content">
                  <?php the_content(); ?>
                </div>
              </div>

              <!-- ページネーション -->
              <div class="newsDetail__pagination">
                <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>" class="newsDetail__backButton">一覧へ戻る</a>
              </div>
            </article>
        <?php
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>