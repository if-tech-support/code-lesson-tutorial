<footer class="footer">
  <div class="footer__inner">
    <nav class="footer__nav" aria-label="フッターナビゲーション">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'footer__menu',
        'fallback_cb' => function () {
          // デフォルトメニュー
          echo '<a href="' . esc_url(get_post_type_archive_link('cat-staff')) . '" class="footer__link">猫スタッフ紹介</a>';
          echo '<a href="' . esc_url(get_post_type_archive_link('news')) . '" class="footer__link">お知らせ</a>';
          echo '<a href="' . esc_url(get_permalink(get_page_by_path('infomation'))) . '" class="footer__link">ご利用案内</a>';
          echo '<a href="' . esc_url(get_permalink(get_page_by_path('contact'))) . '" class="footer__link">お問い合わせ</a>';
        },
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '%3$s',
        'walker' => new class extends Walker_Nav_Menu {
          function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
          {
            $output .= '<a href="' . esc_url($item->url) . '" class="footer__link">' . esc_html($item->title) . '</a>';
          }
        }
      ));
      ?>
    </nav>

    <div class="footer__content">
      <div class="footer__info">
        <div class="footer__logo">
          <img src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>">
        </div>

        <div class="footer__shopInfo">
          <div class="footer__infoLeft">
            <div class="footer__address">
              <p class="footer__infoText">〒150-0001 東京都渋谷区神宮前1-2-3</p>
            </div>
            <div class="footer__phone">
              <span class="footer__infoLabel">TEL:</span>
              <span class="footer__infoText">03-1234-5678</span>
            </div>
            <div class="footer__email">
              <span class="footer__infoLabel">Email:</span>
              <span class="footer__infoText">info@nekonote-cafe.jp</span>
            </div>
          </div>

          <div class="footer__infoRight">
            <div class="footer__schedule">
              <p class="footer__infoText">平日：11:00 - 19:00</p>
              <p class="footer__infoText">土日祝：10:00 - 20:00</p>
              <p class="footer__infoText">定休日：水曜日</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer__copyright">
      <p class="footer__copyrightText">© <?php echo date('Y'); ?> NECOnoTE. All rights reserved.</p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>