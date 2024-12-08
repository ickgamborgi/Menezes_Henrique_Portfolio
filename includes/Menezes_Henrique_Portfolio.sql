-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 08/12/2024 às 21:31
-- Versão do servidor: 8.0.35
-- Versão do PHP: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Menezes_Henrique_Portfolio`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contact`
--

CREATE TABLE `contact` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `message` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`) VALUES
(1, 'Jane Doe', 'janedoe@gmail.com', '+1 226 (231) 0401', 'Hello! This is just a test, but let\'s see if everything works just fine...'),
(2, 'Alex Pereira', 'alexpereira@gmail.com', '+1 232 (322) 8283', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.'),
(3, 'Charles Oliveira', 'charlesoliveira@gmail.com', '+1 232 (278) 7282', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `link`
--

CREATE TABLE `link` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `link`
--

INSERT INTO `link` (`id`, `name`, `url`) VALUES
(1, 'Resume', 'https://drive.google.com/file/d/1IVieGaWlVBvap9UwNIM0GwgP0hnsdKhI/view'),
(2, 'Github', 'https://github.com/ickgamborgi/'),
(3, 'Behance', 'https://behance.com/ickgamborgi'),
(4, 'LinkedIn', 'https://linkedin.com/in/ickgamborgi/'),
(5, 'Instsagram', 'https://instagram.com/inkgamborgi'),
(6, 'WhatsApp', 'https://api.whatsapp.com/send?phone=12263860514&text=Hello,%20Henrique!%20I%27ve%20just%20seen%20your%20portfolio%20and...');

-- --------------------------------------------------------

--
-- Estrutura para tabela `media`
--

CREATE TABLE `media` (
  `id` int UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `project_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `media`
--

