export function initFilter() {
  const filterButtons = document.querySelectorAll(".tag");
  const portfolioGallery = document.querySelector(".portfolio-gallery");

  if (!filterButtons || !portfolioGallery) {
    return;
  }

  const initPortfolioAnimations = () => {
    gsap.utils.toArray(".portfolio-item").forEach((item, index) => {
      const overlay = item.querySelector(".project-overlay");
      const thumb = item.querySelector(".project-thumb");
      const arrow = item.querySelector(".project-btn");
      const title = item.querySelector(".project-title");
      const recap = item.querySelector(".project-recap");
      const areas = item.querySelector(".project-areas");

      // Animação de entrada para o container inteiro
      gsap.from(item, {
        opacity: 0, // Começa invisível
        y: 50, // Move para cima
        duration: 0.5, // Duração da animação
        ease: "ease2.inOut", // Efeito de suavização
        scrollTrigger: {
          trigger: item, // Ativa a animação quando o item entra na viewport
          toggleActions: "play none none reverse", // Apenas executa a animação uma vez
        },
      });

      if (overlay && thumb && arrow) {
        // Define o gradiente inicial no overlay
        gsap.set(overlay, {
          background: `linear-gradient(
            0deg,
            rgba(0, 0, 0, 0.5) 0%,
            rgba(0, 0, 0, 0) 100%
          )`,
        });

        // Função para ativar as animações de hover
        const activateAnimations = () => {
          gsap.to(thumb, {
            scale: 1.05, // Faz zoom na imagem
            duration: 0.5,
            ease: "ease2.inOut",
          });

          gsap.to(arrow, {
            opacity: 1, // Torna a seta totalmente visível
            duration: 0.5,
            rotate: "45deg",
            ease: "ease2.inOut",
            overwrite: "auto",
          });

          gsap.to(overlay, {
            background: `linear-gradient(
              0deg,
              rgba(0, 0, 0, 0.8) 0%,
              rgba(0, 0, 0, 0.2) 100%
            )`, // Escurece o overlay
            duration: 0.5,
            ease: "ease2.inOut",
          });
        };

        // Função para desativar as animações de hover
        const deactivateAnimations = () => {
          gsap.to(thumb, {
            scale: 1, // Volta ao tamanho original
            duration: 0.5,
            ease: "ease2.inOut",
          });

          gsap.to(arrow, {
            opacity: 0.5, // Volta à opacidade original da seta
            duration: 0.5,
            ease: "ease2.inOut",
            rotate: "0deg",
            overwrite: "auto",
          });

          gsap.to(overlay, {
            background: `linear-gradient(
              0deg,
              rgba(0, 0, 0, 0.5) 0%,
              rgba(0, 0, 0, 0) 100%
            )`, // Volta ao gradiente original
            duration: 0.5,
            ease: "ease2.inOut",
          });
        };

        // Adiciona eventos de hover ao overlay
        overlay.addEventListener("mouseenter", activateAnimations);
        overlay.addEventListener("mouseleave", deactivateAnimations);

        // Adiciona eventos de hover ao botão (arrow)
        arrow.addEventListener("mouseenter", activateAnimations);
        arrow.addEventListener("mouseleave", deactivateAnimations);

        // Adiciona eventos de hover e clique aos elementos filhos
        [title, recap, areas].forEach((element) => {
          if (element) {
            element.addEventListener("mouseenter", activateAnimations);
            element.addEventListener("mouseleave", deactivateAnimations);
            element.addEventListener("click", activateAnimations);
          }
        });
      }
    });
  };

  const fetchProjects = (filterTag) => {
    fetch("admin/filter_projects.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `filterTag=${filterTag}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`Error: ${response.status}`);
        }
        return response.json();
      })
      .then((data) => {
        portfolioGallery.innerHTML = "";

        data.forEach((project) => {
          const projectItem = document.createElement("div");
          projectItem.classList.add("portfolio-item");
          projectItem.innerHTML = `
                <a class="portfolio-item-con" href="casestudy.php?id=${project.id}">
                  <div class="project-overlay"></div>
                  <img class="project-thumb" src="./images/${project.thumb}" alt="Project Thumbnail">
                  <div class="project-arrow">
                    <img class="project-btn" src="./images/diagonal-arrow.svg" alt="Project Button">  
                  </div>
                  <div class="portfolio-item-info">
                    <h6 class="project-title"><span>${project.title}</span> ${project.subtitle}</h6>
                    <p class="project-areas">${project.areas}</p>
                  </div>
                </a>
              `;
          portfolioGallery.appendChild(projectItem);
        });

        initPortfolioAnimations();
      })
      .catch((error) => {
        console.error("Error fetching projects:", error);
      });
  };

  filterButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault();

      filterButtons.forEach((btn) => btn.classList.remove("selected"));
      button.classList.add("selected");

      const filterTag = button.dataset.tag;
      fetchProjects(filterTag);
    });
  });

  fetchProjects("all");
}
