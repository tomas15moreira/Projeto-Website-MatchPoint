-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- A despejar estrutura para tabela matchpoint.blog
CREATE TABLE IF NOT EXISTS `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_publicacao` date NOT NULL,
  `resumo` text NOT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.blog: ~4 rows (aproximadamente)
INSERT INTO `blog` (`id`, `titulo`, `categoria`, `data_publicacao`, `resumo`, `conteudo`, `imagem`) VALUES
	(1, '5 Dicas Essenciais para Melhorar o teu Serviço', 'Dicas de Treino', '2025-11-18', 'O serviço é o golpe mais importante no ténis. Descobre como podes ganhar mais potência e precisão.', '<p class="lead mb-6 text-xl text-gray-600">O serviço é, sem dúvida, o golpe mais complexo do ténis. Aqui ficam 5 dicas para passares ao próximo nível.</p>\r\n\r\n<h3 class="text-2xl font-bold text-gray-800 mt-8 mb-3">1. O Lançamento (Toss)</h3>\r\n<p class="mb-4">O segredo começa aqui. Tenta lançar a bola sempre à mesma altura e ligeiramente à frente do corpo. Um lançamento consistente é 50% do sucesso.</p>\r\n<img src="img/servico_toss.gif" alt="Lançamento de bola" class="w-full rounded-lg shadow-md mb-6">\r\n\r\n<h3 class="text-2xl font-bold text-gray-800 mt-8 mb-3">2. A Posição de Troféu</h3>\r\n<p class="mb-4">Dobra os joelhos e aponta a raquete para o céu antes de atacar a bola. Esta posição acumula energia elástica.</p>\r\n<img src="img/servico_flexao.gif" alt="Posição de Troféu" class="w-full rounded-lg shadow-md mb-6">\r\n\r\n<h3 class="text-2xl font-bold text-gray-800 mt-8 mb-3">3. O Ataque à Bola</h3>\r\n<p class="mb-4">Não esperes que a bola desça. Salta e vai buscá-la no ponto mais alto possível para garantir o melhor ângulo sobre a rede.</p>\r\n<img src="img/servico_impacto.gif" alt="Ataque à bola" class="w-full rounded-lg shadow-md mb-6">\r\n\r\n<h3 class="text-2xl font-bold text-gray-800 mt-8 mb-3">4. A "Chicotada" do Pulso</h3>\r\n<p class="mb-4">No momento do impacto, o pulso deve rodar para fora (pronação). É isto que gera a verdadeira velocidade na cabeça da raquete. Lembra-te: um pulso tenso é um pulso lento.</p>\r\n\r\n<h3 class="text-2xl font-bold text-gray-800 mt-8 mb-3">5. A Recuperação (Aterragem)</h3>\r\n<p class="mb-4">O serviço não acaba no impacto! Deixa o corpo "cair" para dentro do campo e a raquete terminar o movimento cruzando o tronco. Isto garante que estás equilibrado e pronto para a próxima bola.</p>', 'img/blog_serviço.webp'),
	(2, 'Ténis ou Padel: Qual escolher?', 'Modalidades', '2025-10-05', 'Estás indeciso? Analisamos as diferenças físicas, técnicas e sociais entre os dois desportos.', '\r\n<p class="lead">Esta é a discussão do momento nos clubes desportivos. O Padel teve um crescimento explosivo em Portugal, mas o Ténis continua a ser o "rei". Qual deves escolher? Vamos analisar os factos.</p>\r\n\r\n<h3>Curva de Aprendizagem</h3>\r\n<ul>\r\n    <li><strong>Padel:</strong> É muito mais fácil para começar. A raquete é pequena, o campo é menor e as paredes ajudam a manter a bola em jogo. Em 30 minutos estás a divertir-te.</li>\r\n    <li><strong>Ténis:</strong> Exige mais paciência. A técnica é fundamental para conseguir manter uma troca de bolas consistente. A frustração inicial é maior, mas a recompensa a longo prazo também.</li>\r\n</ul>\r\n\r\n<h3>Exigência Física</h3>\r\n<p>O <strong>Ténis</strong> (especialmente singulares) é fisicamente mais exigente em termos de cardio e cobertura de campo. Exige sprints longos e travagens bruscas.</p>\r\n<p>O <strong>Padel</strong> tem trocas de bola mais rápidas e exige reflexos e agilidade, mas percorres menos distâncias. É excelente para quem procura um jogo social e dinâmico sem a exaustão de uma maratona de ténis.</p>\r\n\r\n<h3>Conclusão</h3>\r\n<p>Não tens de escolher apenas um! Muitos atletas do MatchPoint praticam as duas modalidades. O Ténis melhora o teu jogo de fundo e volei para o Padel, e o Padel melhora os teus reflexos e jogo de rede para o Ténis.</p>\r\n', 'img/Blog_padelvstenis.webp'),
	(3, 'Guia: Como escolher a raquete ideal', 'Equipamento', '2025-09-20', 'Peso, balanço e tamanho da cabeça. Entende o que significam estas características.', '\r\n<p class="lead">Entrar numa loja de desporto e olhar para a parede das raquetes pode ser intimidante. Pesos, balanços, padrões de cordas... O que significa isto tudo? Aqui fica o guia essencial.</p>\r\n\r\n<h3>1. Peso da Raquete</h3>\r\n<p>Esta é a característica mais importante.</p>\r\n<ul>\r\n    <li><strong>Leves (255g - 275g):</strong> Ideais para principiantes e juniores. Fáceis de manusear, mas vibram mais se a bola vier forte.</li>\r\n    <li><strong>Médias (275g - 295g):</strong> O ponto ideal para a maioria dos jogadores de clube. Bom compromisso entre estabilidade e manuseamento.</li>\r\n    <li><strong>Pesadas (+300g):</strong> Para jogadores avançados. Dão muita estabilidade e "peso" à bola, mas exigem um braço forte e boa técnica para não cansar.</li>\r\n</ul>\r\n\r\n<h3>2. Tamanho da Cabeça</h3>\r\n<p>Quanto maior a cabeça (ex: 100 sq in ou mais), maior o "Sweet Spot" (zona ideal de batida). Isto significa que a raquete perdoa mais se não acertares bem no meio. Jogadores profissionais tendem a usar cabeças menores (98 ou 95) para ter mais controlo cirúrgico.</p>\r\n\r\n<h3>3. O Balanço</h3>\r\n<p>Uma raquete pode ter o peso mais no cabo (mais controlo) ou mais na cabeça (mais potência). Se sentes que te falta força para meter a bola no fundo do campo, procura uma raquete com balanço ligeiramente para a cabeça.</p>\r\n', 'img/blog_raquetes.webp'),
	(4, 'Novos campos cobertos em Viseu', 'Notícias Locais', '2025-11-01', 'O inverno já não é desculpa. Conhece os novos espaços indoor que abriram na cidade.', '\r\n<p class="lead">O inverno em Viseu costuma ser rigoroso, e a chuva é a inimiga número um dos tenistas. Mas este ano, a desculpa "está a chover" acabou.</p>\r\n\r\n<h3>Novas Instalações no Fontelo</h3>\r\n<p>É com grande entusiasmo que anunciamos a abertura de dois novos courts cobertos na zona desportiva do Fontelo. A estrutura, feita com uma lona de alta resistência e laterais translúcidas, permite jogar com luz natural durante o dia, protegendo totalmente da chuva e do vento.</p>\r\n\r\n<h3>Piso e Condições</h3>\r\n<p>Os novos campos mantêm o piso de <strong>resina sintética</strong> (piso rápido), igual aos campos exteriores, garantindo que a velocidade de jogo se mantém consistente. Foram também instalados novos focos LED de alta intensidade para os jogos noturnos.</p>\r\n\r\n<h3>Como Reservar?</h3>\r\n<p>As reservas já estão disponíveis na nossa plataforma MatchPoint. Devido à elevada procura prevista para os meses de Dezembro e Janeiro, recomendamos que faças a tua reserva com pelo menos 48 horas de antecedência.</p>\r\n<p>Não deixes a raquete ganhar pó este inverno. Vemo-nos no court!</p>\r\n', 'img/blog_campocoberto.png');

