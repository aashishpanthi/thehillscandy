async function httpGetAsync(url, callback) {
  const xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function () {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
      callback(xmlHttp.responseText);
  };
  xmlHttp.open("GET", url, true); // true for asynchronous
  xmlHttp.send(null);
}

const search__optionsDiv = document.querySelector(".search__options");
const reunAfterFetch = (list) => {
  let opt = JSON.parse(list);

  let address = {};
  opt.forEach((v) => {
    let span = document.createElement("span");
    span.textContent = v.name;
    span.className = "search__optionsBox";
    search__optionsDiv.appendChild(span);
  });

  let searchOptionsBoxes = document.querySelectorAll(".search__optionsBox");
  searchOptionsBoxes.forEach((item, index) => {
    item.onclick = () => {
      //Adding directory
      addressBar(item);

      //Adding region on address
      address["country"] = item.textContent;

      //Changing placeholder
      document.querySelector(".search__input").placeholder = "Select state";

      //Deleting exixting options
      search__optionsDiv.innerHTML = "";

      //Changing options
      opt[index].states.forEach((v, i) => {
        let span = document.createElement("span");
        span.textContent = v.name;
        span.className = "search__optionsBox";
        search__optionsDiv.appendChild(span);
      });

      searchOptionsBoxes = document.querySelectorAll(".search__optionsBox");
      if (searchOptionsBoxes.length === 0) {
        finalTask(address, false);
      } else {
        searchOptionsBoxes.forEach((state) => {
          state.onclick = () => {
            //Adding directory
            addressBar(state);

            //Adding state on address
            address["state"] = state.textContent;
            finalTask(address, true);
          };
        });
      }
    };
  });
};

const filterOut = (e) => {
  let query = e.value.toLowerCase();
  let span = search__optionsDiv.getElementsByTagName("span");

  for (let i = 0; i < span.length; i++) {
    const optValue = span[i].textContent.toLowerCase();
    if (optValue.indexOf(query) > -1) {
      span[i].style.display = "block";
      setTimeout(() => {
        span[i].style.transform = "scaleY(1)";
      }, 250);
    } else {
      span[i].style.transform = "scaleY(0)";
      setTimeout(() => {
        span[i].style.display = "none";
      }, 250);
    }
  }
};

const addressBar = (item) => {
  let span = document.createElement("span");
  span.textContent = item.textContent;
  span.className = "search__dirList";
  document.querySelector(".search__dir").appendChild(span);
};

const finalTask = (address, statePresence) => {
  document.querySelector(".search__container").style.display = "none";
  document.querySelector(".delivery__locationAddress").innerHTML = `${
    address.country
  }  ${statePresence ? "," + address.state : ""}`;
  document.querySelector(".search__options").innerHTML = "";

  document.querySelector(".search__dir").innerHTML = "";
  document.querySelector(".delivery__locationChange").innerHTML =
    "Change Address";
};

const showFilter = () => {
  document.querySelector(".search__container").style.display = "block";
  httpGetAsync(
    "https://raw.githubusercontent.com/stefanbinder/countries-states/master/countries.json",
    (res) => {
      reunAfterFetch(res);
    }
  );
};

const closeFilter = () => {
  document.addEventListener("mouseup", function (e) {
    const container = document.querySelector(".search__container");
    if (!container.contains(e.target)) {
      container.style.display = "none";
    }
  });
};

closeFilter();
