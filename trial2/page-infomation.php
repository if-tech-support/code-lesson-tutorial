<?php get_header(); ?>

<main class="main">
  <!-- パンくずリスト -->
  <?php breadcrumb(); ?>

  <!-- ご利用案内セクション -->
  <section class="information">
    <div class="information__inner">
      <div class="information__container">
        <h1 class="information__title">ご利用案内</h1>

        <!-- 料金カード -->
        <div class="information__card information__card--pricing">
          <div class="information__cardTitle">料金（1時間あたり）</div>
          <div class="information__cardContent">
            <div class="information__priceList">
              <div class="information__priceItem">
                <div class="information__priceTitle">一般</div>
                <div class="information__price">1,100円</div>
              </div>
              <div class="information__priceItem">
                <div class="information__priceTitle">小学生以下</div>
                <div class="information__price">600円</div>
              </div>
              <div class="information__priceItem">
                <div class="information__priceTitle">延長（15分毎）</div>
                <div class="information__price">200円</div>
              </div>
            </div>

            <div class="information__notes">
              <div class="information__note">
                <span class="information__noteMark">※</span>
                <p class="information__noteText">表記価格はすべて税込みです。</p>
              </div>
              <div class="information__note">
                <span class="information__noteMark">※</span>
                <p class="information__noteText">1ドリンク付き。おかわりは1杯250円です</p>
              </div>
              <div class="information__note">
                <span class="information__noteMark">※</span>
                <p class="information__noteText">延長料金は、年齢に関係なく15分ごとに200円です</p>
              </div>
              <div class="information__note">
                <span class="information__noteMark">※</span>
                <p class="information__noteText">お支払いは退店時、現金でお願いします</p>
              </div>
            </div>
          </div>
        </div>

        <!-- ルールカード -->
        <div class="information__card information__card--rules">
          <div class="information__cardTitle">ご利用のルール・お願い</div>
          <div class="information__cardContent">
            <div class="information__rulesGrid">
              <div class="information__rule">
                <div class="information__ruleHeader">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/circle-check.svg" alt="チェックマーク" class="information__ruleIcon">
                  <h3 class="information__ruleTitle">猫を追いかけない</h3>
                </div>
                <p class="information__ruleText">猫たちのペースを尊重してください</p>
              </div>
              <div class="information__rule">
                <div class="information__ruleHeader">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/circle-check.svg" alt="チェックマーク" class="information__ruleIcon">
                  <h3 class="information__ruleTitle">フラッシュ撮影禁止</h3>
                </div>
                <p class="information__ruleText">写真撮影はOKですが、フラッシュはご遠慮ください</p>
              </div>
              <div class="information__rule">
                <div class="information__ruleHeader">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/circle-check.svg" alt="チェックマーク" class="information__ruleIcon">
                  <h3 class="information__ruleTitle">寝ている猫はそっと</h3>
                </div>
                <p class="information__ruleText">寝ている猫を無理に起こさないでください</p>
              </div>
              <div class="information__rule">
                <div class="information__ruleHeader">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/circle-check.svg" alt="チェックマーク" class="information__ruleIcon">
                  <h3 class="information__ruleTitle">大きな音を立てない</h3>
                </div>
                <p class="information__ruleText">猫が驚かないよう、静かにお過ごしください</p>
              </div>
              <div class="information__rule">
                <div class="information__ruleHeader">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/circle-check.svg" alt="チェックマーク" class="information__ruleIcon">
                  <h3 class="information__ruleTitle">おやつは指示に従って</h3>
                </div>
                <p class="information__ruleText">おやつはスタッフの指示に従ってあげてください</p>
              </div>
              <div class="information__rule">
                <div class="information__ruleHeader">
                  <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/circle-check.svg" alt="チェックマーク" class="information__ruleIcon">
                  <h3 class="information__ruleTitle">飲食物の持ち込み禁止</h3>
                </div>
                <p class="information__ruleText">店内での飲食物の持ち込みはご遠慮ください</p>
              </div>
            </div>
          </div>
        </div>

        <!-- FAQカード -->
        <div class="information__card information__card--faq">
          <div class="information__cardTitle">よくある質問</div>
          <div class="information__cardContent">
            <div class="information__faqList">
              <?php
              // ACFのカスタムフィールドからFAQを取得
              if (function_exists('get_field')) {
                $question1 = get_field('question1');
                $answer1 = get_field('answer1');
                $question2 = get_field('question2');
                $answer2 = get_field('answer2');
                $question3 = get_field('question3');
                $answer3 = get_field('answer3');
              }
              ?>

              <!-- FAQ 1 -->
              <?php if (!empty($question1) && !empty($answer1)) : ?>
                <div class="information__faqItem">
                  <div class="information__faqQuestion">
                    <div class="information__faqQuestionText">
                      <span class="information__faqIcon information__faqIcon--q">Q</span>
                      <p class="information__faqQuestionTitle"><?php echo esc_html($question1); ?></p>
                    </div>
                    <span class="information__faqChevron"></span>
                  </div>
                  <div class="information__faqAnswer">
                    <span class="information__faqIcon information__faqIcon--a">A</span>
                    <p class="information__faqAnswerText"><?php echo esc_html($answer1); ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <!-- FAQ 2 -->
              <?php if (!empty($question2) && !empty($answer2)) : ?>
                <div class="information__faqItem">
                  <div class="information__faqQuestion">
                    <div class="information__faqQuestionText">
                      <span class="information__faqIcon information__faqIcon--q">Q</span>
                      <p class="information__faqQuestionTitle"><?php echo esc_html($question2); ?></p>
                    </div>
                    <span class="information__faqChevron"></span>
                  </div>
                  <div class="information__faqAnswer">
                    <span class="information__faqIcon information__faqIcon--a">A</span>
                    <p class="information__faqAnswerText"><?php echo esc_html($answer2); ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <!-- FAQ 3 -->
              <?php if (!empty($question3) && !empty($answer3)) : ?>
                <div class="information__faqItem">
                  <div class="information__faqQuestion">
                    <div class="information__faqQuestionText">
                      <span class="information__faqIcon information__faqIcon--q">Q</span>
                      <p class="information__faqQuestionTitle"><?php echo esc_html($question3); ?></p>
                    </div>
                    <span class="information__faqChevron"></span>
                  </div>
                  <div class="information__faqAnswer">
                    <span class="information__faqIcon information__faqIcon--a">A</span>
                    <p class="information__faqAnswerText"><?php echo esc_html($answer3); ?></p>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>