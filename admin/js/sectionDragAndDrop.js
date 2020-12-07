const draggableRows = document.querySelectorAll(".draggable");
const dragBoxes = document.querySelectorAll(".dragHere");
const container = document.querySelector(".sections__table");

dragBoxes.forEach((dragBox) => {
  dragBox.ondragstart = () => {
    let draggableRow = dragBox.parentElement.parentElement;
    draggableRow.classList.add("dragging");
  };
  dragBox.ondragend = () => {
    let draggableRow = dragBox.parentElement.parentElement;
    draggableRow.classList.remove("dragging");
  };
});

container.addEventListener("dragover", (e) => {
  e.preventDefault();
  const afterElement = getDragAfterElement(e.clientY);
  const draggable = document.querySelector(".dragging");

  if (afterElement.element) {
    container.insertBefore(draggable, afterElement.element);
  } else {
    container.appendChild(draggable);
  }
});

const getDragAfterElement = (y) => {
  const draggableElements = [
    ...container.querySelectorAll(".draggable:not(.dragging)"),
  ];

  return draggableElements.reduce(
    (closest, child) => {
      const box = child.getBoundingClientRect();
      const offset = y - box.top - box.height / 2;

      if (offset < 0 && offset > closest.offset) {
        return { offset: offset, element: child };
      } else {
        return closest;
      }
    },
    {
      offset: Number.NEGATIVE_INFINITY,
    }
  );
};
