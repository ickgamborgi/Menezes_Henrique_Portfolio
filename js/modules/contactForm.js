export function initContactForm() {
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
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: formdata,
    })
      .then((response) => response.json())
      .then((response) => {
        feedback.classList.remove("success", "error");

        if (response.errors) {
          response.errors.forEach((error) => {
            const errorElement = document.createElement("p");
            errorElement.textContent = error;
            errorElement.classList.add("error");
            const icon = document.createElement("i");
            icon.classList.add("fas", "fa-exclamation-circle");
            errorElement.prepend(icon);
            feedback.appendChild(errorElement);

            gsap.fromTo(
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
          form.reset();
          const messageElement = document.createElement("p");
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

  form.addEventListener("submit", regForm);

  form.addEventListener("submit", (event) => {
    console.log("User submitted information on " + form.id); // console log it out
  });
}
