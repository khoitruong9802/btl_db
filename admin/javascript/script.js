//employee-user login
const btns = document.querySelectorAll('.pagebtn');
const frames = document.querySelectorAll('.frames');

var frameActive = function (manual) {
  btns.forEach((btn) => {
    btn.classList.remove('active');
  });
  frames.forEach((slide) => {
    slide.classList.remove('active');
  });

  btns[manual].classList.add('active');
  frames[manual].classList.add('active');
  const srcValue = frames[manual].getAttribute('src');
  frames[manual].src = srcValue;
};

btns.forEach((btn, i) => {
  btn.addEventListener('click', () => {
    frameActive(i);
  });
});