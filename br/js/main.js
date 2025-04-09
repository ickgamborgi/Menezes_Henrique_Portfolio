import { initHeader } from "./modules/header.js";
import { initTestimonials } from "./modules/testimonials.js";
import { initTools } from "./modules/tools.js";
import { initContactForm } from "./modules/contactForm.js";
import { initLoginForm } from "./modules/login.js";
import { initAnimations } from "./modules/animations.js";
import { initFilter } from "./modules/filter.js";
import { initHeroTyping } from "./modules/hero.js";

console.log("javascript file is linked");

const player = new Plyr("#demoreel"); // demoreel video plyr.io

document.addEventListener("DOMContentLoaded", () => {
  initHeader();
  initHeroTyping();
  initTestimonials();
  initTools();
  initContactForm();
  initLoginForm();
  initAnimations();
  initFilter();
});
