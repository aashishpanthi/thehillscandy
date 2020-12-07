const mainSection = document.querySelector(".product__mainSection");
const plus = mainSection.querySelector(".plus");
const minus = mainSection.querySelector(".minus");
const quantityInput = mainSection.querySelector("#quantity");

plus.onclick = () => incrementDecrementQuantity(true);

minus.onclick = () => incrementDecrementQuantity(false);

quantityInput.onchange = () => {
  let quantity = parseInt(quantityInput.value);
  if (quantity > 5) {
    quantityInput.value = 5;
  } else if (quantity < 1) {
    quantityInput.value = 1;
  }
};

const incrementDecrementQuantity = (increment) => {
  let quantity = parseInt(quantityInput.value);
  if (increment) {
    quantityInput.value = quantity < 5 ? quantity + 1 : quantity;
  } else {
    quantityInput.value = quantity > 1 ? quantity - 1 : quantity;
  }
};

const checkQuantity = (value) => {
  if (value >= 1 && value <= 5) {
    return true;
  } else {
    return false;
  }
};

//Image hover zoom
function imageZoom(imgID, resultID) {
  let img, lens, result, cx, cy;
  img = document.getElementById(imgID);
  result = document.getElementById(resultID);
  /* Create lens: */
  lens = document.createElement("DIV");
  lens.setAttribute("class", "img-zoom-lens");
  /* Insert lens: */
  img.parentElement.insertBefore(lens, img);
  /* Calculate the ratio between result DIV and lens: */
  cx = result.offsetWidth / lens.offsetWidth;
  cy = result.offsetHeight / lens.offsetHeight;
  /* Set background properties for the result DIV */
  result.style.backgroundImage = "url('" + img.src + "')";
  result.style.backgroundSize = img.width * cx + "px " + img.height * cy + "px";
  /* Execute a function when someone moves the cursor over the image, or the lens: */
  lens.addEventListener("mousemove", moveLens);
  img.addEventListener("mousemove", moveLens);
  //   /*Remove the div when someone leave the image */
  //   img.addEventListener("mouseleave", alert("mouseleft"));
  /* And also for touch screens: */
  lens.addEventListener("touchmove", moveLens);
  img.addEventListener("touchmove", moveLens);
  function moveLens(e) {
    //   showing the result div
    // result.style.display = "block";
    let pos, x, y;
    /* Prevent any other actions that may occur when moving over the image */
    e.preventDefault();
    /* Get the cursor's x and y positions: */
    pos = getCursorPos(e);
    /* Calculate the position of the lens: */
    x = pos.x - lens.offsetWidth / 2;
    y = pos.y - lens.offsetHeight / 2;
    /* Prevent the lens from being positioned outside the image: */
    if (x > img.width - lens.offsetWidth) {
      x = img.width - lens.offsetWidth;
    }
    if (x < 0) {
      x = 0;
    }
    if (y > img.height - lens.offsetHeight) {
      y = img.height - lens.offsetHeight;
    }
    if (y < 0) {
      y = 0;
    }
    /* Set the position of the lens: */
    lens.style.left = x + "px";
    lens.style.top = y + "px";
    /* Display what the lens "sees": */
    result.style.backgroundPosition = "-" + x * cx + "px -" + y * cy + "px";
  }
  function getCursorPos(e) {
    let a,
      x = 0,
      y = 0;
    e = e || window.event;
    /* Get the x and y positions of the image: */
    a = img.getBoundingClientRect();
    /* Calculate the cursor's x and y coordinates, relative to the image: */
    x = e.pageX - a.left;
    y = e.pageY - a.top;
    /* Consider any page scrolling: */
    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return { x: x, y: y };
  }
}

imageZoom("productImage", "productImageShow");
