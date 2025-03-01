export function initTools() {
  const toolsItems = document.querySelectorAll(".tools-item");

  toolsItems.forEach((item) => {
    const toolsButton = item.querySelector(".tools-btn");
    const toolsOpen = item.querySelector(".tools-open");

    toolsButton.addEventListener("click", () => {
      toolsOpen.classList.toggle("open");
      console.log("User clicked to open skill.");
    });
  });
}
