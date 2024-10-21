console.log("javascript file is linked");

// VARIABLES

// Header
const toggleButton = document.querySelector("#burger-button")
const navbarLinks = document.querySelector(".links-header")
toggleButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})

// Video Player
const player = new Plyr("#demoreel");

// Testimonials
let testimonialIndex = 0;
const testimonialCards = document.querySelectorAll(".testimonial-card");

function showTestimonial(index) {
  testimonialCards.forEach((card, i) => {
    if (i === testimonialIndex) {
      card.classList.remove("visible"); // Remove the visible class from the default testimonials
    }
  });

  testimonialIndex = (index + testimonialCards.length) % testimonialCards.length;

  const newCard = testimonialCards[testimonialIndex];
  newCard.classList.add("visible"); // Add the visible class to selected testimonial
}

showTestimonial(testimonialIndex); // Show the first testimonial as default

document.querySelector("#test-next-btn").addEventListener("click", () => {
  showTestimonial(testimonialIndex + 1);
});

document.querySelector("#test-prev-btn").addEventListener("click", () => {
  showTestimonial(testimonialIndex - 1);
});