const productsRows = document.querySelectorAll(".products");
productsRows.forEach((productsRow) => {
  const productsContainer = productsRow.querySelector(".products__container");
  const productPrevBtn = productsRow.querySelector(".products__prevBtn");
  const productNextBtn = productsRow.querySelector(".products__nextBtn");

  let productsContainerPosition = 0;

  const productsContainerPosition__lastValue =
    -(
      productsRow.querySelectorAll(".products__product").length * 200 -
      window.innerWidth
    ) - 30;

  productPrevBtn.addEventListener("click", () => {
    productsBtnHandler("prev");
  });

  productNextBtn.addEventListener("click", () => {
    productsBtnHandler("next");
  });

  const productsBtnHandler = (btn) => {
    if (btn == "next") {
      productsContainerPosition -= 200;
      if (productsContainerPosition < productsContainerPosition__lastValue) {
        productsContainerPosition = productsContainerPosition__lastValue;
      }
      productsManageButtons();
      productsContainer.style.left = `${productsContainerPosition}px`;
    } else if (btn == "prev") {
      productsContainerPosition += 200;
      if (productsContainerPosition > 0) {
        productsContainerPosition = 0;
      }
      productsManageButtons();
      console.log(productsContainerPosition);
      console.log(productsContainerPosition__lastValue);
      productsContainer.style.left = `${productsContainerPosition}px`;
    }
  };

  const productsManageButtons = () => {
    if (
      productsContainerPosition >= productsContainerPosition__lastValue &&
      productsContainerPosition <= 0
    ) {
      productPrevBtn.style.display = "block";
      productNextBtn.style.display = "block";
    }
    if (productsContainerPosition >= 0) {
      productPrevBtn.style.display = "none";
    }
    if (productsContainerPosition <= productsContainerPosition__lastValue) {
      productNextBtn.style.display = "none";
    }
  };

  productsManageButtons();
});
