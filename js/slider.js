const slider = document.querySelector(".slider");
const sliderImgContainer = document.querySelector(".slider__imgContainer");
const sliderImages = document.querySelectorAll(".slider__slideImg");
const sliderPrevBtn = document.querySelector(".slider__prevBtn");
const sliderNextBtn = document.querySelector(".slider__nextBtn");

let sliderPosition = 0;

sliderPrevBtn.addEventListener("click", () => {
  clearInterval(changeSliderImage);
  changeSliderPosition(false);
});

sliderNextBtn.addEventListener("click", () => {
  changeSliderPosition(true);
});

const changeSliderPosition = (direction) => {
  if (direction) {
    sliderPosition -= 100;
    if (sliderPosition < -((sliderImages.length - 1) * 100)) {
      sliderPosition = 0;
      sliderImgContainer.style.transition = "none";
    } else {
      sliderImgContainer.style.transition = "all 0.3s ease";
    }
    sliderImgContainer.style.left = `${sliderPosition}%`;
  } else {
    sliderPosition += 100;
    if (sliderPosition > 0) {
      sliderPosition = -((sliderImages.length - 1) * 100);
      sliderImgContainer.style.transition = "none";
    } else {
      sliderImgContainer.style.transition = "all 0.3s ease";
    }
    sliderImgContainer.style.left = `${sliderPosition}%`;
  }
};

document.addEventListener("keydown", (e) => {
  if (e.key === "ArrowRight") {
    changeSliderPosition(true);
  } else if (e.key === "ArrowLeft") {
    changeSliderPosition(false);
    clearInterval(changeSliderImage);
  }
});

const changeSliderImage = setInterval(() => changeSliderPosition(true), 5000);
