// ✅ External config (example). You can set this from anywhere BEFORE slider init runs.
// window.SLIDER_CONFIG = {
//   autoplayMs: 3000,
//   boxAlign: "left", // "left" | "right"
//   displayNavigationPrevNext: true,
//   displayNavigationDots: true
// };

(function () {
  const DEFAULT_CONFIG = {
    autoplayMs: 4000,
    boxAlign: "right",              // "left" | "right"
    displayNavigationPrevNext: true,
    displayNavigationDots: true
  };

  function createSlider(root, config) {
    const track = root.querySelector(".slider__track");
    const slides = Array.from(root.querySelectorAll(".slide"));
    const prevBtn = root.querySelector(".slider__btn--prev");
    const nextBtn = root.querySelector(".slider__btn--next");
    const dotsWrap = root.querySelector(".slider__dots");
    const controlsWrap = root.querySelector(".slider__controls");
    const startBtn = controlsWrap?.querySelector('[data-action="start"]');
    const pauseBtn = controlsWrap?.querySelector('[data-action="pause"]');

    let index = 0;
    let timer = null;
    let isPlaying = false;

    // Apply textbox alignment class
    root.classList.remove("slider--box-left", "slider--box-right");
    root.classList.add(config.boxAlign === "left" ? "slider--box-left" : "slider--box-right");

    // Show/hide navigation controls
    if (prevBtn && nextBtn) {
      const hidePrevNext = !config.displayNavigationPrevNext;
      prevBtn.classList.toggle("is-hidden", hidePrevNext);
      nextBtn.classList.toggle("is-hidden", hidePrevNext);
    }
    if (dotsWrap) dotsWrap.classList.toggle("is-hidden", !config.displayNavigationDots);

    // Build dots (only if enabled)
    let dots = [];
    if (dotsWrap) {
      dotsWrap.innerHTML = "";
      if (config.displayNavigationDots) {
        dots = slides.map((_, i) => {
          const b = document.createElement("button");
          b.type = "button";
          b.className = "slider__dot";
          b.setAttribute("aria-label", `Go to slide ${i + 1}`);
          b.addEventListener("click", () => goTo(i));
          dotsWrap.appendChild(b);
          return b;
        });
      }
    }

    function update() {
      track.style.transform = `translateX(${-index * 100}%)`;
      if (dots.length) {
        dots.forEach((d, i) => d.setAttribute("aria-current", i === index ? "true" : "false"));
      }
    }

    function goTo(i) {
      index = (i + slides.length) % slides.length;
      update();
    }

    function next() {
      goTo(index + 1);
    }

    function prev() {
      goTo(index - 1);
    }

    // Prev/Next handlers (only if enabled)
    if (prevBtn) prevBtn.addEventListener("click", () => {
      prev();
    });
    if (nextBtn) nextBtn.addEventListener("click", () => {
      next();
    });

    // Keyboard support (no mouseover stuff)
    root.tabIndex = 0;
    root.addEventListener("keydown", (e) => {
      if (e.key === "ArrowLeft") prev();
      if (e.key === "ArrowRight") next();
      if (e.key === " ") { // space toggles play/pause
        e.preventDefault();
        isPlaying ? pause() : start();
      }
    });

    // Touch swipe (still allowed; not mouseover)
    let startX = 0;
    let isTouching = false;

    root.addEventListener("touchstart", (e) => {
      isTouching = true;
      startX = e.touches[0].clientX;
    }, {passive: true});

    root.addEventListener("touchend", (e) => {
      if (!isTouching) return;
      isTouching = false;
      const endX = e.changedTouches[0].clientX;
      const diff = endX - startX;
      if (Math.abs(diff) > 40) diff < 0 ? next() : prev();
    }, {passive: true});

    function start() {
      if (!config.autoplayMs || config.autoplayMs <= 0) return;
      if (timer) clearInterval(timer);
      timer = setInterval(next, config.autoplayMs);
      isPlaying = true;
      syncControlState();
    }

    function pause() {
      if (timer) clearInterval(timer);
      timer = null;
      isPlaying = false;
      syncControlState();
    }

    function syncControlState() {
      // Optional UX: disable start if already playing, disable pause if not
      if (startBtn) startBtn.disabled = isPlaying;
      if (pauseBtn) pauseBtn.disabled = !isPlaying;
    }

    // Start/Pause buttons
    if (startBtn) startBtn.addEventListener("click", start);
    if (pauseBtn) pauseBtn.addEventListener("click", pause);

    // init state
    update();
    pause(); // start paused by default
    syncControlState();

    // Expose a small API if you want to control it externally later
    return {start, pause, next, prev, goTo};
  }

  // ---- Init ----
  const root = document.getElementById("heroSlider");
  if (!root) return;

  const external = window.SLIDER_CONFIG || {};
  const config = Object.assign({}, DEFAULT_CONFIG, external);

  window.heroSliderApi = createSlider(root, config);
})();
