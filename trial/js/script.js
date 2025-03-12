document.addEventListener("DOMContentLoaded", () => {
  //ヘッダーリンクのアクティブ表示
  const sections = document.querySelectorAll("section");
  const headerLinks = document.querySelectorAll(".header__link");

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          headerLinks.forEach((headerLink) =>
            headerLink.classList.remove("is-active")
          );
          const activeLink = document.querySelector(
            `.header__link[href="#${entry.target.id}"]`
          );
          if (activeLink) {
            activeLink.classList.add("is-active");
          }
        }
      });
    },
    { rootMargin: "-50% 0px -50% 0px", threshold: 0 }
  );

  sections.forEach((section) => observer.observe(section));

  //ハンバーガーメニューの開閉
  const jsHamburger = document.getElementById("js-hamburger");
  const jsGlobalMenu = document.getElementById("js-global-menu");
  const toggleMenu = () => {
    const isExpanded = jsHamburger.getAttribute("aria-expanded") === "true";
    jsHamburger.setAttribute("aria-expanded", !isExpanded);
    jsGlobalMenu.classList.toggle("is-active");
  };
  jsHamburger.addEventListener("click", toggleMenu);

  const jsMenuLink = document.querySelectorAll(".header__link--sp");
  jsMenuLink.forEach((link) => {
    link.addEventListener("click", () => {
      if (jsGlobalMenu.classList.contains("is-active")) {
        toggleMenu();
      }
    });
  });

  //スライダー（splide）
  const pickUpSplide = new Splide(".pickUp__splide", {
    autoplay: true, // 自動再生
    type: "loop", // ループ
    interval: 2000, // 自動再生の間隔
    speed: 2000, // スライダーの移動時間
    perPage: 3, // スライドの表示枚数
    focus: 0, // ページネーション数がスライド数になる
    perMove: 1,
    gap: 40,
    pagination: true, // デフォルトのページネーションを表示
    arrows: false, // 矢印を表示しない
    breakpoints: {
      1080: {
        perPage: 1,
        perMove: 1,
        gap: 24,
        padding: "18%",
      },
    },
  });

  pickUpSplide.mount();

  //タブメニューを切り替える処理
  const planTabs = document.querySelectorAll(".plan__tabTitle");
  planTabs.forEach((planTab) => {
    planTab.addEventListener("click", (e) => {
      document
        .querySelector(".plan__tabTitle.is-active")
        ?.classList.remove("is-active");
      document
        .querySelector(".plan__tabItem.is-active")
        ?.classList.remove("is-active");
      e.currentTarget.classList.add("is-active");
      document
        .getElementById(e.currentTarget.getAttribute("data-target"))
        .classList.add("is-active");
    });
  });

  //モーダルの開閉
  const gridImgs = document.querySelectorAll(".gallery__img");
  const galleryModal = document.getElementById("gallery-modal");

  const closeModal = () => {
    galleryModal.classList.remove("is-active");
    document.body.classList.remove("modal-open");
  };

  gridImgs.forEach((gridImg) => {
    gridImg.addEventListener("click", function () {
      document.getElementById("gallery-modal-img").src =
        this.querySelector("img").src;
      galleryModal.classList.add("is-active");
      document.body.classList.add("modal-open");
    });
  });

  document
    .querySelector(".gallery__modalBtn")
    .addEventListener("click", closeModal);

  galleryModal.addEventListener("click", (e) => {
    if (e.target === galleryModal) closeModal();
  });
});
