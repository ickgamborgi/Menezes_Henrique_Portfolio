export function initTestimonials() {
  gsap.registerPlugin(ScrollTrigger);

  let testimonialIndex = 0;
  const testimonialCards = document.querySelectorAll(".testimonial-card");

  function showTestimonial(index) {
    testimonialCards.forEach((card, i) => {
      card.classList.remove("visible");
      gsap.set(card, { x: 0, opacity: 0 });
    });

    testimonialIndex =
      (index + testimonialCards.length) % testimonialCards.length;

    const newCard = testimonialCards[testimonialIndex];
    newCard.classList.add("visible");

    gsap.fromTo(
      newCard,
      { opacity: 0, x: 200 },
      { opacity: 1, x: 0, duration: 1, ease: "power2.out" }
    );
  }

  showTestimonial(testimonialIndex);

  ScrollTrigger.create({
    trigger: ".testimonials",
    start: "top bottom",
    end: "bottom 50%",
    toggleActions: "play none none reset",
    markers: false,
    onEnter: () => {
      showTestimonial(0);
    },
    onLeaveBack: () => {
      testimonialCards.forEach((card) => {
        gsap.set(card, { x: 0, opacity: 0 });
        card.classList.remove("visible");
      });
    },
  });

  document.querySelector("#test-next-btn").addEventListener("click", () => {
    showTestimonial(testimonialIndex + 1);
  });

  document.querySelector("#test-prev-btn").addEventListener("click", () => {
    showTestimonial(testimonialIndex - 1);
  });
}
