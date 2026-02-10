<?php
/*=================================================
テーマのセットアップ
===================================================*/
function cat_cafe_setup()
{
  // タイトルタグのサポート
  add_theme_support('title-tag');

  // アイキャッチ画像のサポート
  add_theme_support('post-thumbnails');

  // HTML5マークアップのサポート
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));

  // カスタムロゴのサポート
  add_theme_support('custom-logo', array(
    'height'      => 21,
    'width'       => 155,
    'flex-height' => true,
    'flex-width'  => true,
  ));

  // ナビゲーションメニューの登録
  register_nav_menus(array(
    'primary' => 'メインナビゲーション',
    'footer'  => 'フッターナビゲーション',
  ));
}
add_action('after_setup_theme', 'cat_cafe_setup');

/**
 * スタイルシートとスクリプトのエンキュー
 */
function cat_cafe_scripts()
{
  // destyle.css（リセットCSS）
  wp_enqueue_style(
    'destyle',
    'https://cdn.jsdelivr.net/npm/destyle.css@1.0.15/destyle.css',
    array(),
    '1.0.15'
  );


  // Swiper CSS
  wp_enqueue_style(
    'swiper',
    'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css',
    array(),
    '8.0.0'
  );

  // Google Fonts
  wp_enqueue_style(
    'cat-cafe-google-fonts',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Zen+Maru+Gothic:wght@400;700&family=Baloo:wght@400&display=swap',
    array(),
    null
  );

  // メインスタイルシート
  wp_enqueue_style(
    'cat-cafe-style',
    get_template_directory_uri() . '/css/style.css',
    array('destyle', 'swiper', 'cat-cafe-google-fonts'),
    '1.0.0'
  );

  // Swiper JS
  wp_enqueue_script(
    'swiper',
    'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js',
    array(),
    '8.0.0',
    true
  );

  // カスタムスクリプト
  wp_enqueue_script(
    'cat-cafe-script',
    get_template_directory_uri() . '/js/script.js',
    array('swiper'),
    '1.0.0',
    true
  );
}
add_action('wp_enqueue_scripts', 'cat_cafe_scripts');

/*=================================================
リソースヒント（preconnect）の追加
===================================================*/
function cat_cafe_resource_hints($urls, $relation_type)
{
  if ('preconnect' === $relation_type) {
    $urls[] = array(
      'href' => 'https://fonts.googleapis.com',
    );
    $urls[] = array(
      'href'        => 'https://fonts.gstatic.com',
      'crossorigin' => true,
    );
  }
  return $urls;
}
add_filter('wp_resource_hints', 'cat_cafe_resource_hints', 10, 2);

/*=================================================
Faviconの出力
===================================================*/
function cat_cafe_favicon()
{
  $favicon_url = get_template_directory_uri() . '/images/favicon.ico';
  if (empty($favicon_url)) {
    return;
  }
  echo '<link rel="icon" type="image/x-icon" href="' . esc_url($favicon_url) . '">' . "\n";
}
add_action('wp_head', 'cat_cafe_favicon', 1);

/*=================================================
絵文字変換を無効化（♂・♀アイコンをテキストとして表示するため）
===================================================*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

add_filter('emoji_svg_url', '__return_false');
add_filter('option_use_smilies', '__return_false');
/*=================================================
パンくずリストの生成
===================================================*/
function breadcrumb()
{
  $home = '<a href="' . esc_url(home_url('/')) . '">TOP</a>';
  $sep  = ' <span class="breadcrumb__separator">＞</span> ';

  echo '<div class="breadcrumb">';
  echo '  <div class="breadcrumb__inner">';

  // ★ breadcrumb__list はここで1回だけ出す（deepは条件付与）
  echo '    <div class="breadcrumb__list';
  if (is_singular('news') || is_singular('cat-staff')) {
    echo ' breadcrumb__list--deep';
  }
  echo '">';

  // トップページの場合
  if (is_front_page()) {
    echo '<span class="breadcrumb__current">TOP</span>';
  } else {
    echo $home;
  }

  // 固定ページの場合
  if (is_page()) {
    echo $sep;
    echo '<span class="breadcrumb__current">' . esc_html(get_the_title()) . '</span>';
  }

  // カスタム投稿タイプのアーカイブページ
  if (is_post_type_archive('cat-staff')) {
    echo $sep;
    echo '<span class="breadcrumb__current">猫スタッフ紹介</span>';
  }

  if (is_post_type_archive('news')) {
    echo $sep;
    echo '<span class="breadcrumb__current">お知らせ</span>';
  }

  // カスタム投稿タイプの個別ページ
  if (is_singular('cat-staff')) {
    echo $sep;
    echo '<a href="' . esc_url(get_post_type_archive_link('cat-staff')) . '" class="breadcrumb__link">猫スタッフ紹介</a>';
    echo $sep;
    echo '<span class="breadcrumb__current">' . esc_html(get_the_title()) . '</span>';
  }

  if (is_singular('news')) {
    echo $sep;
    echo '<a href="' . esc_url(get_post_type_archive_link('news')) . '" class="breadcrumb__link">お知らせ</a>';
    echo $sep;
    echo '<span class="breadcrumb__current">' . esc_html(get_the_title()) . '</span>';
  }

  echo '</div>'; // .breadcrumb__list
  echo '</div>';   // .breadcrumb__inner
  echo '</div>';     // .breadcrumb
}

/*=================================================
投稿画面の設定（おすすめ設定）
===================================================*/
function my_tiny_mce_before_init($init_array)
{
  //グローバル変数の宣言
  global $allowedposttags;
  //エディタのビジュアル/テキスト切替でコード消滅を防止（自動整形無効化）
  $init_array['valid_elements']          = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';
  //aタグ内ですべてのタグを使用可能に
  $init_array['valid_children']          = '+a[' . implode('|', array_keys($allowedposttags)) . ']';
  $init_array['indent']                  = true;
  //pタグの自動挿入を無効化
  $init_array['wpautop']                 = false;
  $init_array['force_p_newlines']        = false;
  //改行をbrタグに置き換える
  $init_array['force_br_newlines']       = true;
  $init_array['forced_root_block']       = '';
  return $init_array;
}
add_filter('tiny_mce_before_init', 'my_tiny_mce_before_init');
