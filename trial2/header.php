<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <header class="header" id="header">
    <div class="header__inner">
      <h1 class="header__logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
        </a>
      </h1>

      <nav class="header__nav" aria-label="メインナビゲーション">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'container' => false,
          'menu_class' => 'header__menu',
          'fallback_cb' => function () {
            // デフォルトメニュー
            echo '<div class="header__menu">';
            echo '<a href="' . esc_url(get_post_type_archive_link('cat-staff')) . '" class="header__link">猫スタッフ紹介</a>';
            echo '<a href="' . esc_url(get_post_type_archive_link('news')) . '" class="header__link">お知らせ</a>';
            echo '<a href="' . esc_url(get_permalink(get_page_by_path('infomation'))) . '" class="header__link">ご利用案内</a>';
            echo '<a href="' . esc_url(get_permalink(get_page_by_path('contact'))) . '" class="header__link">お問い合わせ</a>';
            echo '</div>';
          },
          'link_before' => '',
          'link_after' => '',
          'items_wrap' => '<div class="header__menu">%3$s</div>',
          'walker' => new class extends Walker_Nav_Menu {
            function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
            {
              $output .= '<a href="' . esc_url($item->url) . '" class="header__link">' . esc_html($item->title) . '</a>';
            }
          }
        ));
        ?>
      </nav>

      <button class="header__hamburger" id="js-hamburger" aria-expanded="false" aria-controls="js-nav-sp" aria-label="メニューを開く">
        <span class="hamburger__line"></span>
      </button>

      <button class="header__hamburger header__hamburger--close" id="js-hamburger-close" aria-expanded="false" aria-label="メニューを閉じる">
        <span class="hamburger__line"></span>
      </button>

      <nav class="header__navSp" id="js-nav-sp" aria-label="モバイルナビゲーション">
        <div class="header__navSpInner">
          <div class="header__listSp">
            <?php
            wp_nav_menu(array(
              'theme_location' => 'primary',
              'container' => false,
              'menu_class' => 'header__listSp',
              'fallback_cb' => function () {
                // デフォルトメニュー
                echo '<a href="' . esc_url(get_post_type_archive_link('cat-staff')) . '" class="header__linkSp">猫スタッフ紹介</a>';
                echo '<a href="' . esc_url(get_post_type_archive_link('news')) . '" class="header__linkSp">お知らせ</a>';
                echo '<a href="' . esc_url(get_permalink(get_page_by_path('infomation'))) . '" class="header__linkSp">ご利用案内</a>';
                echo '<a href="' . esc_url(get_permalink(get_page_by_path('contact'))) . '" class="header__linkSp">お問い合わせ</a>';
              },
              'link_before' => '',
              'link_after' => '',
              'items_wrap' => '%3$s',
              'walker' => new class extends Walker_Nav_Menu {
                function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
                {
                  $output .= '<a href="' . esc_url($item->url) . '" class="header__linkSp">' . esc_html($item->title) . '</a>';
                }
              }
            ));
            ?>
          </div>

          <div class="header__contentSp">
            <div class="header__contentCard">
              <div class="header__siteTitle">
                <span class="header__siteTitleText">NECOnoTE</span>
                <span class="header__siteTitleIcon">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/logo.svg" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                </span>
              </div>
              <div class="header__shopInfo">
                <div class="header__shopInfoSection">
                  <div class="header__shopInfoAddress">〒150-0001 東京都渋谷区神宮前1-2-3</div>
                  <div class="header__shopInfoPhone">
                    <span>TEL:</span>
                    <a href="tel:03-1234-5678">03-1234-5678</a>
                  </div>
                  <div class="header__shopInfoEmail">
                    <span>Email:</span>
                    <a href="mailto:info@nekonote-cafe.jp">info@nekonote-cafe.jp</a>
                  </div>
                </div>
                <div class="header__shopInfoSchedule">
                  <div>平日：11:00 - 19:00</div>
                  <div>土日祝：10:00 - 20:00</div>
                  <div>定休日：水曜日</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>