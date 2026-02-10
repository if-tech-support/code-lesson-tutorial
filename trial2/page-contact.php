<?php get_header(); ?>

<main class="main">
  <!-- パンくずリスト -->
  <?php breadcrumb(); ?>

  <!-- お問い合わせセクション -->
  <section class="contact">
    <div class="contact__inner">
      <div class="contact__container">
        <h1 class="contact__title">お問い合わせ</h1>

        <div class="contact__formSection">
          <!-- <form class="contact__form" method="post" action=""> -->
          <div class="contact__form">
            <?php echo do_shortcode('[contact-form-7 id="f18f21c" title="お問い合わせフォーム"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- 波の装飾 -->
  <div class="u-wave">
    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/wave-bottom.svg" alt="" class="u-waveImg u-waveImg--rotate">
  </div>


  <!-- ご支援のお願いセクション -->
  <section class="support">
    <div class="support__inner">
      <div class="support__container">
        <h2 class="support__title">ご支援のお願い</h2>

        <div class="support__text">
          <p>毎年多くの猫たちが、様々な事情で行き場を失っています。</p>
          <p>NECOnoTEは、そんな猫たちに新しい家族との出会いの場を提供したいという想いから生まれました。</p>
          <p>皆様の温かいサポートが、猫たちの幸せな未来を作ります。</p>
          <p>ご支援を心よりお待ちしております。</p>
        </div>

        <div class="support__cards">
          <!-- 物品の寄付カード -->
          <div class="support__card">
            <div class="support__cardContent">
              <div class="support__cardHeader">
                <div class="support__cardHeaderLeft">
                  <div class="support__iconWrapper">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/support-1.svg" alt="支援アイコン1" class="support__icon">
                  </div>
                  <h3 class="support__cardTitle">物品の寄付</h3>
                </div>
              </div>
              <ul class="support__list">
                <li class="support__listItem">キャットフード・おやつ</li>
                <li class="support__listItem">猫砂・トイレ用品</li>
                <li class="support__listItem">おもちゃ・爪とぎ</li>
                <li class="support__listItem">ペットシーツ・タオル</li>
              </ul>
            </div>
          </div>

          <!-- 寄付金カード -->
          <div class="support__card">
            <div class="support__cardContent">
              <div class="support__cardHeader">
                <div class="support__cardHeaderLeft">
                  <div class="support__iconWrapper">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/support-2.svg" alt="支援アイコン2" class="support__icon">
                  </div>
                  <h3 class="support__cardTitle">寄付金</h3>
                </div>
              </div>
              <ul class="support__list">
                <li class="support__listItem">医療費のサポート</li>
                <li class="support__listItem">施設の維持管理費</li>
                <li class="support__listItem">フード・備品の購入費</li>
                <li class="support__listItem">保護活動の運営費</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>