export function initContactForm() {
  const formCon = document.querySelector(".form");
  const feedback = document.querySelector("#feedback");

  // Gera dois números aleatórios entre 0 e 5
  const num1 = Math.floor(Math.random() * 6);
  const num2 = Math.floor(Math.random() * 6);
  const correctAnswer = num1 + num2;

  // Define a pergunta no placeholder do campo de entrada
  const mathInput = document.getElementById("math-answer");
  if (!mathInput) {
    console.warn("Element with ID 'math-answer' not found.");
    return;
  }
  mathInput.placeholder = `${num1} + ${num2} = ?`;

  // Define a resposta esperada no campo oculto
  const mathExpectedInput = document.getElementById("math-expected");
  if (!mathExpectedInput) {
    console.warn("Element with ID 'math-expected' not found.");
    return;
  }
  mathExpectedInput.value = correctAnswer;

  if (!formCon || !feedback) {
    console.warn("Form or feedback element not found.");
    return;
  }

  feedback.classList.add("hidden");

  function sendContactForm(event) {
    event.preventDefault();
    feedback.classList.remove("hidden");
    feedback.innerHTML = "";

    const contactForm = event.currentTarget;
    const sendFile = "sendmail.php";
    const formData = new URLSearchParams(new FormData(contactForm)).toString();

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
            const errorElement = document.createElement("p");
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
        } else {
          // Exibe a mensagem de sucesso
          contactForm.reset();
          const messageElement = document.createElement("p");
          messageElement.textContent = response.message;
          messageElement.classList.add("success");
          const icon = document.createElement("i");
          icon.classList.add("fas", "fa-check-circle");
          messageElement.prepend(icon);
          feedback.appendChild(messageElement);

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
        }

        feedback.scrollIntoView({ behavior: "smooth", block: "center" });
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

  formCon.addEventListener("submit", sendContactForm);
}
