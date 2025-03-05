// Used the same logic that I used to build contactForm.js with AJAX to return any error on logging in the CMS admin page

export function initLoginForm() {
  const loginFormCon = document.querySelector(".login-form form");
  const formFeedback = document.querySelector("#feedback");

  if (!loginFormCon || !formFeedback) {
    console.warn("Form or feedback element not found.");
    return; // I added this because my console was showing an error in pages where there was no form.
  }

  formFeedback.classList.add("hidden"); // started hiding the default feedback element that's already in HTML

  function sendLoginForm(event) {
    event.preventDefault(); // prevents the default behavior of the form
    formFeedback.classList.remove("hidden");
    formFeedback.innerHTML = ""; // clear the div with the default feedback

    const loginForm = event.currentTarget;
    const loginFile = "log.php";
    const loginData = new URLSearchParams(new FormData(loginForm)).toString();

    fetch(loginFile, {
      // fetch the URL from form
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: loginData,
    })
      .then((response) => response.json()) // convert the response to JSON
      .then((response) => {
        formFeedback.classList.remove("success", "error");
        formFeedback.innerHTML = "";

        if (response.success) {
          // if there are no errors, redirect to admin page
          window.location.href = response.redirect;
        } else if (response.errors) {
          response.errors.forEach((error) => {
            // if there are errors, show them
            const errorElement = document.createElement("p");
            errorElement.textContent = error;
            errorElement.classList.add("error"); // add classlist with red color
            const icon = document.createElement("i"); // add icon to the error message
            icon.classList.add("fas", "fa-exclamation-circle");
            errorElement.prepend(icon); // add icon before the error message
            formFeedback.appendChild(errorElement); // append error

            gsap.fromTo(
              // animation for error
              formFeedback,
              { opacity: 0 },
              {
                opacity: 1,
                duration: 0.5,
                ease: "power1.inOut",
              }
            );

            gsap.fromTo(
              formFeedback,
              { x: 10 },
              {
                x: 0,
                duration: 0.2,
                ease: "power1.inOut",
                repeat: 4,
                yoyo: true,
              }
            );
          });
        }

        formFeedback.scrollIntoView({ behavior: "smooth", block: "end" });
      })
      .catch((error) => {
        // catch any unexpected errors
        formFeedback.classList.add("error");
        formFeedback.innerHTML =
          "<p>Sorry, something went wrong. Please, check your internet connection or if your browser is updated</p>";

        gsap.from(formFeedback, {
          duration: 0.75,
          x: 75,
          ease: "bounce.out",
        });
      });
  }

  loginFormCon.addEventListener("submit", sendLoginForm); // add event listener to the form

  loginFormCon.addEventListener("submit", (event) => {
    console.log("User submitted information on " + loginFormCon.id); // console log it out
  });
}
