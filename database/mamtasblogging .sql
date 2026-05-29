-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2026 at 01:29 PM
-- Server version: 8.0.46
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mamtasblogging`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$bdzMY4KTANT7RgHX.Lnypugf.aJ6obOG/2mKMLWj7hNL417v6exJ6');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `video_id` int DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int NOT NULL,
  `video_id` int DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `video_id`, `type`) VALUES
(3, 7, 'dislike'),
(4, 7, 'like'),
(5, 8, 'dislike');

-- --------------------------------------------------------

--
-- Table structure for table `social_links`
--

CREATE TABLE `social_links` (
  `id` int NOT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `social_links`
--

INSERT INTO `social_links` (`id`, `youtube`, `facebook`, `instagram`) VALUES
(1, 'https://youtube.com/', 'https://facebook.com/', 'https://instagram.com/');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `story` text,
  `youtube_link` text,
  `thumbnail` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `views` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') DEFAULT 'published',
  `is_featured` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `tagline`, `story`, `youtube_link`, `thumbnail`, `category`, `views`, `created_at`, `slug`, `status`, `is_featured`) VALUES
(2, 'Kanan Pendari', 'Animal', 'एक समय की बात है, Kanan Pendari Zoo के घने पेड़ों और शांत रास्तों के बीच एक छोटा हिरण रहता था, जिसका नाम था “चीकू”।\r\n\r\nचीकू बाकी जानवरों से थोड़ा अलग था। उसे जंगल की हर आवाज़ में संगीत सुनाई देता था — पक्षियों की चहचहाहट, पत्तों की सरसराहट और बारिश की बूंदों की टप-टप।', 'https://www.youtube.com/watch?v=TPOi-JuUkKA', 'WhatsApp Image 2023-09-08 at 14.02.24 (1).jpeg', 'Long Video', 1, '2026-05-26 10:11:28', 'kanan-pendari', 'published', 0),
(3, 'Jatmai Mata', 'Jai Mata Di', 'Jatmai Mata Temple छत्तीसगढ़ के घने जंगलों और पहाड़ियों के बीच स्थित एक प्रसिद्ध धार्मिक और प्राकृतिक स्थल है। यह मंदिर माता जतमई को समर्पित है और अपनी शांत व प्राकृतिक सुंदरता के लिए जाना जाता है।\r\n\r\nबरसात के मौसम में यहां का झरना और हरियाली इस जगह को और भी आकर्षक बना देते हैं। दूर-दूर से श्रद्धालु और पर्यटक माता के दर्शन और प्रकृति का आनंद लेने आते हैं।', 'https://www.youtube.com/watch?v=yo7URUpxlk0', 'WhatsApp Image 2023-09-08 at 14.02.26.jpeg', 'Medium Video', 13, '2026-05-26 10:13:14', 'jatmai-mata', 'published', 0),
(4, 'Rukmani Mata', 'Gujrat Explore', 'Rukmani Mata Temple श्रद्धा, शांति और आस्था का एक सुंदर केंद्र माना जाता है। पहाड़ियों और प्राकृतिक वातावरण के बीच स्थित यह मंदिर भक्तों को आध्यात्मिक सुकून देता है। यहां आने वाले लोग माता रुक्मणी से सुख, समृद्धि और परिवार की खुशहाली की प्रार्थना करते हैं।', 'https://www.youtube.com/shorts/1sgjIo1EDIk', 'WhatsApp Image 2023-09-08 at 14.02.24 (1).jpeg', 'Short Video', 35, '2026-05-26 10:14:56', 'rukmani-mata', 'published', 0),
(6, 'गया के महाबोधि मंदिर की अद्भुत कहानी | जहाँ बुद्ध को ज्ञान मिला', '#MahabodhiTemple #BodhGaya #Gaya #Buddha #BuddhistTemple #BiharTourism #TempleStory', 'Mahabodhi Temple भारत के सबसे पवित्र बौद्ध स्थलों में से एक है। मान्यता है कि यहीं पर राजकुमार सिद्धार्थ ने कठोर तपस्या और ध्यान के बाद ज्ञान प्राप्त किया और वे भगवान बुद्ध बने।\r\n\r\nबहुत समय पहले सिद्धार्थ सत्य की खोज में अपने महल और सुख-सुविधाएँ छोड़कर निकल पड़े। कई वर्षों तक तपस्या करने के बाद वे गया के एक पीपल वृक्ष के नीचे ध्यान में बैठ गए। उन्होंने संकल्प लिया कि जब तक सत्य की प्राप्ति नहीं होगी, तब तक वे वहाँ से नहीं उठेंगे।\r\n\r\nकई दिनों की गहरी साधना के बाद वैशाख पूर्णिमा की रात उन्हें ज्ञान प्राप्त हुआ। उसी पवित्र वृक्ष को आज “बोधि वृक्ष” कहा जाता है। बाद में सम्राट अशोक ने इस स्थान की महिमा को देखकर यहाँ भव्य मंदिर का निर्माण करवाया।\r\n\r\nआज यह मंदिर पूरी दुनिया के बौद्ध श्रद्धालुओं के लिए आस्था का केंद्र है। दूर-दूर से लोग यहाँ ध्यान लगाने, शांति पाने और भगवान बुद्ध के संदेश को महसूस करने आते हैं। UNESCO ने भी इसे विश्व धरोहर स्थल घोषित किया है।', 'https://www.youtube.com/watch?v=V2QluotrmTI', 'WhatsApp Image 2023-09-08 at 14.02.22.jpeg', 'Medium Video', 9, '2026-05-26 13:25:52', 'mahabodhi-temple', 'published', 1),
(7, 'कौन हैं भगवान विश्वकर्मा? | विश्वकर्मा पूजा विशेष', '#VishwakarmaPuja #भगवानविश्वकर्मा #SanatanDharma #HinduFestival', 'Vishwakarma Puja हिंदू धर्म का एक विशेष पर्व है, जिसे भगवान विश्वकर्मा की पूजा के रूप में मनाया जाता है। भगवान विश्वकर्मा को देवताओं का दिव्य शिल्पकार और वास्तुकार माना जाता है। कहा जाता है कि उन्होंने स्वर्ग लोक, भगवान कृष्ण की द्वारका नगरी, और पांडवों के लिए इंद्रप्रस्थ जैसे भव्य नगरों का निर्माण किया था।\r\n\r\nपुराणों के अनुसार, जब देवताओं को अद्भुत महल, अस्त्र-शस्त्र और रथों की आवश्यकता पड़ी, तब भगवान विश्वकर्मा ने अपनी दिव्य कला और ज्ञान से सब कुछ तैयार किया। उनकी बनाई वस्तुएँ इतनी सुंदर और शक्तिशाली थीं कि देवता भी आश्चर्यचकित रह जाते थे।', 'https://www.youtube.com/watch?v=RNwhIa7y9Ao', 'WhatsApp Image 2023-09-08 at 14.02.22 (2).jpeg', 'Short Video', 38, '2026-05-26 13:27:20', 'vishwakarma-puja', 'published', 0),
(8, 'गणेश पूजा की अद्भुत कहानी | प्रथम पूज्य भगवान गणेश', '#GaneshPuja #GaneshChaturthi #LordGanesha #गणेशजी #GanpatiBappa #SanatanDharma #HinduFestival #HindiStory', 'Vishwakarma Puja हिंदू धर्म का एक विशेष पर्व है, जिसे भगवान विश्वकर्मा की पूजा के रूप में मनाया जाता है। भगवान विश्वकर्मा को देवताओं का दिव्य शिल्पकार और वास्तुकार माना जाता है। कहा जाता है कि उन्होंने स्वर्ग लोक, भगवान कृष्ण की द्वारका नगरी, और पांडवों के लिए इंद्रप्रस्थ जैसे भव्य नगरों का निर्माण किया था।\r\n\r\nपुराणों के अनुसार, जब देवताओं को अद्भुत महल, अस्त्र-शस्त्र और रथों की आवश्यकता पड़ी, तब भगवान विश्वकर्मा ने अपनी दिव्य कला और ज्ञान से सब कुछ तैयार किया। उनकी बनाई वस्तुएँ इतनी सुंदर और शक्तिशाली थीं कि देवता भी आश्चर्यचकित रह जाते थे।\r\n\r\nइसी कारण आज भी कारखानों, दुकानों, मशीनों और औजारों की पूजा की जाती है। लोग मानते हैं कि भगवान विश्वकर्मा की कृपा से कार्य में सफलता, उन्नति और सुरक्षा मिलती है। इस दिन लोग अपने कार्यस्थल को सजाते हैं और श्रद्धा से पूजा-अर्चना करते हैं।\r\n\r\nभगवान विश्वकर्मा केवल निर्माण के देवता ही नहीं, बल्कि मेहनत, कला और सृजन शक्ति के प्रतीक भी माने जाते हैं। उनका संदेश है कि ईमानदारी और कौशल से किया गया कार्य ही सच्ची पूजा है।', 'https://www.youtube.com/watch?v=S5DKhahziS4', 'WhatsApp Image 2023-09-08 at 14.02.22 (1).jpeg', 'Medium Video', 13, '2026-05-26 13:29:57', 'ganesh-puja', 'published', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
