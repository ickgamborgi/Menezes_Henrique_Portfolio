export function initLoginForm() {
  const loginForm = document.querySelector("#login-form");
  const feedback = document.querySelector("#feedback");

  if (!loginForm || !feedback) {
    console.warn("Login form or feedback element not found.");
    return;
  }

  // Esconde o feedback inicialmente
  feedback.classList.add("hidden");

  loginForm.addEventListener("submit", (event) => {
    event.preventDefault(); // Impede o envio padrão do formulário
    feedback.classList.remove("hidden");
    feedback.innerHTML = ""; // Limpa mensagens anteriores

    const formData = new URLSearchParams(new FormData(loginForm)).toString();
    const sendFile = loginForm.action;

    fetch(sendFile, {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: formData,
    })
      .then((response) => response.json())
      .then((response) => {
        feedback.classList.remove("success", "error");

        if (response.errors) {
          // Exibe todas as mensagens de erro retornadas pelo PHP
          response.errors.forEach((error) => {
            const errorElement = document.createElement("h3");
            errorElement.textContent = error;
            errorElement.classList.add("error");
            const icon = document.createElement("i");
            icon.classList.add("fas", "fa-exclamation-circle");
            errorElement.prepend(icon);
            feedback.appendChild(errorElement);
          });

          // Animação para exibir os erros
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
        } else if (response.success) {
          // Exibe mensagem de sucesso e redireciona
          const successElement = document.createElement("p");
          successElement.textContent = "Login successful! Redirecting...";
          successElement.classList.add("success");
          const icon = document.createElement("i");
          icon.classList.add("fas", "fa-check-circle");
          successElement.prepend(icon);
          feedback.appendChild(successElement);

          // Animação para exibir a mensagem de sucesso
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

          setTimeout(() => {
            window.location.href = response.redirect;
          }, 500);
        }
      })
      .catch((error) => {
        feedback.classList.add("error");
        feedback.innerHTML =
          "<p>Sorry, something went wrong. Please try again later.</p>";

        gsap.from(feedback, {
          duration: 0.75,
          x: 75,
          ease: "bounce.out",
        });
      });
  });
}
