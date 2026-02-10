document.addEventListener('DOMContentLoaded', function() {
  // 猫スタッフスライダーの初期化
  const catStaffSwiperEl = document.querySelector('.catStaff__list');
  if (catStaffSwiperEl) {
    const catStaffSwiper = new Swiper('.catStaff__list', {
      slidesPerView: 'auto',
      spaceBetween: 24,
      loop: true,
      speed: 1000,
      centeredSlides: true, // スライドを中央に配置（1番目が真ん中に来る）
      initialSlide: 0, // 1番目（インデックス0）を初期位置に設定
      loopPreventsSliding: false, // ループ時のスライド防止を無効化
      breakpoints: {
        768: {
          slidesPerView: 'auto',
          spaceBetween: 24,
          centeredSlides: true,
        },
        1024: {
          slidesPerView: 'auto',
          spaceBetween: 24,
          centeredSlides: true,
        },
      },
    });
  }

  // FAQアコーディオンの初期化
  const faqItems = document.querySelectorAll('.information__faqItem');

  faqItems.forEach(function(item) {
    const question = item.querySelector('.information__faqQuestion');
    const answer = item.querySelector('.information__faqAnswer');

    if (question && answer) {
      // 初期状態では回答を非表示
      answer.style.display = 'none';

      // アコーディオンの開閉処理
      function toggleAccordion() {
        const isOpen = item.classList.contains('is-open');

        if (isOpen) {
          item.classList.remove('is-open');
          answer.style.display = 'none';
        } else {
          // 他のFAQを閉じる
          faqItems.forEach(function(otherItem) {
            if (otherItem !== item) {
              otherItem.classList.remove('is-open');
              const otherAnswer = otherItem.querySelector('.information__faqAnswer');
              if (otherAnswer) {
                otherAnswer.style.display = 'none';
              }
            }
          });

          item.classList.add('is-open');
          answer.style.display = 'flex';
        }
      }

      // 質問部分のクリックイベント
      question.addEventListener('click', toggleAccordion);

      // 回答部分のクリックイベント（開いている時のみ閉じる）
      answer.addEventListener('click', function() {
        if (item.classList.contains('is-open')) {
          item.classList.remove('is-open');
          answer.style.display = 'none';
        }
      });
    }
  });

  // ハンバーガーメニューの開閉
  const hamburger = document.getElementById('js-hamburger');
  const hamburgerClose = document.getElementById('js-hamburger-close');
  const navSp = document.getElementById('js-nav-sp');

  function openMenu(e) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    if (hamburger) {
      hamburger.setAttribute('aria-expanded', 'true');
      hamburger.classList.add('is-hidden');
    }
    if (hamburgerClose) {
      hamburgerClose.setAttribute('aria-expanded', 'true');
      hamburgerClose.classList.add('is-active');
    }
    if (navSp) {
      navSp.classList.add('is-active');
    }
  }

  function closeMenu(e) {
    if (e) {
      e.preventDefault();
      e.stopPropagation();
    }
    if (hamburger) {
      hamburger.setAttribute('aria-expanded', 'false');
      hamburger.classList.remove('is-hidden');
    }
    if (hamburgerClose) {
      hamburgerClose.setAttribute('aria-expanded', 'false');
      hamburgerClose.classList.remove('is-active');
    }
    if (navSp) {
      navSp.classList.remove('is-active');
    }
  }

  if (hamburger) {
    hamburger.addEventListener('click', openMenu);
  }

  if (hamburgerClose) {
    hamburgerClose.addEventListener('click', function(e) {
      console.log('Close button clicked');
      closeMenu(e);
    });
    // タッチイベントも追加（モバイル対応）
    hamburgerClose.addEventListener('touchend', function(e) {
      e.preventDefault();
      console.log('Close button touched');
      closeMenu(e);
    });
  }

  // メニューリンクをクリックしたら閉じる（リンクの遷移は許可）
  if (navSp) {
    const links = navSp.querySelectorAll('.header__linkSp');
    links.forEach(function(link) {
      link.addEventListener('click', function(e) {
        // preventDefaultは呼ばない（リンクの遷移を許可）
        // メニューを閉じる処理のみ実行
        if (hamburger) {
          hamburger.setAttribute('aria-expanded', 'false');
          hamburger.classList.remove('is-hidden');
        }
        if (hamburgerClose) {
          hamburgerClose.setAttribute('aria-expanded', 'false');
          hamburgerClose.classList.remove('is-active');
        }
        if (navSp) {
          navSp.classList.remove('is-active');
        }
        document.body.style.overflow = '';
      });
    });
  }

  // メニュー内の背景（リンク以外）をクリックしたら閉じる
  if (navSp) {
    navSp.addEventListener('click', function(e) {
      // リンクをクリックした場合は何もしない（リンクの遷移を許可）
      if (e.target.classList.contains('header__linkSp') || e.target.closest('.header__linkSp')) {
        return;
      }
      // リンク以外をクリックした場合のみ閉じる
      closeMenu(e);
    });
  }
});
