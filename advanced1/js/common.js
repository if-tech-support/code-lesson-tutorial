document.addEventListener("DOMContentLoaded", function () {
	let nav = document.querySelector("header");
	let btn = document.querySelector(".header__toggleBtn");
	let mask = document.querySelector(".header__mask");

	// メニューを開閉する
	btn.addEventListener("click", function () {
		if (!nav.classList.contains("js-open")) {
			nav.classList.add("js-open");
		} else {
			nav.classList.remove("js-open");
		}
	});

	if (!mask) {
		return false;
	}

	// マスクをクリックしてメニューを閉じる
	mask.addEventListener("click", function () {
		nav.classList.remove("js-open");
	});


});
