document.addEventListener("DOMContentLoaded", function () {

	// スムーススクロールを設定
	const scrollLinks = document.querySelectorAll('a[href^="#"]');

	scrollLinks.forEach((link) => {
		link.addEventListener("click", function (e) {
			e.preventDefault();
			const headerHeight = document.querySelector("header").offsetHeight;
			const targetId = this.getAttribute("href");
			const targetElement = document.querySelector(targetId);
			const targetPosition = targetElement.offsetTop - headerHeight;

			if (targetElement) {
				window.scrollTo({
					top: targetPosition,
					behavior: "smooth",
				});
			}
		});
	});

	//トップへ戻るボタンを取得する
	const pageTopBtn = document.getElementById("js-scrollTop");

	// スクロールイベントリスナーを追加
	window.addEventListener("scroll", function () {
		// 現在のスクロール位置を取得
		let scrollPosition = window.scrollY;

		// 特定のスクロール位置に達したかチェックして、トップへ戻るボダンを表示する
		if (scrollPosition > 500) {
			pageTopBtn.style.opacity = "1";
		} else {
			pageTopBtn.style.opacity = "0";
		}

		//フェードインする画像を取得する
		const contents = document.querySelectorAll(".js-fadeIn");
		contents.forEach((el) => {
			const windowHeight = window.innerHeight;
			const elementTop = el.getBoundingClientRect().top;
			const elementBottom = el.getBoundingClientRect().bottom;

			//画像が画面の下に出た時点でフェードインする
			if (elementTop < windowHeight && elementBottom >= 0) {
				el.classList.add("is-scrollIn");
			}
		});
	});

	//トップへ戻るスクロールのアニメーション
	pageTopBtn.addEventListener("click", () => {
		window.scrollTo({
			top: 0,
			behavior: "smooth",
		});
	});
});