-- A despejar estrutura para tabela matchpoint.campos
CREATE TABLE IF NOT EXISTS `campos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `subtitulo` varchar(255) NOT NULL,
  `imagem_hero` varchar(255) NOT NULL,
  `tipo_badge` varchar(50) NOT NULL,
  `descricao_principal` text NOT NULL,
  `infraestruturas_html` text NOT NULL,
  `dimensoes_texto` text NOT NULL,
  `mapa_src` text NOT NULL,
  `coordenadas_html` text NOT NULL,
  `horario_texto` varchar(255) NOT NULL,
  `fecho` int DEFAULT '20',
  `preco_por_hora` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.campos: ~6 rows (aproximadamente)
INSERT INTO `campos` (`id`, `nome`, `subtitulo`, `imagem_hero`, `tipo_badge`, `descricao_principal`, `infraestruturas_html`, `dimensoes_texto`, `mapa_src`, `coordenadas_html`, `horario_texto`, `fecho`, `preco_por_hora`) VALUES
	(1, 'Ténis Clube Viseu', 'O principal centro de ténis da região, com uma história rica e infraestruturas modernas.', 'img/CamposTenis_TCV.jpg', 'Clube Oficial', 'Clube fundado em 1986 dedicado ao ensino da modalidade. Atualmente conta com uma academia e uma nova modalidade, o pickleball. Dedica-se a projetar jovens atletas e seniores no ramo competitivo nacional.', '<li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>4 Campos de Ténis</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>3 Relva Sintética</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>1 Piso Duro (Asfalto)</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Iluminação em 3 campos</li>', '<strong>23,77 x 10,97 metros.</strong><br>Campos homologados, usados frequentemente para diversas provas nacionais e federadas.', 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1209.8507295651866!2d-7.921644245152338!3d40.64498122785587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1spt-PT!2spt!4v1763119681404!5m2!1spt-PT!2spt', '<p> <strong>Campos 1 e 2 (Relva):</strong> 40.6456, -7.9220</p><p> <strong>Campo 3 (Relva):</strong> 40.6446, -7.9229</p><p> <strong>Campo 4 (Asfalto):</strong> 40.6452, -7.9213</p>', 'Requer aluguer prévio. Gratuito se jogar com atleta do clube.', 20, 2.50),
	(2, 'Viseu Royal Tennis Club', 'Dedicado ao ensino e competição, com campos requalificados no coração do Fontelo.', 'img/Campos_fontelo.jpg', 'Clube Oficial', 'Clube presente desde a sua origem, dedica-se ao ensinamento da modalidade bem como à prática do Beach Tennis e a lançar atletas para competições a nível nacional. Os campos sofreram várias requalificações para garantir as melhores condições de jogo.', '<li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>2 Campos de Ténis</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Relva Sintética (Novo em 2016)</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Requalificado em 2024</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-2"></span>Sem iluminação</li>', '<strong>23,77 x 10,97 metros.</strong><br>Campos em relva sintética regulamentares, usados frequentemente em provas federadas.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d604.7892015431706!2d-7.901527949742725!3d40.660001960509064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2337c90795e9a1%3A0x18142f1894b3942a!2sViseu%20Royal%20Tennis%20Club!5e1!3m2!1spt-PT!2spt!4v1763143542881!5m2!1spt-PT!2spt', '<p> <strong>Campo 1:</strong> 40°39\'37.19"N | 7°54\'4.49"W</p><p> <strong>Campo 2:</strong> 40°39\'36.98"N | 7°54\'4.69"W</p>', 'Requer aluguer prévio. Pagamento no balcão das piscinas municipais.', 20, 2.50),
	(3, 'Campo de Ténis em Slurry', 'Localizado no Fontelo, perfeito para prática rápida em piso duro.', 'img/campos_tenis_Viseu.jpg', 'Público', 'Campo em pavimento rígido com acabamento em "slurry", aplicado no ano de 2022. É uma excelente opção para quem procura um jogo rápido num ambiente público e acessível.', '<li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Pavimento Rígido</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Acabamento em Slurry</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Renovado em 2022</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Acesso Público</li>', '<strong>43,34 x 21,74 metros.</strong><br>Área desportiva ampla.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d412.6655757724061!2d-7.902857364247654!3d40.660578093379264!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2337000f8d0387%3A0xde51e0518bcce57b!2zQ2FtcG8gZGUgVMOpbmlzIGVtIOKAnFNsdXJyeeKAnQ!5e1!3m2!1spt-PT!2spt!4v1762985788685!5m2!1spt-PT!2spt', '<p><strong>Coordenadas:</strong> 40°39\'37.55"N | 7°54\'11.60"W</p><p class="text-xs text-gray-400">(Fontelo, junto ao Skatepark)</p>', '<strong>Seg-Sex:</strong> 8h - 23h | <strong>Sáb-Dom:</strong> 8h - 21:30h', 23, 0.00),
	(4, 'Campo Vila Jardim', 'Localizado na Quinta do Perseguido, Viledemoinhos. Um espaço renovado e aberto à comunidade.', 'img/campo_vilajardim.webp', 'Público', 'Campo em pavimento rígido e areia, aplicado no ano de 2018. Oferece excelentes condições para a prática de ténis num ambiente tranquilo.', '<li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Pavimento Rígido</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Aplicado em 2018</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Piso Sintético</li>', '<strong>43,34 x 21,74 metros.</strong><br>Área desportiva padrão para jogos singulares e pares.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2876.839765671112!2d-7.936686224159892!3d40.6608997714014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2337a87b5b50b5%3A0x5af00df2d050088e!2sCampo%20de%20T%C3%A9nis%20Vila%20Jardim!5e1!3m2!1spt-PT!2spt!4v1763031058428!5m2!1spt-PT!2spt', '<p> <strong>Morada:</strong> Quinta Belém 49, 3510 Viseu</p><p> <strong>Coordenadas:</strong> 40.6611, -7.9340</p>', 'Aberto ao público', 19, 0.00),
	(5, 'Campo Casal de Esporão', 'Polidesportivo em São Pedro de France, totalmente requalificado em 2023.', 'img/polidesportivo_casaldeesporão.jpg', 'Público', 'Campo inaugurado em 2023. A empreitada contou com um investimento de 39 mil euros, financiada pelo Município de Viseu e pelo IPDJ. O espaço foi totalmente renovado com substituição de luminárias e balizas, reparação de vedações e pintura.', '<li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Pavimento Betão Poroso</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Iluminação LED Nova</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Bebedouro Requalificado</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Acesso Público</li>', '<strong>43,34 x 21,74 metros.</strong><br>Campo com medidas oficiais para prática de várias modalidades.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d718.5576250849334!2d-7.7875420066579455!3d40.72136297653909!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd234bd109d60a23%3A0x910a22e1f9455d8a!2sPolidesportivo%20S%C3%A3o%20Pedro%20de%20France!5e1!3m2!1spt-PT!2spt!4v1763050671084!5m2!1spt-PT!2spt', '<p> <strong>Coordenadas:</strong> 40.7216, -7.7876</p><p class="text-xs text-gray-400">(São Pedro de France)</p>', 'Aberto ao público, não requer aluguer.', 19, 0.00),
	(6, 'Campo Cavernães', 'Espaço desportivo público em Cavernães, com boas condições e iluminação para jogos noturnos.', 'img/campo_cavernães.jpg', 'Público', 'Campo com boas condições desportivas para a prática da modalidade. Situa-se numa zona acessível e conta com infraestruturas de apoio para espectadores.', '<li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Pavimento Piso Duro</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Iluminação Artificial</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Bancadas Laterais</li><li class="flex items-center"><span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-2"></span>Acesso Público</li>', '<strong>43,34 x 21,74 metros.</strong><br>Espaço amplo adequado para jogos amigáveis e treino.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d349.09889520621425!2d-7.832893109471977!3d40.71219910575971!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd234b36191c3d7d%3A0x7f86757006e96287!2sCampo%20desportivo%20de%20Cavern%C3%A3es!5e1!3m2!1spt-PT!2spt!4v1763142752273!5m2!1spt-PT!2spt', '<p> <strong>Coordenadas:</strong> 40.7122, -7.8327</p><p class="text-xs text-gray-400">(Cavernães, Viseu)</p>', 'Não requer qualquer tipo de aluguer.', 19, 0.00);

-- A despejar estrutura para tabela matchpoint.favoritos
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `campo_id` int NOT NULL,
  `data_adicionado` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `campo_id` (`campo_id`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizadores` (`id`),
  CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`campo_id`) REFERENCES `campos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.favoritos: ~6 rows (aproximadamente)
INSERT INTO `favoritos` (`id`, `user_id`, `campo_id`, `data_adicionado`) VALUES
	(2, 1, 1, '2025-12-11 14:08:31'),
	(3, 1, 6, '2025-12-11 14:08:34'),
	(4, 1, 3, '2025-12-11 14:08:35'),
	(5, 5, 2, '2025-12-11 15:50:23'),
	(6, 5, 4, '2025-12-11 15:50:25'),
	(8, 5, 1, '2025-12-14 15:58:22');

-- A despejar estrutura para tabela matchpoint.inscricoes_torneios
CREATE TABLE IF NOT EXISTS `inscricoes_torneios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `torneio_id` int NOT NULL,
  `data_inscricao` datetime DEFAULT CURRENT_TIMESTAMP,
  `pago` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `torneio_id` (`torneio_id`),
  CONSTRAINT `inscricoes_torneios_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizadores` (`id`),
  CONSTRAINT `inscricoes_torneios_ibfk_2` FOREIGN KEY (`torneio_id`) REFERENCES `torneios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.inscricoes_torneios: ~2 rows (aproximadamente)
INSERT INTO `inscricoes_torneios` (`id`, `user_id`, `torneio_id`, `data_inscricao`, `pago`) VALUES
	(5, 1, 1, '2025-12-11 14:13:44', 0),
	(8, 1, 4, '2025-12-15 13:16:44', 0);

-- A despejar estrutura para tabela matchpoint.mensagens
CREATE TABLE IF NOT EXISTS `mensagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `assunto` varchar(150) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` datetime DEFAULT CURRENT_TIMESTAMP,
  `lida` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.mensagens: ~3 rows (aproximadamente)
INSERT INTO `mensagens` (`id`, `nome`, `email`, `assunto`, `mensagem`, `data_envio`, `lida`) VALUES
	(1, 'tomas', 'tomasbcs@gmail.com', 'Informações Gerais', 'como faço para marcar campo ?', '2025-12-13 17:42:41', 0),
	(2, 'tomas', 'tomasbcs@gmail.com', 'Dúvidas Torneios', 'Como me inscrevo', '2025-12-13 17:47:43', 0),
	(3, 'tomas', 'tomasbcs@gmail.com', 'Informações Gerais', 'duvidas', '2025-12-15 13:56:33', 1);

-- A despejar estrutura para tabela matchpoint.newsletter
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `data_subscricao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.newsletter: ~2 rows (aproximadamente)
INSERT INTO `newsletter` (`id`, `email`, `data_subscricao`) VALUES
	(1, 'tomasbcs@gmail.com', '2025-12-13 17:57:19'),
	(5, 'jonv@gmail.com', '2025-12-14 15:47:35');

