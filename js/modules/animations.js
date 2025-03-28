export function initAnimations() {
  gsap.registerPlugin(ScrollTrigger);

  // all gsap animations

  gsap.from(".hero-image", 1, {
    scrollTrigger: {
      trigger: ".home-hero",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    y: -50,
    ease: "ease2.inOut",
  });

  gsap.from(".hero-circle", 1, {
    scrollTrigger: {
      trigger: ".home-hero",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
    scale: 0,
    y: 50,
    delay: 0.2,
    ease: "power.inOut",
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
    duration: 2,
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

  gsap.to(".hero-social-media a", 0.5, {
    scrollTrigger: {
      trigger: ".hero-social-media",
      start: "top 80%",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 1,
    ease: "ease2.inOut",
    stagger: 0.2,
    y: -25,
    delay: 0.25,
  });

  const mugTimeline = gsap.timeline({ repeat: -1, repeatDelay: 1 });

  mugTimeline.to(".mug-image", {
    y: 25,
    x: 10,
    rotation: 30,
    duration: 3,
    ease: "power2.inOut",
    yoyo: true,
  });

  mugTimeline.to(".mug-image", {
    x: 0,
    y: 0,
    rotation: 0,
    duration: 1,
    ease: "power2.inOut",
    yoyo: true,
  });

  gsap.from(".tag", {
    scrollTrigger: {
      trigger: ".portfolio-tags",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    opacity: 0,
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
    stagger: 0.2,
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
    stagger: 0.1,
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
    delay: 0.1,
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
    stagger: 0.2,
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
    stagger: 0.2,
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
    scale: 0.5,
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
    delay: 0.2,
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
    stagger: 0.2,
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
    stagger: 0.2,
    ease: "power2.out",
  });

  gsap.from(".service-con", {
    scrollTrigger: {
      trigger: ".services",
      start: "top bottom",
      end: "bottom 50%",
      toggleActions: "play none none reset",
      markers: false,
    },
    duration: 2,
    opacity: 0,
    y: 50,
    stagger: 0.2,
    ease: "power2.out",
  });
}
