console.log("javascript file is linked");

const player = new Plyr("#demoreel"); // demoreel video plyr.io

// Header
(()=> {
const burgerButton = document.querySelector("#burger-button")
const navbarLinks = document.querySelector(".links-header")
burgerButton.addEventListener('click', () => {
    navbarLinks.classList.toggle('active');
    burgerButton.classList.toggle('active');
})
})();

// Testimonials
(() => {
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
})();

// Tools & Skills
(() => {
const toolsItems = document.querySelectorAll('.tools-item');

toolsItems.forEach(item => {
  const toolsButton = item.querySelector('.tools-btn');
  const toolsOpen = item.querySelector('.tools-open');

  toolsButton.addEventListener('click', () => {
    toolsOpen.classList.toggle('open');
    console.log("User clicked to open skill.")
  });
});
})();

// Contact Form
(() => {
  const form = document.querySelector('.form');
  
  form.addEventListener('submit', (event) => {
    console.log("User submitted information on " + form.id) // console log it out
  });
  
})();

// GSAP Animations
