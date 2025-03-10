import { initHeader } from "./modules/header.js";
import { initTestimonials } from "./modules/testimonials.js";
import { initTools } from "./modules/tools.js";
import { initContactForm } from "./modules/contactForm.js";
import { initAnimations } from "./modules/animations.js";
import { initLoginForm } from "./modules/login.js"; // Import login.js

console.log("javascript file is linked");

const player = new Plyr("#demoreel"); // demoreel video plyr.io

initHeader();
initTestimonials();
initTools();
initContactForm();
initAnimations();
initLoginForm(); // Initialize login functionality
