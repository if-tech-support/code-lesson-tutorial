<?php get_header(); ?>

<main class="main">
  <!-- パンくずリスト -->
  <?php breadcrumb(); ?>

  <!-- お知らせ一覧セクション -->
  <section class="newsArchive">
    <div class="newsArchive__inner">
      <div class="newsArchive__container">
        <h1 class="newsArchive__title">お知らせ</h1>

        <div class="newsArchive__list">
          <?php
          if (have_posts()) :
            while (have_posts()) : the_post();
              // カスタム投稿タイプに対応
              $post_type = get_post_type();
              $category_name = 'お知らせ';

              // 通常の投稿の場合
              if ($post_type === 'post') {
                $categories = get_the_category();
                $category_name = !empty($categories) ? $categories[0]->name : 'お知らせ';
              }
              // カスタム投稿タイプの場合
              else {
                // カスタムタクソノミー「news-category」を参照
                $terms = get_the_terms(get_the_ID(), 'news-category');
                if (!empty($terms) && !is_wp_error($terms)) {
                  $category_name = $terms[0]->name;
                }
              }
          ?>
              <article class="newsArchive__item">
                <div class="newsArchive__row">
                  <div class="newsArchive__meta">
                    <time class="newsArchive__date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                      <?php echo get_the_date('Y.m.d'); ?>
                    </time>
                    <span class="newsArchive__category"><?php echo esc_html($category_name); ?></span>
                  </div>
                  <p class="newsArchive__text">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </p>
                </div>
              </article>
            <?php
            endwhile;
          else :
            ?>
            <p class="newsArchive__noPosts">お知らせはありません。</p>
          <?php endif; ?>
        </div>

        <!-- ページネーション -->
        <?php
        $pagination = paginate_links(array(
          'prev_text' => '«',
          'next_text' => '»',
          'type' => 'list',
          'end_size' => 1,
          'mid_size' => 1,
        ));
        if ($pagination) :
        ?>
          <div class="newsArchive__pagination">
            <?php echo $pagination; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>