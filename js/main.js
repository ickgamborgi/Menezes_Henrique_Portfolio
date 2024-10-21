console.log("javascript file is linked");

// VARIABLES

// Header
const burgerButton = document.querySelector("#burger-button")
const navbarLinks = document.querySelector(".links-header")
burgerButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active');
    burgerButton.classList.toggle('active');
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

// Contact Form
const form = document.getElementById('newsletterForm');
const popup = document.getElementById('popup');
const popupCloseBtn = document.querySelector('.close-btn');

form.addEventListener('submit', function(event) {
  console.log("User submitted information on " + this.id) // console log it out
  event.preventDefault(); // prevent default behavior from form
  popup.style.display = 'flex'; // show pop-up
  form.reset(); // reset the form
});

popupCloseBtn.addEventListener('click', function() {
  popup.style.display = 'none';
  console.log("User closed subscription confirmation");
}); // when user clicks on close button

window.addEventListener('click', function(event) {
  if (event.target == popup) {
      popup.style.display = 'none';
      console.log("User closed subscription confirmation");
  }
}); // when user clicks outside the popup to close