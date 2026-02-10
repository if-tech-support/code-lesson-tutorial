<?php get_header(); ?>

<main class="main">
  <!-- パンくずリスト -->
  <?php breadcrumb(); ?>

  <!-- 猫スタッフ詳細セクション -->
  <section class="catStaffDetail">
    <div class="catStaffDetail__inner">
      <div class="catStaffDetail__container">
        <?php
        if (have_posts()) :
          while (have_posts()) : the_post();
            // カスタムフィールドを取得
            $cat_image = get_post_meta(get_the_ID(), 'cat-image', true);
            $cat_gender = get_post_meta(get_the_ID(), 'cat-gender', true);
            $cat_age = get_post_meta(get_the_ID(), 'cat-age', true);
            $cat_personality = get_post_meta(get_the_ID(), 'cat-personality', false); // 複数選択のためfalse
            $cat_background = get_post_meta(get_the_ID(), 'cat-background', true);
            $cat_medical = get_post_meta(get_the_ID(), 'cat-medical', true);
            $cat_comment = get_post_meta(get_the_ID(), 'cat-comment', true);

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

              $acf_background = get_field('cat-background');
              if (!empty($acf_background)) {
                $cat_background = $acf_background;
              }

              $acf_medical = get_field('cat-medical');
              if (!empty($acf_medical)) {
                $cat_medical = $acf_medical;
              }

              $acf_comment = get_field('cat-comment');
              if (!empty($acf_comment)) {
                $cat_comment = $acf_comment;
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
                $image_url = wp_get_attachment_image_url($cat_image, 'large');
              } else {
                $image_url = $cat_image;
              }
            } elseif (has_post_thumbnail()) {
              $image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
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

            // 譲渡条件（ファイル内に直接記載）
            $adoption_requirements = array(
              '完全室内飼育をお約束いただける方',
              '終生飼育をお約束いただける方',
              'ペット可の住宅にお住まいの方',
              '定期的な健康診断と予防接種を受けていただける方',
              '適齢期に去勢/避妊手術を受けていただける方',
            );
        ?>
            <div class="catStaffDetail__header">
              <h1 class="catStaffDetail__title"><?php the_title(); ?></h1>
            </div>

            <div class="catStaffDetail__card">
              <div class="catStaffDetail__mainContent">
                <?php if ($image_url) : ?>
                  <div class="catStaffDetail__image">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>">
                  </div>
                <?php endif; ?>

                <div class="catStaffDetail__profile">
                  <div class="catStaffDetail__profileSection">
                    <h2 class="catStaffDetail__profileTitle">プロフィール</h2>
                    <div class="catStaffDetail__profileList">
                      <!-- 性別 -->
                      <?php if (!empty($gender_class)) : ?>
                        <div class="catStaffDetail__profileRow">
                          <p class="catStaffDetail__profileLabel">性別</p>
                          <span class="catStaffDetail__gender catStaffDetail__gender--<?php echo esc_attr($gender_class); ?>">
                            <?php echo $gender_icon; ?>
                          </span>
                        </div>
                      <?php endif; ?>

                      <!-- 年齢 -->
                      <?php if ($cat_age) : ?>
                        <div class="catStaffDetail__profileRow">
                          <p class="catStaffDetail__profileLabel">年齢</p>
                          <p class="catStaffDetail__profileValue"><?php echo esc_html($cat_age); ?></p>
                        </div>
                      <?php endif; ?>

                      <!-- 性格 -->
                      <?php if (!empty($personality_tags)) : ?>
                        <div class="catStaffDetail__profileRow">
                          <p class="catStaffDetail__profileLabel">性格</p>
                          <div class="catStaffDetail__tags">
                            <?php foreach ($personality_tags as $tag) :
                              $tag = trim($tag);
                              if (!empty($tag)) :
                            ?>
                                <span class="catStaffDetail__tag"><?php echo esc_html($tag); ?></span>
                            <?php
                              endif;
                            endforeach; ?>
                          </div>
                        </div>
                      <?php endif; ?>

                      <!-- 保護経緯 -->
                      <?php if ($cat_background) : ?>
                        <div class="catStaffDetail__profileRow">
                          <p class="catStaffDetail__profileLabel">保護経緯</p>
                          <p class="catStaffDetail__profileValue"><?php echo esc_html($cat_background); ?></p>
                        </div>
                      <?php endif; ?>

                      <!-- 医療措置 -->
                      <?php if ($cat_medical) : ?>
                        <div class="catStaffDetail__profileRow">
                          <p class="catStaffDetail__profileLabel">医療措置</p>
                          <p class="catStaffDetail__profileValue"><?php echo esc_html($cat_medical); ?></p>
                        </div>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- スタッフからのコメント -->
                  <?php if ($cat_comment) : ?>
                    <div class="catStaffDetail__comment">
                      <h3 class="catStaffDetail__commentTitle">スタッフからのコメント</h3>
                      <p class="catStaffDetail__commentText"><?php echo esc_html($cat_comment); ?></p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <!-- 譲渡条件 -->
              <div class="catStaffDetail__requirements">
                <h3 class="catStaffDetail__requirementsTitle">譲渡条件</h3>
                <ul class="catStaffDetail__requirementsList">
                  <?php foreach ($adoption_requirements as $requirement) : ?>
                    <li class="catStaffDetail__requirementItem"><?php echo esc_html($requirement); ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
        <?php
          endwhile;
        endif;
        ?>
      </div>
    </div>
  </section>
  <!-- 波の装飾 -->
  <div class="u-wave">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/wave-bottom.svg" alt="" class="u-waveImg u-waveImg--rotate">
  </div>

  <!-- CTAセクション -->
  <section class="catStaffDetail__cta">
    <div class="catStaffDetail__ctaInner">
      <div class="catStaffDetail__ctaContainer">
        <h2 class="catStaffDetail__ctaTitle">譲渡をご検討の方へ</h2>
        <div class="catStaffDetail__ctaText">
          <p>譲渡をご希望の方は、まずは店舗にお越しいただき、猫たちとのふれあいをお楽しみください。</p>
          <p>スタッフが丁寧にご説明させていただきます。</p>
        </div>
        <div class="catStaffDetail__ctaButtons">
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('infomation'))); ?>" class="catStaffDetail__ctaButton catStaffDetail__ctaButton--outline">
            料金・ご利用案内
          </a>
          <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="catStaffDetail__ctaButton catStaffDetail__ctaButton--primary">
            お問い合わせはこちら
          </a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>