-- A despejar estrutura para tabela matchpoint.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `campo_id` int NOT NULL,
  `data_jogo` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `duracao` int NOT NULL DEFAULT '1',
  `preco_total` decimal(10,2) NOT NULL,
  `data_reserva` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `campo_id` (`campo_id`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilizadores` (`id`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`campo_id`) REFERENCES `campos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.reservas: ~6 rows (aproximadamente)
INSERT INTO `reservas` (`id`, `user_id`, `campo_id`, `data_jogo`, `hora_inicio`, `duracao`, `preco_total`, `data_reserva`) VALUES
	(1, 5, 1, '2025-12-17', '09:00:00', 1, 2.50, '2025-12-07 17:40:54'),
	(2, 1, 1, '2025-12-12', '09:00:00', 2, 5.00, '2025-12-10 17:33:16'),
	(4, 5, 1, '2025-12-19', '09:00:00', 1, 2.50, '2025-12-11 16:09:47'),
	(7, 1, 1, '2025-12-16', '16:00:00', 1, 2.50, '2025-12-12 22:25:15'),
	(8, 1, 2, '2025-12-15', '16:00:00', 1, 2.50, '2025-12-13 09:57:34'),
	(9, 5, 2, '2025-12-16', '17:00:00', 1, 2.50, '2025-12-14 12:12:33');

-- A despejar estrutura para tabela matchpoint.torneios
CREATE TABLE IF NOT EXISTS `torneios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `data_evento` date NOT NULL,
  `hora` time NOT NULL,
  `local` varchar(255) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `preco` decimal(10,2) NOT NULL DEFAULT '0.00',
  `imagem` varchar(255) NOT NULL,
  `descricao` text,
  `estado` enum('Aberto','Fechado','Decorrer','Terminado') DEFAULT 'Aberto',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.torneios: ~4 rows (aproximadamente)
INSERT INTO `torneios` (`id`, `nome`, `data_evento`, `hora`, `local`, `nivel`, `preco`, `imagem`, `descricao`, `estado`) VALUES
	(1, 'Open Natal', '2025-12-12', '08:30:00', 'Casal do Esporão', 'Amador', 2.00, 'img/images.jpg', 'Torneio social de Natal 1º colocado ganha um leitão ', 'Terminado'),
	(2, 'Torneio Social', '2025-12-04', '10:00:00', 'Tênis Clube Viseu', 'Amador', 5.00, 'img/2ªimagem de fundo.jpg', 'Torneio de aperfeiçoamento ', 'Terminado'),
	(3, 'Open Natal do Dão ', '2025-12-19', '08:00:00', 'Tênis Clube Viseu', 'Amador', 1.00, 'img/imagem_2ºplano.jpg', 'Torneio para todos os níveis  ', 'Aberto'),
	(4, 'Torneio Social ', '2025-12-16', '10:30:00', 'Campo Vila Jardim ', 'Amador', 2.50, 'img/imagem_background.jpeg', 'Torneio Social ', 'Aberto');

-- A despejar estrutura para tabela matchpoint.utilizadores
CREATE TABLE IF NOT EXISTS `utilizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `telemovel` varchar(20) DEFAULT NULL,
  `data_registo` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela matchpoint.utilizadores: ~5 rows (aproximadamente)
INSERT INTO `utilizadores` (`id`, `nome`, `email`, `password`, `data_nascimento`, `genero`, `pais`, `telemovel`, `data_registo`, `is_admin`) VALUES
	(1, 'tomas', 'tomasbcs@gmail.com', '$2y$10$fN3MRwimDxLTh6W5f6z/QeudEVtyXqX1lL5MtcmmAt2W9P6jGtzHa', NULL, 'Masculino', 'Portugal', NULL, '2025-12-05 18:46:58', 1),
	(2, 'Rodrigo', 'rodigof@gmail.com', '$2y$10$pALDRHpkuuIDr25IniU8wOVr8.0Zge4GEcd6IRp3TrIKM1fjWEnNi', NULL, 'Masculino', 'Portugal', NULL, '2025-12-07 12:00:01', 0),
	(3, 'João', 'joaocbs@gmail.com', '$2y$10$406PoC8mwYayGkq.aYygiu9d9k4dGrsoXf.zWBzZ584SCGpTZ.DqK', '2022-03-05', 'Masculino', 'Portugal', NULL, '2025-12-07 16:04:02', 0),
	(4, 'Tomás Moreira', 'tomascbs@gmail.com', '$2y$10$/pHGsTFOWm7v6b7q/CSRG.oYElckkI18h.I92gebPiTOM2WvX00HK', '2005-06-10', 'Masculino', 'Portugal', NULL, '2025-12-07 17:34:54', 0),
	(5, 'joao virgilio', 'jonv@gmail.com', '$2y$10$B.cxyRHY1zW4liZXHApX9OIvIUWTltyUg8NgY9rgyZAN2Y8YG65a.', '2004-10-10', 'Outro', 'Portugal', NULL, '2025-12-07 17:40:19', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
