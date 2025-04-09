export function initHeroTyping() {
  const scrambleItems = [
    "Experiências",
    "Marcas",
    "Telas",
    "Produtos",
    "Pessoas",
  ]; // Lista de palavras
  const typingElement = document.querySelector(".text-scramble"); // Elemento onde o texto será exibido
  let currentIndex = 0; // Índice da palavra atual
  let isDeleting = false; // Indica se está apagando o texto
  let currentText = ""; // Texto atual exibido
  let charIndex = 0; // Índice do caractere atual

  if (!typingElement) {
    console.warn("No typing element found.");
    return;
  }

  const type = () => {
    const fullText = scrambleItems[currentIndex]; // Palavra completa atual

    if (isDeleting) {
      // Apagando o texto
      currentText = fullText.substring(0, charIndex--);
    } else {
      // Digitando o texto
      currentText = fullText.substring(0, charIndex++);
    }

    typingElement.textContent = currentText; // Atualiza o texto no elemento

    // Controle da velocidade de digitação e apagamento
    let typingSpeed = isDeleting ? 50 : 100;

    if (!isDeleting && currentText === fullText) {
      // Pausa ao terminar de digitar a palavra
      isDeleting = true;
      typingSpeed = 2000; // Pausa de 2 segundos antes de apagar
    } else if (isDeleting && currentText === "") {
      // Passa para a próxima palavra após apagar
      isDeleting = false;
      currentIndex = (currentIndex + 1) % scrambleItems.length; // Vai para a próxima palavra
      typingSpeed = 500; // Pausa curta antes de começar a digitar a próxima palavra
    }

    setTimeout(type, typingSpeed); // Chama a função novamente após o tempo definido
  };

  type(); // Inicia o efeito de digitação
}
