-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for s-dds
CREATE DATABASE IF NOT EXISTS `s-dds` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `s-dds`;

-- Dumping structure for table s-dds.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `disorder_category` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `question_id` varchar(10) NOT NULL,
  `question_text` text NOT NULL,
  `question_weight` decimal(2,2) NOT NULL DEFAULT '0.00',
  `question_phrase` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table s-dds.questions: ~102 rows (approximately)
INSERT INTO `questions` (`id`, `disorder_category`, `question_id`, `question_text`, `question_weight`, `question_phrase`) VALUES
	(1, 'mdd', 'mdd-1', 'Over the past 2 weeks, have you experienced a depressed mood most of the day, nearly every day?', 0.20, 'phrase-1'),
	(2, 'mdd', 'mdd-2', 'Over the past 2 weeks, have you noticed a significant loss of interest or pleasure in activities you previously enjoyed?', 0.20, 'phrase-1'),
	(3, 'apd', 'apd-1', 'Have you repeatedly engaged in behaviors that could get you arrested, such as breaking laws or committing crimes, since age 15?', 0.20, 'phrase-1'),
	(4, 'apd', 'apd-2', 'Do you often lie, use fake identities/aliases, or manipulate others for personal gain or enjoyment?', 0.20, 'phrase-1'),
	(5, 'ed', 'ed-1', 'Do you repeatedly wet the bed or soil your clothes with urine, whether involuntarily or on purpose?', 0.20, 'phrase-1'),
	(6, 'ed', 'ed-2', 'How frequently does the bed/clothing wetting occur (daily, weekly, etc.)? Has it happened at least twice a week for the last 3 consecutive months?', 0.20, 'phrase-1'),
	(7, 'dd', 'dd-1', 'Do you currently hold any false beliefs that seem irrational or untrue to others, even when presented with contradictory evidence?', 0.20, 'phrase-1'),
	(8, 'dd', 'dd-1', 'How long have you had these delusional beliefs? Have they persisted for at least 1 month?', 0.20, 'phrase-1'),
	(9, 'bpd', 'bpd-1', 'Have you recently experienced any of the following: 1. Delusions (false fixed beliefs) 2. Hallucinations (seeing, hearing, or experiencing things not really there) 3. Disorganized/incoherent speech 4. Grossly disorganized behavior or catatonia', 0.20, 'phrase-1'),
	(10, 'bpd', 'bpd-2', 'Prior to this episode, were you generally functioning well in your daily life?', 0.20, 'phrase-1'),
	(11, 'sp', 'sp-1', 'Do you experience intense fear or anxiety about a specific object or situation (e.g. flying, heights, animals, injections, blood)?', 0.20, 'phrase-1'),
	(12, 'sp', 'sp-2', 'Does encountering or thinking about this object/situation almost always provoke immediate fear/anxiety for you?', 0.20, 'phrase-1'),
	(13, 'pd', 'pd-1', 'Have you experienced recurrent, unexpected panic attacks - sudden surges of intense fear/discomfort that peak within minutes?', 0.20, 'phrase-1'),
	(14, 'pd', 'pd-3', 'After experiencing a panic attack, did you have at least 1 month of: 1. Persistent worry about having more attacks or their consequences (losing control, dying, etc.) 2. Significant changes in behavior to avoid panic attacks (avoiding exercise, unfamiliar situations, etc.)?', 0.20, 'phrase-1'),
	(15, 'odd', 'oddi-1', 'Do you often lose your temper?', 0.20, 'phrase-1a'),
	(16, 'odd', 'oddi-2', 'Would you describe yourself as touchy or easily annoyed by things?', 0.20, 'phrase-1a'),
	(17, 'gd', 'gda-1', 'Do you feel a marked incongruence between your experienced/expressed gender and your biological sexual characteristics?', 0.20, 'phrase-1a'),
	(18, 'gd', 'gda-2', 'Do you have a strong desire to be rid of your primary and/or secondary sex characteristics?', 0.20, 'phrase-1a'),
	(19, 'dmdd', 'dmdd-1', 'Do you experience severe temper outbursts that seem excessive or out of proportion to the situation, involving verbal rages or physical aggression towards people/property?', 0.20, 'phrase-1c'),
	(20, 'dmdd', 'dmdd-2', 'Are these temper outbursts inappropriate for your developmental age/level?', 0.20, 'phrase-1c'),
	(21, 'gd', 'gdc-1', 'Do you have a strong desire to be the opposite gender or insist that you are a gender different from the one assigned at birth?', 0.20, 'phrase-1c'),
	(22, 'gd', 'gdc-2', 'If you were assigned male at birth, do you have a strong preference for cross-dressing or simulating female attire?', 0.20, 'phrase-1c'),
	(23, 'mdd', 'mdd-3', 'Over the past 2 weeks, have you experienced any significant weight changes or changes in appetite?', 0.20, 'phrase-2'),
	(24, 'mdd', 'mdd-4', 'Over the past 2 weeks, have you had trouble sleeping (either sleeping too much or too little)?', 0.20, 'phrase-2'),
	(25, 'apd', 'apd-3', 'Would you describe yourself as impulsive or as someone who fails to plan ahead?', 0.20, 'phrase-2'),
	(26, 'apd', 'apd-4', 'Do you frequently get into physical fights or assault others when irritated or aggressive?', 0.20, 'phrase-2'),
	(27, 'ed', 'ed-3', 'Does the bed/clothing wetting cause you significant distress or impairment in your social life, academics/occupation, or other important areas of functioning?', 0.20, 'phrase-2'),
	(28, 'ed', 'ed-4', 'Are you currently taking any medications or substances that could be causing increased urination (diuretics, antipsychotics, etc.)?', 0.20, 'phrase-2'),
	(29, 'dd', 'dd-3', 'Have you ever experienced symptoms like disorganized speech, grossly disorganized behavior, negative symptoms (diminished emotional expression/avolition) for a significant portion of time?', 0.20, 'phrase-2'),
	(30, 'dd', 'dd-4', 'Are your delusional beliefs accompanied by prominent hallucinations (seeing, hearing, feeling things that aren\'t really there) that don\'t relate to the delusional theme?', 0.20, 'phrase-2'),
	(31, 'bpd', 'bpd-3', 'Are you currently experiencing a major depressive or manic/bipolar episode with psychotic features?', 0.20, 'phrase-2'),
	(32, 'bpd', 'bpd-4', 'Have you ever been diagnosed with a psychotic disorder like schizophrenia?', 0.20, 'phrase-2'),
	(33, 'sp', 'sp-3', 'Do you actively try to avoid the object/situation you fear, or do you endure it but with intense fear/anxiety?', 0.20, 'phrase-2'),
	(34, 'sp', 'sp-4', 'Would you say your level of fear is out of proportion to the actual danger posed by this object/situation?', 0.20, 'phrase-2'),
	(35, 'pd', 'pd-6', 'Do you frequently experience these unexpected panic attacks?', 0.20, 'phrase-2'),
	(36, 'pd', 'pd-7', 'Have you been experiencing recurrent panic attacks more than 1 month?', 0.20, 'phrase-2'),
	(37, 'odd', 'oddi-3', 'Do you frequently feel angry or resentful?', 0.20, 'phrase-2a'),
	(38, 'odd', 'oddd-4', 'Do you often argue with authority figures or adults?', 0.20, 'phrase-2a'),
	(39, 'gd', 'gda-3', 'Do you have a strong desire for the primary and/or secondary sex characteristics of a different gender?', 0.20, 'phrase-2a'),
	(40, 'gd', 'gda-4', 'Do you have a strong desire to be a gender different from your assigned birth gender?', 0.20, 'phrase-2a'),
	(41, 'dmdd', 'dmdd-3', 'Do you frequently have these temper outbursts on average (daily, weekly, etc.)?', 0.20, 'phrase-2c'),
	(42, 'dmdd', 'dmdd-4', 'In between outbursts, are you persistently irritable or angry most of the day, nearly every day, as observed by others?', 0.20, 'phrase-2c'),
	(43, 'dmdd', 'dmdd-5', 'Have you experienced the temper outburst symptoms for 12 or more months continuously without a 3 month break?', 0.20, 'phrase-2c'),
	(44, 'gd', 'gdc-3', 'If you were assigned female at birth, do you have a strong preference for only wearing masculine clothing?', 0.20, 'phrase-2c'),
	(45, 'gd', 'gdc-4', 'Do you have a strong preference for cross-gender roles when engaging in make-believe play or fantasies?', 0.20, 'phrase-2c'),
	(46, 'mdd', 'mdd-5', 'Over the past 2 weeks, have you felt agitated or noticed a slowing of your movements and speech?', 0.20, 'phrase-3'),
	(47, 'mdd', 'mdd-6', 'Over the past 2 weeks, have you experienced persistent fatigue or loss of energy?', 0.20, 'phrase-3'),
	(48, 'mdd', 'mdd-7', 'Over the past 2 weeks, have you had recurrent feelings of worthlessness or excessive guilt?', 0.20, 'phrase-3'),
	(49, 'mdd', 'mdd-8', 'Over the past 2 weeks, have you had difficulty concentrating or making decisions?', 0.20, 'phrase-3'),
	(50, 'mdd', 'mdd-9', 'Over the past 2 weeks, have you had recurrent thoughts about death or suicide?', 0.20, 'phrase-3'),
	(51, 'mdd', 'mdd-10', 'Have these symptoms caused significant distress or impairment in your social, occupational, or other important areas of functioning?', 0.20, 'phrase-3'),
	(52, 'mdd', 'mdd-11', 'Are these symptoms attributable to the physiological effects of a substance or another medical condition?', 0.20, 'phrase-3'),
	(53, 'mdd', 'mdd-12', 'Have you recently experienced a significant loss, such as bereavement, financial ruin, natural disaster, or serious illness/disability?', 0.20, 'phrase-3'),
	(54, 'mdd', 'mdd-13', 'Have you ever experienced a manic or hypomanic episode?', 0.20, 'phrase-3'),
	(55, 'mdd', 'mdd-14', 'Have you ever been diagnosed with a psychotic disorder, such as schizophrenia or schizoaffective disorder?', 0.20, 'phrase-3'),
	(56, 'apd', 'apd-5', 'Do you regularly take reckless risks that endanger yourself or others?', 0.20, 'phrase-3'),
	(57, 'apd', 'apd-6', 'Have you consistently struggled to maintain a job or meet financial obligations due to irresponsible behavior?', 0.20, 'phrase-3'),
	(58, 'apd', 'apd-7', 'Do you tend to show a lack of remorse or indifference after hurting, mistreating, or stealing from someone?', 0.20, 'phrase-3'),
	(59, 'apd', 'apd-8', 'Did you exhibit behaviors as a child (before age 15) that would be considered conduct disorder?', 0.20, 'phrase-3'),
	(60, 'apd', 'apd-9', 'Have your antisocial behaviors occurred exclusively during episodes of schizophrenia, bipolar disorder or another psychotic disorder?', 0.20, 'phrase-3'),
	(61, 'dmdd', 'dmdd-6', 'Do you exhibit these temper outburst behaviors in at least two settings (home, school, with peers) and are they severe in at least one setting?', 0.20, 'phrase-3'),
	(62, 'dmdd', 'dmdd-7', 'Is your temper outburst symptoms began before age 10?', 0.20, 'phrase-3'),
	(63, 'dmdd', 'dmdd-8', 'Have you ever had a distinct manic/hypomanic episode lasting more than 1 day?', 0.20, 'phrase-3'),
	(64, 'dmdd', 'dmdd-9', 'Do these temper outbursts behaviors occur exclusively during major depressive episodes?', 0.20, 'phrase-3'),
	(65, 'dmdd', 'dmdd-10', 'Could these symptoms be better explained by another condition like autism, PTSD, separation anxiety, or persistent depressive disorder?', 0.20, 'phrase-3'),
	(66, 'dmdd', 'dmdd-11', 'Are your symptoms caused by substance use or another medical/neurological condition?', 0.20, 'phrase-3'),
	(67, 'odd', 'oddd-5', 'Do you actively defy or refuse to comply with requests from authorities or rules?', 0.20, 'phrase-3'),
	(68, 'odd', 'oddd-6', 'Do you deliberately annoy others on a regular basis?', 0.20, 'phrase-3'),
	(69, 'odd', 'oddd-7', 'Do you frequently blame others for your own mistakes or misbehaviors?', 0.20, 'phrase-3'),
	(70, 'odd', 'oddv-8', 'In the past 6 months, have you been spiteful or vindictive towards others on at least two occasions?', 0.20, 'phrase-3'),
	(71, 'odd', 'oddo-9', 'Do you experienced these behaviors (angry/irritable mood, argumentativeness, defiance, vindictiveness) more than 6 months?', 0.20, 'phrase-3'),
	(72, 'odd', 'oddo-10', 'Do these behaviors occur during your interactions with non-siblings?', 0.20, 'phrase-3'),
	(73, 'odd', 'oddo-11', 'Do your behaviors cause distress for you or others in your daily life (family, peers, school, work)?', 0.20, 'phrase-3'),
	(74, 'odd', 'oddo-12', 'Do your behaviors negatively impact your social, educational, occupational or other important areas of functioning?', 0.20, 'phrase-3'),
	(75, 'odd', 'oddo-13', 'Are these behaviors present exclusively during psychotic, substance use, depressive or bipolar episodes?', 0.20, 'phrase-3'),
	(76, 'odd', 'oddo-14', 'Have you ever been diagnosed with disruptive mood dysregulation disorder?', 0.20, 'phrase-3'),
	(77, 'gd', 'gda-5', 'Do you have a strong desire to be treated as a different gender?', 0.20, 'phrase-3a'),
	(78, 'gd', 'gda-6', 'Do you have a strong conviction that you have the typical feelings and reactions of a different gender?', 0.20, 'phrase-3a'),
	(79, 'gd', 'gda-7', 'Does your experienced gender incongruence cause clinically significant distress or impairment in social, occupational or other important areas?', 0.20, 'phrase-3a'),
	(80, 'gd', 'gdc-5', 'Do you have a strong preference for toys, games or activities typically associated with the opposite gender?', 0.20, 'phrase-3c'),
	(81, 'gd', 'gdc-6', 'Do you have a strong preference for playmates of the opposite gender?', 0.20, 'phrase-3c'),
	(82, 'gd', 'gdc-7', 'If assigned male at birth, do you strongly reject typically masculine toys/activities and avoid rough play?', 0.20, 'phrase-3c'),
	(83, 'gd', 'gdc-8', 'If assigned female at birth, do you strongly reject typically feminine toys/activities?', 0.20, 'phrase-3c'),
	(84, 'gd', 'gdc-9', 'Do you have a strong dislike of your sexual anatomy?', 0.20, 'phrase-3c'),
	(85, 'gd', 'gdc-10', 'Do you have a strong desire for the primary and/or secondary sex characteristics of the opposite gender?', 0.20, 'phrase-3c'),
	(86, 'gd', 'gdc-11', 'Does your experienced gender incongruence cause clinically significant distress or impairment in social, school or other important areas?', 0.20, 'phrase-3c'),
	(87, 'ed', 'ed-5', 'Do you have any other medical conditions that could be contributing to the bed/clothing wetting (diabetes, seizure disorders, spina bifida, etc.)?', 0.20, 'phrase-3'),
	(88, 'dd', 'dd-5', 'Apart from the impacts of your delusional beliefs, do you generally function well in your daily life and behave normally?', 0.20, 'phrase-3'),
	(89, 'dd', 'dd-6', 'If you\'ve experienced manic or major depressive episodes, were they brief compared to the duration of the delusional periods?', 0.20, 'phrase-3'),
	(90, 'dd', 'dd-7', 'Are you currently taking any substances/medications that could be causing these delusional beliefs?', 0.20, 'phrase-3'),
	(91, 'dd', 'dd-8', 'Do you have any other medical conditions that could explain the delusional beliefs?', 0.20, 'phrase-3'),
	(92, 'dd', 'dd-9', 'Could your beliefs be better explained by another disorder like body dysmorphic disorder or OCD?', 0.20, 'phrase-3'),
	(93, 'bpd', 'bpd-5', 'Are you currently taking any drugs/substances or medications that could be causing these symptoms?', 0.20, 'phrase-3'),
	(94, 'bpd', 'bpd-6', 'Do you have any medical conditions that could explain the psychotic symptoms?', 0.20, 'phrase-3'),
	(95, 'sp', 'sp-5', 'Do you experienced this intense fear or avoidance behavior, approximately more than 6 months?', 0.20, 'phrase-3'),
	(96, 'sp', 'sp-6', 'Does your fear, anxiety or avoidance cause you significant distress or impairment in your social life, work/academics or other important areas?', 0.20, 'phrase-3'),
	(97, 'sp', 'sp-7', 'In childhood, did you express this fear through crying, tantrums, freezing or clinging behaviors?', 0.20, 'phrase-3'),
	(98, 'sp', 'sp-8', 'Could your fear be better explained by another disorder, such as: 1. Panic disorder/agoraphobia 2. Obsessive compulsive disorder 3. Post-traumatic stress disorder 4. Separation anxiety disorder 5. Social anxiety disorder', 0.20, 'phrase-3'),
	(99, 'pd', 'pd-2', 'During these attacks, did you experience any of the following physical symptoms? 1. Palpitations, pounding heart, or accelerated heart rate. 2. Sweating. 3. Trembling or shaking. 4. Sensations of shortness of breath or smothering. 5. Feelings of choking. 6. Chest pain or discomfort. 7. Nausea or abdominal distress. 8. Feeling dizzy, unsteady, light-headed, or faint. 9. Chills or heat sensations. 10. Paresthesia (numbness or tingling sensations). 11. Derealization (feelings of unreality) or depersonalization (being detached from one self). 12. Fear of losing control or â€œgoing crazy.â€ 13. Fear of dying.', 0.20, 'phrase-3'),
	(100, 'pd', 'pd-4', 'Are you currently taking any medications, substances or have any medical conditions that could be causing these panic attack symptoms?', 0.20, 'phrase-3'),
	(101, 'pd', 'pd-5', 'Do your panic attacks only occur in specific situations like: 1. Social situations (social anxiety disorder) 2. Due to specific phobias 3. In response to obsessions (OCD) 4. After trauma reminders (PTSD) 5. When separated from loved ones (separation anxiety)', 0.20, 'phrase-3'),
	(102, 'pd', 'pd-8', 'Are panic attacks disruptive or distressing to your daily life/functioning?', 0.20, 'phrase-3');

-- Dumping structure for table s-dds.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table s-dds.users: ~0 rows (approximately)

-- Dumping structure for table s-dds.user_cf_values
CREATE TABLE IF NOT EXISTS `user_cf_values` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `cf_mdd` decimal(3,2) DEFAULT '0.00',
  `cf_apd` decimal(3,2) DEFAULT '0.00',
  `cf_ed` decimal(3,2) DEFAULT '0.00',
  `cf_dd` decimal(3,2) DEFAULT '0.00',
  `cf_bpd` decimal(3,2) DEFAULT '0.00',
  `cf_sp` decimal(3,2) DEFAULT '0.00',
  `cf_pd` decimal(3,2) DEFAULT '0.00',
  `cf_odd` decimal(3,2) DEFAULT '0.00',
  `cf_gd` decimal(3,2) DEFAULT '0.00',
  `cf_dmdd` decimal(3,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `user_cf_values_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table s-dds.user_cf_values: ~0 rows (approximately)

-- Dumping structure for table s-dds.user_responses
CREATE TABLE IF NOT EXISTS `user_responses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `question_id` int DEFAULT NULL,
  `answer` enum('YES','NO') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `user_responses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `user_responses_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table s-dds.user_responses: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
