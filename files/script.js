const carouselItems = document.querySelector(".carousel__items");
const buttonPrev = document.querySelector(".carousel__button--prev");
const buttonNext = document.querySelector(".carousel__button--next");

let currentIndex = 0;
let itemsToShow = getItemsToShow(); // Get the initial number of items to show
const totalItems = document.querySelectorAll(".carousel__item").length;
let itemWidth = 100 / itemsToShow; // Percentage width for each item

// Function to determine how many items to show based on the screen width
function getItemsToShow() {
  const screenWidth = window.innerWidth;
  if (screenWidth >= 1024) return 4; // Desktop
  if (screenWidth >= 768) return 2; // Tablet
  return 1; // Mobile
}

// Update the item width and the current index on window resize
window.addEventListener("resize", () => {
  itemsToShow = getItemsToShow();
  itemWidth = 100 / itemsToShow;
  currentIndex = Math.min(currentIndex, totalItems - itemsToShow); // Adjust currentIndex if needed
  carouselItems.style.transform = `translateX(-${currentIndex * itemWidth}%)`;
});

// Next button event listener
buttonNext.addEventListener("click", () => {
  if (currentIndex < totalItems - itemsToShow) {
    currentIndex++;
  } else {
    currentIndex = 0; // Reset to first item when reaching the end
  }
  carouselItems.style.transform = `translateX(-${currentIndex * itemWidth}%)`;
});

// Previous button event listener
buttonPrev.addEventListener("click", () => {
  if (currentIndex > 0) {
    currentIndex--;
  } else {
    currentIndex = totalItems - itemsToShow; // Go to last set of items
  }
  carouselItems.style.transform = `translateX(-${currentIndex * itemWidth}%)`;
});

function validateForm() {
  const inputs = document.querySelectorAll(".borrow-form__input");
  for (let input of inputs) {
    if (!input.checkValidity()) {
      alert(input.title);
      input.focus();
      return false;
    }
  }
  return true;
}
