SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+02:00";


--
-- Base de données : `Raito`
--

CREATE DATABASE IF NOT EXISTS Raito;
USE Raito;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` smallint(6) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Eau'),
(2, 'Oiseaux'),
(3, 'Foret'),
(4, 'Feu'),
(5, 'Ambiance');

--
-- Table structure for table `ambiance`
--

CREATE TABLE `ambiance` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `id_category` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `duration` decimal(2,1) NOT NULL,
  `music_url` varchar(200) NOT NULL,
  `image_url` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `author` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ambiance`
--
SET NAMES utf8;
INSERT INTO `ambiance` VALUES
(1,'Oiseau',2,1,6.4,'https://raitohetic.s3.eu-west-3.amazonaws.com/Birds.wav','https://raitohetic.s3.eu-west-3.amazonaws.com/Component_10.svg',"Détendez-vous au doux son des oiseaux de cette forêt verdoyante. Relaxant et rafraichissant, laissez-vous porter... ",1),
(2,'Feu',4,1,0.4,'https://raitohetic.s3.eu-west-3.amazonaws.com/FIREBurn.wav','https://raitohetic.s3.eu-west-3.amazonaws.com/Component_1.svg',"Crépitez au son de la flamme. Apaisez vous avec ce doux son rappelant le chocolat chaud et l'hiver ...",1),
(3,'Eau',1,1,2.2,'https://raitohetic.s3.eu-west-3.amazonaws.com/WATERWave.wav','https://raitohetic.s3.eu-west-3.amazonaws.com/Component_3.svg',"Besoin de vous reconnecter à la nature ? Plongez-vous dans une ambiance de calme et de sérénité ...",1),
(4,'Foret',3,1,1.1,'https://raitohetic.s3.eu-west-3.amazonaws.com/Forest.wav','https://raitohetic.s3.eu-west-3.amazonaws.com/Component_2.svg',"Que diriez vous d'une balade en forêt? Laissez vous emporter par le son des feuilles qui craquellent ...",1);


--
-- Table structure for table `exercice`
--

DROP TABLE IF EXISTS `exercice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;

CREATE TABLE `exercice` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `duration` decimal(2,1) NOT NULL,
  `voice_duration` decimal(2,1) NOT NULL,
  `rise_duration` decimal(2,1) DEFAULT NULL,
  `fall_duration` decimal(2,1) DEFAULT NULL,
  `high_intensity` decimal(2,1) DEFAULT NULL,
  `low_intencity` decimal(2,1) DEFAULT NULL,
  `color` varchar(10) NOT NULL,
  `url_music` varchar(200) NOT NULL,
  `url_image` varchar(200) NOT NULL,
  `note` decimal(3,1) DEFAULT NULL,
  `nb_note` int(5) DEFAULT NULL,
  `id_user` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Structure de la table `content_type`
--

CREATE TABLE `content_type` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `content_type`
--

INSERT INTO `content_type` (`id`, `name`) VALUES
(1, 'Exercice'),
(2, 'Ambiance');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(120) DEFAULT NULL,
  `id_role` tinyint(4) DEFAULT NULL,
  `nb_creation` smallint(6) DEFAULT NULL,
  `date_inscription` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Premium'),
(3, 'Partner'),
(4, 'Admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `content`
--

-- Index pour la table `content_type`
--
ALTER TABLE `content_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `content`
--

-- AUTO_INCREMENT pour la table `content_type`
--
ALTER TABLE `content_type`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
