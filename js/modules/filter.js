export function initFilter() {
  // Seleciona os botões de filtro e a galeria de projetos
  const filterButtons = document.querySelectorAll(".tag");
  const portfolioGallery = document.querySelector(".portfolio-gallery");

  // Verifica se os elementos necessários existem no DOM
  if (!filterButtons || !portfolioGallery) {
    return;
  }

  // Função para inicializar as animações do GSAP apenas para os projetos
  const initPortfolioAnimations = () => {
    // Remove os ScrollTriggers antigos apenas para os elementos da galeria
    ScrollTrigger.getAll()
      .filter(
        (trigger) =>
          trigger.trigger && trigger.trigger.closest(".portfolio-gallery")
      )
      .forEach((trigger) => trigger.kill());

    // Adiciona animações para os novos elementos
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
        x: 50,
        duration: 1,
        ease: "power2.out",
      });

      gsap.from(item.querySelector(".project-thumb"), {
        scrollTrigger: {
          trigger: item,
          start: "top bottom",
          end: "bottom 50%",
          toggleActions: "play none none reset",
          markers: false,
        },
        opacity: 0,
        x: -50,
        duration: 1,
        ease: "power2.out",
      });
    });

    // Atualiza o ScrollTrigger após adicionar novos elementos
    ScrollTrigger.refresh();
  };

  // Função para buscar e exibir projetos com base no filtro
  const fetchProjects = (filterTag) => {
    fetch("admin/filter_projects.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `filterTag=${filterTag}`, // Envia o filtro selecionado para o servidor
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Error: ${response.status}`);
        }
        return response.json(); // Retorna o JSON dos projetos
      })
      .then((data) => {
        portfolioGallery.innerHTML = ""; // Limpa a galeria existente

        // Cria e adiciona novos elementos de projeto
        data.forEach((project) => {
          const projectItem = document.createElement("div");
          projectItem.classList.add("portfolio-item");
          projectItem.innerHTML = `
                <h5 class="hidden">Portfolio item</h5>
                <a class="project-thumb-btn" href="casestudy.php?id=${project.id}">
                  <img class="project-thumb" src="./images/${project.thumb}" alt="Project Thumbnail">
                </a>
                <div class="portfolio-item-info">
                  <h6 class="project-title"><span>${project.title}</span> ${project.subtitle}</h6>
                  <p class="project-areas">${project.areas}</p>
                  <p class="project-recap">${project.recap}</p>
                  <a href="casestudy.php?id=${project.id}" class="intro-btn">
                    <h5 class="small-button">Case Study</h5>
                    <i class="fa-solid fa-square-caret-right arrow"></i>
                  </a>
                </div>
              `;
          portfolioGallery.appendChild(projectItem);
        });

        // Re-inicializa as animações do GSAP após o conteúdo ser atualizado
        initPortfolioAnimations();
      })
      .catch((error) => {
        console.error("Error fetching projects:", error);
      });
  };

  // Adiciona eventos de clique aos botões de filtro
  filterButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault(); // Evita o comportamento padrão do link

      // Remove a classe "selected" de todos os botões
      filterButtons.forEach((btn) => btn.classList.remove("selected"));

      // Adiciona a classe "selected" ao botão clicado
      button.classList.add("selected");

      // Obtém o filtro do atributo data-tag
      const filterTag = button.dataset.tag;

      // Busca e exibe os projetos com base no filtro
      fetchProjects(filterTag);
    });
  });

  // Inicializa as animações e exibe todos os projetos ao carregar a página
  fetchProjects("all");
}
