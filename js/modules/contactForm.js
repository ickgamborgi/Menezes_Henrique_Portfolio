export function initContactForm() {
  const formCon = document.querySelector(".form");
  const feedback = document.querySelector("#feedback");

  if (!formCon || !feedback) {
    console.warn("Form or feedback element not found.");
    return; // I added this because my console was showing an error in pages where there was no form.
  }

  feedback.classList.add("hidden"); // started hiding the default feedback element that's already in HTML

  function sendContactForm(event) {
    event.preventDefault(); // prevents the default behavior of the form
    feedback.classList.remove("hidden");
    feedback.innerHTML = ""; // clear the div with the default feedback

    const contactForm = event.currentTarget;
    const sendFile = "sendmail.php";
    const formData = new URLSearchParams(new FormData(contactForm)).toString();

    fetch(sendFile, {
      // fetch the URL from form
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: formData,
    })
      .then((response) => response.json()) // convert the response to JSON
      .then((response) => {
        feedback.classList.remove("success", "error");

        if (response.errors) {
          response.errors.forEach((error) => {
            // if there are errors, show them
            const errorElement = document.createElement("p");
            errorElement.textContent = error;
            errorElement.classList.add("error"); // add classlist with red color
            const icon = document.createElement("i"); // add icon to the error message
            icon.classList.add("fas", "fa-exclamation-circle");
            errorElement.prepend(icon); // add icon before the error message
            feedback.appendChild(errorElement); // append error

            gsap.fromTo(
              // animation for error
              feedback,
              { opacity: 0 },
              {
                opacity: 1,
                duration: 0.5,
                ease: "power1.inOut",
              }
            );

            gsap.fromTo(
              feedback,
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
        } else {
          // if there are no errors, show success message
          contactForm.reset();
          const messageElement = document.createElement("p"); // same logic as before, create <p>, style, add icon and append
          messageElement.textContent = response.message;
          messageElement.classList.add("success");
          const icon = document.createElement("i");
          icon.classList.add("fas", "fa-check-circle");
          messageElement.prepend(icon);
          feedback.appendChild(messageElement);

          gsap.fromTo(
            feedback,
            { opacity: 0, x: 50 },
            {
              opacity: 1,
              duration: 0.35,
              ease: "ease2.in",
              x: 0,
            }
          );
        }

        feedback.scrollIntoView({ behavior: "smooth", block: "end" });
      })
      .catch((error) => {
        // catch any unexpected errors
        feedback.classList.add("error");
        feedback.innerHTML =
          "<p>Sorry, something went wrong. Please, check your internet connection or if your browser is updated</p>";

        gsap.from(feedback, {
          duration: 0.75,
          x: 75,
          ease: "bounce.out",
        });
      });
  }

  formCon.addEventListener("submit", sendContactForm); // add event listener to the form

  formCon.addEventListener("submit", (event) => {
    console.log("User submitted information on " + formCon.id); // console log it out
  });
}
