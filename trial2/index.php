<?php get_header(); ?>

<main class="main">
  <section class="error404">
    <div class="error404__inner">
      <div class="error404__content">
        <h1 class="error404__title">コンテンツが見つかりませんでした</h1>
        <p class="error404__description">お探しのページは存在しないか、移動または削除された可能性があります。</p>
        <div class="error404__button">
          <a href="<?php echo esc_url(home_url('/')); ?>" class="u-button">TOPページに戻る</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>