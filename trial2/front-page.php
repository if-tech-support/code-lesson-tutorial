<?php get_header(); ?>

<main class="main">
  <div class="l-topVisualArea">
    <!-- ファーストビュー -->
    <section class="hero">
      <h1 class="hero__heading">
        <picture class="hero__picture">
          <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/hero-image-sp.png">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/hero-image.png"
            alt="出会いが、家族になる。NECOnoTEは、保護猫の譲渡支援を行う猫カフェです。"
            class="hero__image">
        </picture>
      </h1>
    </section>

    <!-- お知らせセクション -->
    <section class="news">
      <div class="news__inner">
        <div class="news__container">
          <h2 class="news__title">お知らせ</h2>

          <div class="news__list">
            <?php
            // サブループでお知らせを取得
            $news_query = new WP_Query(array(
              'post_type' => 'news',
              'posts_per_page' => 3,
              'orderby' => 'date',
              'order' => 'DESC'
            ));

            if ($news_query->have_posts()) :
              while ($news_query->have_posts()) : $news_query->the_post();
                // カスタムタクソノミー「news-category」を参照
                $category_name = 'お知らせ';
                $terms = get_the_terms(get_the_ID(), 'news-category');
                if (!empty($terms) && !is_wp_error($terms)) {
                  $category_name = $terms[0]->name;
                }
            ?>
                <article class="news__item">
                  <div class="news__row">
                    <div class="news__meta">
                      <time class="news__date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                        <?php echo get_the_date('Y.m.d'); ?>
                      </time>
                      <span class="news__category"><?php echo esc_html($category_name); ?></span>
                    </div>
                    <p class="news__text">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </p>
                  </div>
                </article>
              <?php
              endwhile;
              wp_reset_postdata();
            else :
              ?>
              <p class="news__noPosts">お知らせはありません。</p>
            <?php endif; ?>
          </div>

          <a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>" class="news__button u-button">
            お知らせ一覧を見る
          </a>
        </div>
      </div>
    </section>
  </div>

  <!-- 猫スタッフ紹介セクション -->
  <section class="catStaff">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/wave-top.svg" alt="" class="u-waveImg">

    <div class="catStaff__inner">
      <div class="catStaff__container">
        <h2 class="catStaff__title">当店の猫スタッフ</h2>

        <div class="catStaff__list swiper">
          <div class="catStaff__wrapper swiper-wrapper">
            <?php
            // カスタム投稿タイプ「cat-staff」の投稿を取得（古い順）
            $cat_staff_query = new WP_Query(array(
              'post_type' => 'cat-staff',
              'posts_per_page' => 6,
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
                <article class="catStaff__item swiper-slide">
                  <a href="<?php the_permalink(); ?>" class="catStaff__link">
                    <div class="catStaff__image">
                      <?php if ($image_url) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                      <?php else : ?>
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/cat-mikan.jpg" alt="<?php echo esc_attr(get_the_title()); ?>">
                      <?php endif; ?>
                    </div>
                    <div class="catStaff__content">
                      <div class="catStaff__nameContent">
                        <h3 class="catStaff__name"><?php the_title(); ?></h3>
                        <?php if (!empty($gender_class)) : ?>
                          <span class="catStaff__gender catStaff__gender--<?php echo esc_attr($gender_class); ?>">
                            <?php echo $gender_icon; ?>
                          </span>
                        <?php endif; ?>
                        <?php if ($cat_age) : ?>
                          <span class="catStaff__age"><?php echo esc_html($cat_age); ?></span>
                        <?php endif; ?>
                      </div>
                      <?php if (!empty($personality_tags)) : ?>
                        <div class="catStaff__tags">
                          <?php foreach ($personality_tags as $tag) :
                            $tag = trim($tag);
                            if (!empty($tag)) :
                          ?>
                              <span class="catStaff__tag"><?php echo esc_html($tag); ?></span>
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
            endif;
            ?>
          </div>
        </div>

        <a href="<?php echo esc_url(get_post_type_archive_link('cat-staff')); ?>" class="catStaff__button u-button">
          猫スタッフ一覧を見る
        </a>
      </div>
    </div>

    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/wave-bottom.svg" alt="" class="u-waveImg u-waveImg--rotate">
  </section>

  <div class="l-middleVisualArea">
    <!-- 特徴セクション -->
    <section class="feature">
      <div class="feature__inner">
        <div class="feature__container">
          <h2 class="feature__title">NECOnoTEの特徴</h2>

          <div class="feature__list">
            <div class="feature__item">
              <div class="feature__image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/feature-1.jpg" alt="保護猫の譲渡支援">
              </div>
              <div class="feature__text">
                <h3 class="feature__itemTitle">保護猫の譲渡支援</h3>
                <p class="feature__itemText">猫たちが幸せな家族と出会えるよう、譲渡活動をサポートしています</p>
              </div>
            </div>

            <div class="feature__item">
              <div class="feature__image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/feature-2.jpg" alt="清潔で快適な環境">
              </div>
              <div class="feature__text">
                <h3 class="feature__itemTitle">清潔で快適な環境</h3>
                <p class="feature__itemText">猫も人も快適に過ごせる空間を維持しています</p>
              </div>
            </div>

            <div class="feature__item">
              <div class="feature__image">
                <img src="<?php echo get_template_directory_uri(); ?>/images/feature-3.jpg" alt="譲渡後のサポート">
              </div>
              <div class="feature__text">
                <h3 class="feature__itemTitle">譲渡後のサポート</h3>
                <p class="feature__itemText">譲渡後も相談窓口を設け、新しい家族との生活をサポートします</p>
              </div>
            </div>
          </div>

          <a href="<?php echo get_permalink(get_page_by_path('infomation')); ?>" class="feature__button u-button">
            料金・ご利用案内を見る
          </a>
        </div>
      </div>
    </section>

    <!-- アクセスセクション -->
    <section class="access">
      <div class="access__inner">
        <div class="access__container">
          <div class="access__containerInner">
            <h2 class="access__title">アクセス</h2>

            <div class="access__content">
              <div class="access__info">
                <div class="access__infoList">
                  <div class="access__infoItem">
                    <p class="access__infoLabel">店舗名</p>
                    <p class="access__infoValue">保護猫カフェ NECOnoTE</p>
                  </div>

                  <div class="access__infoItem">
                    <p class="access__infoLabel">住所</p>
                    <div class="access__infoValue">
                      <p>〒150-0001</p>
                      <p>東京都渋谷区神宮前1-2-3 NEKOビル2F</p>
                    </div>
                  </div>

                  <div class="access__infoItem">
                    <p class="access__infoLabel">電話番号</p>
                    <a href="tel:03-1234-5678" class="access__infoValue">03-1234-5678</a>
                  </div>

                  <div class="access__infoItem">
                    <p class="access__infoLabel">営業時間</p>
                    <div class="access__infoValue">
                      <p>平日：11:00 - 19:00</p>
                      <p>土日祝：10:00 - 20:00</p>
                    </div>
                  </div>

                  <div class="access__infoItem">
                    <p class="access__infoLabel">定休日</p>
                    <p class="access__infoValue">水曜日</p>
                  </div>
                </div>

                <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="access__button u-button">
                  お問い合わせはこちら
                </a>
              </div>

              <div class="access__map">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6482.6949371196315!2d139.70388624683503!3d35.66844539036523!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188ca3cb3808cd%3A0xb334a68cf37b6691!2z44CSMTUwLTAwMDEg5p2x5Lqs6YO95riL6LC35Yy656We5a6u5YmN!5e0!3m2!1sja!2sjp!4v1768873428637!5m2!1sja!2sjp"
                  width="100%"
                  height="100%"
                  style="border:0;"
                  allowfullscreen=""
                  loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"
                  title="アクセスマップ">
                </iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<?php
get_footer();
?>