INSERT INTO `media` (`id`, `url`, `caption`, `project_id`) VALUES
(8, 'drnut-1.webp', 'Dr. Nut Process', 3),
(9, 'drnut-2.jpg', 'Dr. Nut Coaster', 3),
(10, 'drnut-3.jpg', 'Dr. Nut Products', 3),
(11, 'drnut-4.jpg', 'Dr. Nut Product', 3),
(12, 'drnut-5.jpg', 'Dr. Nut Packaging', 3),
(13, 'drnut-9.jpg', 'Dr. Nut Packaging', 3),
(14, 'airpods-1.webp', 'AirPods Sketch', 4),
(15, 'airpods-2.jpg', 'AirPods X-ray', 4),
(16, 'airpods-3.jpg', 'AirPods', 4),
(18, 'airpods-5.jpg', 'AirPods', 4),
(19, 'airpods-6.jpg', 'AirPods', 4),
(20, 'airpods-7.jpg', 'AirPods Green', 4),
(21, 'airpods-8.jpg', 'AirPods Yellow', 4),
(22, 'haka-2.jpg', 'Haka', 5),
(23, 'haka-3.gif', 'Haka GIF', 5),
(24, 'haka-4.jpg', 'Haka Concepts', 5),
(25, 'haka-5.jpg', 'Haka Grid', 5),
(26, 'haka-7.jpg', 'Haka Typography', 5),
(27, 'haka-8.jpg', 'Haka Color Palette', 5),
(28, 'haka-9.gif', 'Haka GIF', 5),
(29, 'haka-10.jpg', 'Haka Application', 5),
(30, 'haka-11.jpg', 'Haka Application', 5),
(31, 'haka-13.jpg', 'Haka Coasters', 5),
(32, 'haka-14.jpg', 'Haka Application', 5),
(33, 'togo-1.png', 'To Go Cover', 6),
(34, 'togo-2.png', 'To Go', 6),
(35, 'togo-3.webp', 'To Go Concepts', 6),
(36, 'togo-4.webp', 'To Go Typography', 6),
(37, 'togo-5.png', 'To Go', 6),
(38, 'togo-6.webp', 'To Go colors', 6),
(39, 'togo-7.png', 'To Go colors', 6),
(40, 'togo-8.webp', 'To Go Illustrations', 6),
(41, 'togo-9.png', 'To Go', 6),
(42, 'togo-10.png', 'To Go', 6),
(43, 'togo-11.png', 'To Go', 6),
(44, 'togo-12.png', 'To Go', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `project`
--

CREATE TABLE `project` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `cover` varchar(500) NOT NULL,
  `thumb` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prototype_link` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('academic','real','fantasy') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` varchar(100) NOT NULL COMMENT 'Ex: JUN, 2024',
  `duration` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'EX: 5 months — Sep 2020 to Jan 2021',
  `role` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `areas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'EX: Branding, Web and Product Design',
  `recap` varchar(2500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `briefing` varchar(2500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `process` varchar(2500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `takeaways` varchar(2500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tools` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `project`
--

INSERT INTO `project` (`id`, `title`, `subtitle`, `cover`, `thumb`, `prototype_link`, `type`, `date`, `duration`, `role`, `areas`, `recap`, `briefing`, `process`, `takeaways`, `tools`) VALUES
(3, 'Dr. Nut', 'Almond Drink', 'cover_drnut.webp', 'thumb_drnut.webp', 'https://ickgamborgi.github.io/Dr-Nut_Website/', 'academic', 'Jul, 2024', '4 months — April 2024 to July 2024', 'Full stack and Sole Designer', 'Branding, Web, Product and Motion Design', 'New face, same flavor and still delicious! This project introduces the new brand and product line for Dr. Nut Soft Drink. Targeting the new launching, this campaign includes the brand redesign, product, UX, web and motion design. Developed for the Interactive Media Design Program during my Fanshawe graduation, no real relations to Dr. Nut original company.', 'The assignment behind this project aimed to redesign and reposition an existing and old brand, that has not existed in the market for a very long time. To achieve this, an approach that needed to reimagine the experience for new customers was necessary, and introduce Dr. Nut with a new face, that might catch the eyes of curious people and reignite the pride in old lovers. A consistent visual language was also developed to bridge the gap between the product past and future, with new packaging and digital content. Promotional materials, including motion graphics and webpage would have to be crafted to bring engagement across all platforms. This integrated approach had to make sure that every design aspect contributed to a unified brand and message, presenting Dr. Nut as a new and desirable product line supportive in a modern market.', 'Dr. Nut\'s project was an academic initiative for the Interactive Media Design program, that focused mainly on rebranding the identify of a nostalgic soft drink. The primary sprint was to give the new brand a complete makeover while staying true to its essence as a beloved drink. I worked on this project as a full-stack designer, combining branding, product, web, user experience, product and motion design in a new launching campaign. By reimagining the brand\'s visual identity, product packaging, and digital presence, the project aimed to revive this drink in a modern market, with adapted preferences and targeting new individuals. The final result came through very holistic design exercises, blending 3D modeling, video editing, packaging and web design to deliver creative campaign pieces — I even acted as an actor in one of them hehe.', 'The result reinforced the need for a interdisciplinary approach in design projects. By handling every aspect of the campaign independently, I gained valuable experience in project management, branding and video production. I also deepened my knowledges in 3D modeling and packaged, while also refining my front-end coding skills through the development of a functional and responsive website prototype.', 'Adobe Illustrator, Adobe Photoshop, Cinema 4D, Adobe XD and for coding GitHub workflow was implemented, using VS Code with HTML5, CSS5 and basic javascript.'),
(4, 'AirPods Mini', 'EarBuds', 'cover_airpods.webp', 'thumb_airpods.webp', 'https://ickgamborgi.github.io/Menezes_Henrique_Earbud/', 'fantasy', 'Nov, 2024', '2 months — September 2024 to November 2024', 'Full stack and Sole Designer', 'Branding, Web, Product and Motion Design', 'This project introduces a new fantasy product for Apple. The AirPods Mini was redesigned to be a revolutionary hearing experience! I propose a new concept, 3D model and product design for these EarBuds, and developed a webpage to recreate an existing brand experience. Developed for the Interactive Media Design Program during my Fanshawe graduation, no real relations to Apple Inc.', 'The AirPods Mini project was conceived as a reimagination of Apple’s classic AirPods, aimed at enhancing the user experience with a more advanced and compact design. The objective was to create a concept that combined sleek aesthetics with cutting-edge audio technology, providing users with the ultimate hearing experience. This project included developing a new product prototype, creating a corresponding webpage that adhered to Apple’s branding style, and presenting the concept through a promotional video. The project, developed during my Interactive Media Design studies at Fanshawe College, was an academic exercise without any real ties to Apple Inc.', 'The project was approached as a comprehensive design challenge, where I served as the sole designer and full-stack developer. Initial stages involved sketching and brainstorming to conceptualize the design of the AirPods Mini. Using Cinema 4D, I created a detailed 3D model of the product, focusing on a sleek, ergonomic form that prioritized comfort and portability. With the prototype established, I built a responsive, interactive webpage using HTML5, CSS3, JavaScript, and GSAP for dynamic animations. The webpage aimed to reflect Apple’s minimalist branding, showcasing the product’s unique features and user benefits. A promotional video was also created to complete the concept, adding an immersive visual component to highlight the AirPods Mini\'s design and functionality.', 'This project emphasized the value of an interdisciplinary approach, combining 3D modeling, web design, and video production to create a cohesive and professional concept. I gained valuable insights into how to integrate different design disciplines into a unified presentation that feels both innovative and brand-aligned. The experience strengthened my front-end coding skills, especially with GSAP for animations and Google Model Viewer for interactive 3D displays. It also deepened my understanding of how to craft a compelling narrative through design, bridging the gap between concept and digital experience to create a product that feels both real and aspirational.', 'Adobe Illustrator, Adobe Photoshop, Cinema 4D, Adobe XD and for coding GitHub workflow was implemented, using VS Code with HTML5, CSS5, javascript, GSAP animations and Google Model Viewer.'),
(5, 'Haka', 'Burguer', 'cover_haka.webp', 'thumb_haka.webp', 'https://www.behance.net/gallery/111067891/Branding-Haka-Burger', 'real', 'Jan, 2021', '5 months — September 2020 to January 2021', 'Part of a 5 designers team, responsible for Branding and Applications', 'Branding', 'Project developed for the new brand of the Haka restaurant, located in the heart of Florianópolis and serving shakes, burgers and beer. This project proposed the rebranding of the already existing bar into a new and enhanced cultural experience, with menu, products and environmental redesign. Developed for the Branding Project Course during my UFSC graduation.', 'Haka was an academic project focused on rebranding a popular restaurant in Florianópolis. The goal was to transform Haka from a simple lunch spot into a cultural experience that resonated with its customers, blending local identity and a vibrant atmosphere. This project aimed to redefine the brand’s visual identity, update the menu design, and redesign the restaurant\'s interior to create an engaging experience. The rebranding emphasized not just aesthetics, but an immersive journey for customers, reflecting the culture and energy of the city. Developed as part of the Branding Project course during my UFSC graduation, it was an opportunity to explore comprehensive branding strategies and application design.', 'I collaborated with four other designers on the Haka project, where we divided the tasks to maximize our creative output. My primary role was focused on helping to develop the brand identity, designing various applications to enhance the overall experience and making a complete guide for usage. The process used is a design approach called TXM, (Think - Experience - Manage). And it begins with intensive research and analysis to understand target audience, strengths and weaknesses, competitors, and market positioning. We then worked on conceptualizing the new visual identity, which included logo design, color palette, typography and various applications. Moving forward, we worked to apply these materials in complete experiences to the customer, such as menus, merchandise, and environmental graphics to ensure consistency across all touchpoints.', 'This project was very important to develop skills in collaboration, teamwork and dealing with real world situations. Working with a team of designers taught me how to balance individual creativity with collective objectives to produce a unified design language. It also deepened my understanding of how branding extends beyond digital and print materials to physical environments, creating a complete brand experience. The process helped refine my ability to translate brand concepts into practical applications that resonate with customers, and it improved my proficiency in applying design principles in a real-world context. The project was a valuable exercise in taking a brand through a comprehensive transformation, from ideation to execution, with a real business.', 'Adobe Illustrator, Adobe Photoshop, Adobe InDesign and Figma. For team collaboration Trello and Google Drive were used.'),
(6, 'To Go, Please', 'Book Series', 'cover_togo.webp', 'thumb_togo.webp', 'https://issuu.com/ickgamborgi/docs/arquivo_livro_2_europa_digital', 'academic', 'Jan, 2020', '5 months — September 2019 to January 2020', 'Part of a 3 designers team, responsible for Branding and Editorial design.', 'Branding, Product and Editorial Design', 'A series of Culinary Book Guides throughout the world! This series proposes an adventure between two themes: traveling and cooking. Between three different routes around the world, this project proposes the design and layout of three books (America, Europe and Asia) and a concept notebook that works as a sketchbook and gastronomic passport. Developed for the Editorial Project Course during my UFSC graduation.', 'To Go, Please is an academic project aimed at creating a culinary book box focused on travel and cooking, designed to inspire readers to explore different cultures through their cuisine. The series featured three themed books covering America, Europe, and Asia, along with a concept notebook serving as a supportive material for a complete experience. The project was developed as part of the Editorial Project course during my UFSC graduation, where the primary objective was to craft a unique and engaging editorial experience. This series merged design, storytelling, and practical use, creating a collection that celebrates global flavors and culinary exploration.', 'I worked with two other designers to develop this project, taking on a key role in branding and editorial design. Our initial phase involved thorough research into culinary traditions, cultural elements, and the target audience\'s preferences. We defined a cohesive visual language that would resonate with readers and reflect the theme of each region. This included creating custom illustrations, designing layouts for the books, exploring covers, and selecting elements that complemented the created brand. The concept notebook was designed as a functional and aesthetic piece, featuring spaces for notes and sketches to encourage users to interact with it as they would a personal travel journal. Our team coordinated through collaborative tools, mainly using Notion and InDesign to layout the editorial pieces.', 'This project enhanced my ability to work within a team on complex design projects and deepened my understanding of editorial design principles. Creating a book series that combined branding, product design, and editorial design allowed me to explore the complexities of layout design, content hierarchy, user interaction and mainly, graphic production. The experience taught me the importance of visual consistency when developing multiple interconnected pieces and how to adapt design strategies to different people and devices. Additionally, working with this team reinforced the need for clear communication and thorough planning in a collaborative design process. The project was a valuable exercise in thinking holistically about the user experience and ensuring that each book in the series added to an immersive and engaging journey, with real ingredients and traditional dishes.', 'Adobe Illustrator, Adobe Photoshop, Adobe InDesign and Figma. For team collaboration Notion, Trello and Google Drive were used.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `link`
--
ALTER TABLE `link`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `media`
--
ALTER TABLE `media`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `project`
--
ALTER TABLE `project`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
