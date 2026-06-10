const playBtn = document.querySelector(".play_btn");
const stopBtn = document.querySelector(".stop_btn");

if (playBtn) {
	const player = playBtn.closest(".player");
	const video = player.querySelector("video");
	playBtn.addEventListener("click", (e) => {
		// const player = e.target.closest(".player");
		// const video = player.querySelector("video");
		player.classList.add("play");
		video.controls = true;
		video.play();
	});
	stopBtn.addEventListener("click", (e) => {
		// const player = e.target.closest(".player");
		// const video = player.querySelector("video");
		player.classList.remove("play");
		video.controls = false;
		video.pause();
		video.load();
		// video.currentTime = 0;
	});

	video.addEventListener("ended", () => {
		video.controls = false;
		player.classList.remove("play");
		video.load();
	});
}