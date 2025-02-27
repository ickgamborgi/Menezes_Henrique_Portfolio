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
  gsap.registerPlugin(ScrollTrigger);

  let testimonialIndex = 0;
  const testimonialCards = document.querySelectorAll(".testimonial-card");

  function showTestimonial(index) {
    testimonialCards.forEach((card, i) => {
      card.classList.remove("visible");
      gsap.set(card, { x: 0, opacity: 0 });
    });

    testimonialIndex = (index + testimonialCards.length) % testimonialCards.length;

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
      testimonialCards.forEach(card => {
        gsap.set(card, { x: 0, opacity: 0 });
        card.classList.remove("visible");
      });
    }
  });

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
const form = document.querySelector(".form");
const feedback = document.querySelector("#feedback");

feedback.classList.add("hidden");

function regForm(event) {
    event.preventDefault();
    feedback.classList.remove("hidden");
    feedback.innerHTML = "";

    const thisform = event.currentTarget;
    const url = "sendmail.php";
    const formdata = new URLSearchParams(new FormData(thisform)).toString();

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: formdata
    })
    .then(response => response.json())
    .then(response => {
        feedback.classList.remove("success", "error");

        if (response.errors) {
            response.errors.forEach(error => {
                const errorElement = document.createElement("p");
                errorElement.textContent = error;
                errorElement.classList.add("error");
                const icon = document.createElement("i");
                icon.classList.add("fas", "fa-exclamation-circle");
                errorElement.prepend(icon);
                feedback.appendChild(errorElement);
            });
        } else {
            form.reset();
            const messageElement = document.createElement("p");
            messageElement.textContent = response.message;
            messageElement.classList.add("success");
            const icon = document.createElement("i");
            icon.classList.add("fas", "fa-check-circle");
            messageElement.prepend(icon);
            feedback.appendChild(messageElement);
        }

        feedback.scrollIntoView({ behavior: 'smooth', block: 'end' });
    })
    .catch(error => {
      feedback.classList.add("error");
        feedback.innerHTML = "<p>Sorry, something went wrong. Please, check your internet connection or if your browser is updated</p>";
    });
}

form.addEventListener("submit", regForm);
  
form.addEventListener('submit', (event) => {
  console.log("User submitted information on " + form.id) // console log it out
});
  
})();

// GSAP Animations
(() => {
  gsap.registerPlugin(ScrollTrigger);

  gsap.from(".hero-image", 2, {
    scrollTrigger: {
      trigger: ".home-hero",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    delay: .2,
    ease: "ease2.in",
  });

  gsap.from(".hero-bio", {
    scrollTrigger: {
      trigger: ".home-hero",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    x: 200,
    duration: 1,
    ease: "power2.out",
  });

  gsap.from(".intro-text", {
    scrollTrigger: {
      trigger: ".intro-text",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    x: 200,
    duration: 1,
    ease: "power2.out",
  });

  gsap.utils.toArray(".portfolio-item").forEach((item) => {
    gsap.from(item.querySelector(".portfolio-item-info"), {
      scrollTrigger: {
        trigger: item,
        start: "top bottom",
        end: "bottom 50%",
        toggleActions: "play none none reset",
        markers: false,
      },
      opacity: 0,
      x: 200,
      duration: 1,
      ease: "power2.out",
    });
  });

  gsap.from(".portfolio-item a", {
    scrollTrigger: {
      trigger: ".project-thumb",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    scale: 0.5,
    stagger: .15,
    ease: "power2.out",
  });

  gsap.to(".hero-social-media a", {
    scrollTrigger: {
      trigger: ".hero-social-media",
      start: "top 80%",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 1,
    y: -40,
    ease: "ease2.in",
    stagger: .1,
    delay: .25
  });

  gsap.from(".tools-item", {
    scrollTrigger: {
      trigger: ".tools-item",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    duration: 1,
    opacity: 0,
    x: 50,
    stagger: .2,
    ease: "power2.out",
  });

  gsap.from(".footer-social-media a", {
    scrollTrigger: {
      trigger: "footer",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    y: -50,
    ease: "bounce2.out",
    stagger: .1,
  });

  gsap.from(".resume", {
    scrollTrigger: {
      trigger: "footer",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    duration: 1,
    delay: .1,
    opacity: 0,
    x: 50,
    ease: "power2.out",
  });

  gsap.from(".subtitle-wrap", {
    scrollTrigger: {
      trigger: ".subtitle-wrap",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    duration: 1,
    x: 50,
    ease: "power2.out",
    stagger: .2,
  });

  gsap.from(".hobbies-list h5", {
    scrollTrigger: {
      trigger: ".hobbies-list",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    x: 50,
    ease: "power2.out",
    stagger: .2,
  });

  gsap.from(".project-thank img", {
    scrollTrigger: {
      trigger: ".project-thank",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    scale: .5,
    duration: 1,
    ease: "power2.out",
  });

  gsap.from("#contact-form h4", {
    scrollTrigger: {
      trigger: "#contact-form",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    x: 50,
    duration: 1,
    ease: "power2.out",
  });

  gsap.from("#contact-form p", {
    scrollTrigger: {
      trigger: "#contact-form",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    x: 50,
    duration: 1,
    delay: .2,
    ease: "power2.out",
  });

  gsap.from(".project-media-con img", {
    scrollTrigger: {
      trigger: ".project-media-con img",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none none",
      markers: false,
    },
    opacity: 0,
    y: 100,
    duration: 1,
    stagger: .2,
    ease: "power2.out",
  });

  gsap.from(".bio-image p", {
    scrollTrigger: {
      trigger: ".bio-image p",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    duration: 1,
    opacity: 0,
    x: 50,
    stagger: .2,
    ease: "power2.out",
  });

})();
