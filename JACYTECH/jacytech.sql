-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2021 at 04:23 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jacytech`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'horror'),
(2, 'science'),
(3, 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `manuscript`
--

CREATE TABLE `manuscript` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `abstract` longtext NOT NULL,
  `type` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL,
  `authorID` int(11) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'pendingManuscriptApproval',
  `reason` longtext NOT NULL,
  `created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `overallRating` decimal(10,2) NOT NULL,
  `overallComment` longtext NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `journalID` int(11) DEFAULT NULL,
  `hardcopy` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manuscript`
--

INSERT INTO `manuscript` (`id`, `title`, `abstract`, `type`, `file`, `authorID`, `status`, `reason`, `created_At`, `updated_At`, `overallRating`, `overallComment`, `paid`, `journalID`, `hardcopy`) VALUES
(1, 'The Horror in the Museum and Other Revisions', 'The Horror in the Museum and Other Revisions is a collection of stories revised or ghostwritten by American author H. P. Lovecraft. It was originally published in 1970 by Arkham House in an edition of 4,058 copies. The dustjacket of the first edition features art by Gahan Wilson. ', 'horror', '14-11-2021_09-55-32capture1-png.PNG', 1, 'pendingReviewApproval', '1', '2021-11-12 07:05:53', '2021-11-12 07:05:53', '2.50', 'Not Good\r\nBad\r\n', 0, NULL, 1),
(5, 'Sixty Years of Arkham House', 'The world\'s foremost Lovecraftian scholar, and editor of several important Arkham anthologies, has dug deep into the Arkham House archives to bring you a definitive bibliography of all the books we have published over the past 60 years. S.T. Joshi presents this important work in an easy-to-read format which allows collectors to quickly find the information they need. Many footnotes, critical commentary, and a brief history of Arkham House round out this fact-filled, 300 page volume.', 'horror', '13-11-2021_05-22-54success-gif.gif', 1, 'reject', '1212', '2021-11-13 04:22:54', '2021-11-13 04:22:54', '0.00', '0.00', 0, NULL, 0),
(6, 'At the Mountains of Madness and Other Macabre Tales', 'A complete short novel, AT THE MOUNTAINS OF MADNESS is a tale of terror unilke any other. The Barren, windswept interior of the Antarctic plateau was lifeless--or so the expedition from Miskatonic University thought. Then they found the strange fossils of unheard-of creatures...and the carved stones tens of millions of years old...and, finally, the mind-blasting terror of the City of the Old Ones. Three additional strange tales, written as only H.P. Lovecraft can write, are also included in this macabre collection of the strange and the weird.', 'horror', '14-11-2021_01-58-33capture1-png.PNG', 1, 'reject', '', '2021-11-13 17:58:33', '2021-11-13 17:58:33', '0.00', '0.00', 0, NULL, 0),
(7, 'Call of Cthulhu: Horror Roleplaying', 'CALL OF CTHULHU is Chaosium\'s classic roleplaying game of Lovecraftian horror in which ordinary people are confronted by the terrifying and alien forces of the Cthulhu Mythos. CALL OF CTHULHU uses Chaosium\'s Basic Roleplaying System, easy to learn and quick to play. This bestseller has won dozens of game-industry awards and is a member of the Academy of Adventure Game Design Hall of Fame. In 2001 CALL OF CTHULHU celebrated its 20th anniversary. In 2003 CALL OF CTHULHU was voted the #1 Gothic/Horror RPG of all time by the Gaming Report.com community. CALL OF CTHULHU is well-supported by an ever-growing line of high quality game supplements. This is the softcover 6th edition of this classic horror game, completely compatible with all of previous editions and supplements for CALL OF CTHULHU. This is a complete roleplaying game in one volume. All you need to play is this book, some dice, imagination, and your friends.', 'science', '14-11-2021_11-46-532-txt.txt', 1, 'publish', '', '2021-11-14 03:31:16', '2021-11-14 03:31:16', '7.00', '121212    \r\n1121212\r\n', 1, NULL, 1),
(8, 'Harmon, Maurice. The Dialogue of the Ancients of Ireland', 'Harmon, Maurice. The Dialogue of the Ancients of Ireland. (Translated with introduction and notes). Dublin: Carysfort Press,2009. 188 pp.', 'science', '14-11-2021_16-18-58harmon_maurice_the_dialogue_of_the_ancients_of_ire-pdf.pdf', 1, 'publish', '', '2021-11-14 08:18:58', '2021-11-14 08:18:58', '8.00', 'subarashi\r\nNot Bad\r\n', 1, NULL, 1),
(9, 'The Death of Jane Lawrence', 'Practical, unassuming Jane Shoringfield has done the calculations, and decided that the most secure path forward is this: a husband, in a marriage of convenience, who will allow her to remain independent and occupied with meaningful work. Her first choice, the dashing but reclusive doctor Augustine Lawrence, agrees to her proposal with only one condition: that she must never visit Lindridge Hall, his crumbling family manor outside of town. Yet on their wedding night, an accident strands her at his door in a pitch-black rainstorm, and she finds him changed. Gone is the bold, courageous surgeon, and in his place is a terrified, paranoid man—one who cannot tell reality from nightmare, and fears Jane is an apparition, come to haunt him.', 'horror', '14-11-2021_17-59-59the-death-of-jane-lawrence-pdf.pdf', 1, 'publish', '', '2021-11-14 08:48:02', '2021-11-14 08:48:02', '7.50', '    The crumbling manor at Lindridge Hall hides a deadly secret, one that will be unearthed when its new mistress steps over the threshold. Jane Shoringfield is nothing short of practical, and having reached the end of her living period with her guardians, decides that the most logical way forward will be to secure herself a husband. The chosen candidate for this transaction is the reclusive, yet handsome, doctor Augustine, whose profession may provide her with the very independence that she requires. Augustine agrees to this marriage of convenience, on the agreement that Jane never set foot in Lindridge Hall, his family estate just outside of town. Nonetheless, on the night of their wedding, a chance storm leaves her stranded and Jane is forced to return to the manor. When she arrives, she finds the demeanor of her husband gone, and in its place a frightened and paranoid man unable to discern reality from fiction. Morning comes, and Augustine is himself again, but Jane knows deep within her bones that something is horribly wrong with her husband and the house she now occupies. A profound fear only magnified by her continued stay within the manor\'s walls.\r\n\r\nPlaced within the realm of Crimson Peak, Rebecca, and Shirley Jackson, The Death of Jane Lawrence is an impressive gothic horror novel that fucked with my mind in the best way possible. Set in a dark version of Post-War England, packed full of supernatural and spooky vibes, this is one of the most brilliant and unnerving books that I have read all year. Part of the journey with this novel is in just how much it upends what is understood at any given moment. I started this off scared of the Crimson Peak comparison, and that feeling really never went away because of how often the book turned all of my expectations on their head. The first section is ominous, hung over with impending dread that is drawn out like poison from a wound upon the first occurrence with Jane and Augustine at the manor. This was reminiscent of so many Gothic novels of the past, that sudden shift in tone from an incident, that traverses through to the end of the narrative. There was an unsteady ground between Jane and Augustine present in the first half, as both characters were hiding secrets from the other. Altogether, I loved not really knowing who to put trust in, as I fell into the book\'s rhythm to be entirely unpredictable. Past the first half of the novel is where the atmosphere twists into something slightly enigmatic. This is where I puzzled with the text a bit more and was left completely shattered by the end results. A tangled web that I endeavored to take apart in order to make sense of it all. While I will say this section could have been pared down, at that point, it was like the top of a rollercoaster and I was just along for the rest of the ride. In every respect, Caitlin Starling has created a haunting tale, charged with callbacks to iconic gothic fiction of days past. The Death of Jane Lawrence is an eerily brilliant novel that bends reality and twists the mind towards its breaking point.\r\n    If I had to describe the book in three words, I would say: math, magic, and drugs; thus you get The Death of Jane Lawrence!\r\n\r\nI liked the little nods to classic gothic lit tropes and novels/movies, such as Rebecca and Crimson Peak but I wasn\'t fully on board with this book. Don\'t get me wrong, Starling nailed the creepy atmosphere but the plot got too confusing and convoluted for my liking. If it was executed better, I would have rated this higher.\r\n\r\nThe prose was the defining part of the novel and it was lovely, but the descriptive writing soon became redundant. The story dragged until the 50% mark and then it started to go in circles. The book could have easily been condensed without losing any of its meaning.\r\n\r\nI liked how the book delved into the occult and it went in a direction I was not expecting but it got too meta for my brain to comprehend. Using mathematical theorems, particularly the number “zero” signifying “everything and nothing” was such a fascinating way to describe a magic system, but I felt that Starling could have explained it more. Or maybe I\'m just dumb as rocks and didn\'t understand a thing.\r\n\r\nEither way, it was a solid horror with a likable and smart protagonist. I’m not the person for this book but I’m sure there are readers out there who will love this!\r\n', 1, NULL, 1),
(10, '1', '2', 'horror', '14-11-2021_17-20-13capture1-png.PNG', 1, 'pendingManuscriptApproval', '', '2021-11-14 09:20:13', '2021-11-14 09:20:13', '0.00', '', 0, NULL, 0),
(11, 'test', 'test', 'horror', '18-11-2021_10-47-2014-11-2021_01-58-33capture1-png-png.png', 1, 'publish', '', '2021-11-18 02:44:06', '2021-11-18 02:44:06', '7.00', '  Good\r\n    Not bad\r\n', 1, NULL, 1),
(12, 'test2', 'test2', 'Fiction', '18-11-2021_10-50-0318-11-2021_10-44-06public-health-services-codebook_data-guide_metadata_10-2-19-1-xlsx-xlsx.xlsx', 1, 'pendingAssign', '', '2021-11-18 02:50:03', '2021-11-18 02:50:03', '0.00', '', 0, NULL, 0),
(13, 'test3', 'test3', 'horror', '18-11-2021_10-51-04csci334_g14-presentationslide-updated-1-pptx.pptx', 1, 'pendingReviewApproval', '', '2021-11-18 02:51:04', '2021-11-18 02:51:04', '0.00', '', 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `reviewerID` int(11) NOT NULL,
  `manuscriptID` int(11) NOT NULL,
  `rating` decimal(10,2) NOT NULL,
  `comment` longtext NOT NULL,
  `created_At` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(200) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `reviewerID`, `manuscriptID`, `rating`, `comment`, `created_At`, `status`) VALUES
(1, 4, 1, '5.00', '121212', '2021-11-12 10:23:47', 'complete'),
(4, 3, 1, '5.00', '121212', '2021-11-14 02:23:13', 'complete'),
(5, 5, 7, '7.00', '121212    ', '2021-11-14 03:35:09', 'complete'),
(6, 6, 7, '7.00', '1121212', '2021-11-14 03:40:26', 'complete'),
(7, 5, 8, '9.00', 'subarashi', '2021-11-14 08:36:47', 'complete'),
(8, 6, 8, '7.00', 'Not Bad', '2021-11-14 08:38:51', 'complete'),
(9, 3, 9, '8.00', '    The crumbling manor at Lindridge Hall hides a deadly secret, one that will be unearthed when its new mistress steps over the threshold. Jane Shoringfield is nothing short of practical, and having reached the end of her living period with her guardians, decides that the most logical way forward will be to secure herself a husband. The chosen candidate for this transaction is the reclusive, yet handsome, doctor Augustine, whose profession may provide her with the very independence that she requires. Augustine agrees to this marriage of convenience, on the agreement that Jane never set foot in Lindridge Hall, his family estate just outside of town. Nonetheless, on the night of their wedding, a chance storm leaves her stranded and Jane is forced to return to the manor. When she arrives, she finds the demeanor of her husband gone, and in its place a frightened and paranoid man unable to discern reality from fiction. Morning comes, and Augustine is himself again, but Jane knows deep within her bones that something is horribly wrong with her husband and the house she now occupies. A profound fear only magnified by her continued stay within the manor\'s walls.\n\nPlaced within the realm of Crimson Peak, Rebecca, and Shirley Jackson, The Death of Jane Lawrence is an impressive gothic horror novel that fucked with my mind in the best way possible. Set in a dark version of Post-War England, packed full of supernatural and spooky vibes, this is one of the most brilliant and unnerving books that I have read all year. Part of the journey with this novel is in just how much it upends what is understood at any given moment. I started this off scared of the Crimson Peak comparison, and that feeling really never went away because of how often the book turned all of my expectations on their head. The first section is ominous, hung over with impending dread that is drawn out like poison from a wound upon the first occurrence with Jane and Augustine at the manor. This was reminiscent of so many Gothic novels of the past, that sudden shift in tone from an incident, that traverses through to the end of the narrative. There was an unsteady ground between Jane and Augustine present in the first half, as both characters were hiding secrets from the other. Altogether, I loved not really knowing who to put trust in, as I fell into the book\'s rhythm to be entirely unpredictable. Past the first half of the novel is where the atmosphere twists into something slightly enigmatic. This is where I puzzled with the text a bit more and was left completely shattered by the end results. A tangled web that I endeavored to take apart in order to make sense of it all. While I will say this section could have been pared down, at that point, it was like the top of a rollercoaster and I was just along for the rest of the ride. In every respect, Caitlin Starling has created a haunting tale, charged with callbacks to iconic gothic fiction of days past. The Death of Jane Lawrence is an eerily brilliant novel that bends reality and twists the mind towards its breaking point.', '2021-11-14 08:52:10', 'complete'),
(10, 4, 9, '7.00', '    If I had to describe the book in three words, I would say: math, magic, and drugs; thus you get The Death of Jane Lawrence!\n\nI liked the little nods to classic gothic lit tropes and novels/movies, such as Rebecca and Crimson Peak but I wasn\'t fully on board with this book. Don\'t get me wrong, Starling nailed the creepy atmosphere but the plot got too confusing and convoluted for my liking. If it was executed better, I would have rated this higher.\n\nThe prose was the defining part of the novel and it was lovely, but the descriptive writing soon became redundant. The story dragged until the 50% mark and then it started to go in circles. The book could have easily been condensed without losing any of its meaning.\n\nI liked how the book delved into the occult and it went in a direction I was not expecting but it got too meta for my brain to comprehend. Using mathematical theorems, particularly the number “zero” signifying “everything and nothing” was such a fascinating way to describe a magic system, but I felt that Starling could have explained it more. Or maybe I\'m just dumb as rocks and didn\'t understand a thing.\n\nEither way, it was a solid horror with a likable and smart protagonist. I’m not the person for this book but I’m sure there are readers out there who will love this!', '2021-11-14 08:52:11', 'complete'),
(11, 3, 11, '7.00', '  Good', '2021-11-18 02:44:54', 'complete'),
(12, 4, 11, '7.00', '    Not bad', '2021-11-18 02:44:57', 'complete'),
(13, 3, 13, '8.00', '    Good', '2021-11-18 02:51:25', 'complete'),
(14, 4, 13, '1.00', '    VeryBad', '2021-11-18 02:51:25', 'complete'),
(15, 5, 13, '1.00', '    Bad', '2021-11-18 02:53:01', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `position` varchar(200) NOT NULL,
  `expertise` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `name`, `password`, `email`, `contact`, `position`, `expertise`) VALUES
(1, 'cheah', '$2y$10$ZuqBzEYSNEswIvjzf8lj4uwFF.ZZ8Adggfu45bzBk98tFRg33jRSi', 'csq3411@gmail.com', '0145623844', 'author', NULL),
(2, 'Lim Ching Kim', '$2y$10$N.a0QhENYd/6ppbiEzB75u5bRg3vyhBQSqzw5vUEiaPEwPzpHsOve', 'lck9487@g.co', '0118445223', 'editor', NULL),
(3, 'Shang Kim Chi', '$2y$10$x7tPQNOvh35kFwcxY6CgiOrt.MpUj5z1uajfZdf0d1TUaoO6b5y/K', 'skc542@g.co', '0148903684', 'reviewer', 'horror'),
(4, 'Alexus Sage', '$2y$10$F1IF2uMr8d2NqzrwRsnItOZYBEosJ/tMRkJw4rZIlXvcYFH8jnDiC', 'AlexusSage@g.co', '0172768729', 'reviewer', 'horror'),
(5, 'Janene Rosalie', '$2y$10$F1IF2uMr8d2NqzrwRsnItOZYBEosJ/tMRkJw4rZIlXvcYFH8jnDiC', 'JaneneRosalie@g.co', '0404583700', 'reviewer', 'science'),
(6, 'Jacqueline Katherine', '$2y$10$F1IF2uMr8d2NqzrwRsnItOZYBEosJ/tMRkJw4rZIlXvcYFH8jnDiC', 'JacquelineKatherine@g.co', '0199626900', 'reviewer', 'science'),
(7, 'Jacky Su Leh Hong', '$2y$10$isX8lRGotoroIGv/ApfgeOoXr9/PtX2azx7CFG2q2qtfhwaSn63F2', 'jackychan8223@gmail.com', '0115486631', 'author', NULL),
(15, 'Test1234', '$2y$10$nVn7quUnszmAiqR.LdVr0uSmIANShvM9v8q3/GXyA5zPOTAs/t2ju', '12@g.co', '011564676631', 'reviewer', 'Fiction');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `token` varchar(500) NOT NULL,
  `email` varchar(320) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `token`, `email`, `createdAt`) VALUES
(9, '1161d92f2e0e80a11ca9e06f116d6c9a', 'csq3411@gmail.com', '2021-11-14 09:09:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manuscript`
--
ALTER TABLE `manuscript`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manuscript`
--
ALTER TABLE `manuscript`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
