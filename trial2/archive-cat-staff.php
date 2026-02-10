<?php get_header(); ?>

<main class="main">
  <!-- パンくずリスト -->
  <?php breadcrumb(); ?>

  <!-- 猫スタッフ一覧セクション -->
  <section class="catStaffArchive">
    <div class="catStaffArchive__inner">
      <div class="catStaffArchive__container">
        <h1 class="catStaffArchive__title">猫スタッフ紹介</h1>

        <div class="catStaffArchive__list">
          <?php
          // カスタム投稿タイプ「cat-staff」の投稿を取得（古い順）
          $cat_staff_query = new WP_Query(array(
            'post_type' => 'cat-staff',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC'
          ));

          if ($cat_staff_query->have_posts()) :
            while ($cat_staff_query->have_posts()) : $cat_staff_query->the_post();
              // カスタムフィールドを取得
              $cat_image = get_post_meta(get_the_ID(), 'cat-image', true);
              $cat_gender = get_post_meta(get_the_ID(), 'cat-gender', true);
              $cat_age = get_post_meta(get_the_ID(), 'cat-age', true);
              $cat_personality = get_post_meta(get_the_ID(), 'cat-personality', false); // 複数選択のためfalse

              // ACFを使用している場合の対応
              if (function_exists('get_field')) {
                $acf_image = get_field('cat-image');
                if (!empty($acf_image)) {
                  $cat_image = $acf_image;
                }

                $acf_gender = get_field('cat-gender');
                if (!empty($acf_gender)) {
                  $cat_gender = $acf_gender;
                }

                $acf_age = get_field('cat-age');
                if (!empty($acf_age)) {
                  $cat_age = $acf_age;
                }

                $acf_personality = get_field('cat-personality');
                if (!empty($acf_personality)) {
                  $cat_personality = $acf_personality;
                }
              }

              // 性別の値を判定（♂と♀のみ）
              $gender_class = '';
              $gender_icon = '';
              if (!empty($cat_gender)) {
                $cat_gender_trimmed = trim($cat_gender);
                // ♀の場合
                if ($cat_gender_trimmed === '♀') {
                  $gender_class = 'female';
                  $gender_icon = '♀';
                }
                // ♂の場合
                elseif ($cat_gender_trimmed === '♂') {
                  $gender_class = 'male';
                  $gender_icon = '♂';
                }
              }

              // 画像の取得（カスタムフィールドまたはアイキャッチ画像）
              $image_url = '';
              if (!empty($cat_image)) {
                // ACFの画像フィールドの場合（配列またはID）
                if (is_array($cat_image) && isset($cat_image['url'])) {
                  $image_url = $cat_image['url'];
                } elseif (is_numeric($cat_image)) {
                  $image_url = wp_get_attachment_image_url($cat_image, 'medium');
                } else {
                  $image_url = $cat_image;
                }
              } elseif (has_post_thumbnail()) {
                $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              }

              // 性格タグの処理（配列または文字列）
              $personality_tags = array();
              if (!empty($cat_personality)) {
                if (is_array($cat_personality)) {
                  $personality_tags = $cat_personality;
                } else {
                  $personality_tags = explode(',', $cat_personality);
                }
              }
          ?>
              <article class="catStaffArchive__item">
                <a href="<?php the_permalink(); ?>" class="catStaffArchive__link">
                  <?php if ($image_url) : ?>
                    <div class="catStaffArchive__image">
                      <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>
                  <?php endif; ?>

                  <div class="catStaffArchive__content">
                    <div class="catStaffArchive__nameContent">
                      <h3 class="catStaffArchive__name"><?php the_title(); ?></h3>
                      <?php if (!empty($gender_class)) : ?>
                        <span class="catStaffArchive__gender catStaffArchive__gender--<?php echo esc_attr($gender_class); ?>">
                          <?php echo $gender_icon; ?>
                        </span>
                      <?php endif; ?>
                      <?php if ($cat_age) : ?>
                        <span class="catStaffArchive__age"><?php echo esc_html($cat_age); ?></span>
                      <?php endif; ?>
                    </div>

                    <?php if (!empty($personality_tags)) : ?>
                      <div class="catStaffArchive__tags">
                        <?php foreach ($personality_tags as $tag) :
                          $tag = trim($tag);
                          if (!empty($tag)) :
                        ?>
                            <span class="catStaffArchive__tag"><?php echo esc_html($tag); ?></span>
                        <?php
                          endif;
                        endforeach; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </a>
              </article>
            <?php
            endwhile;
            wp_reset_postdata();
          else :
            ?>
            <p class="catStaffArchive__noPosts">猫スタッフは登録されていません。</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>