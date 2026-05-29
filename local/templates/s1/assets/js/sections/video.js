document.addEventListener('DOMContentLoaded', function () {
	var playBtn = document.querySelector(".play_btn");
	var stopBtn = document.querySelector(".stop_btn");
	if (!playBtn || !stopBtn) return;

	var player = playBtn.closest(".player");
	var video = player.querySelector("video");

	playBtn.addEventListener("click", function () {
		player.classList.add("play");
		video.controls = true;
		video.play();
	});

	stopBtn.addEventListener("click", function () {
		player.classList.remove("play");
		video.controls = false;
		video.pause();
		video.load();
	});

	video.addEventListener("ended", function () {
		video.controls = false;
		player.classList.remove("play");
		video.load();
	});
});
