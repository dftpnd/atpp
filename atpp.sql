-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Хост: localhost:8889
-- Время создания: Апр 21 2014 г., 09:57
-- Версия сервера: 5.5.34
-- Версия PHP: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `atpp_schema`
--

-- --------------------------------------------------------

--
-- Структура таблицы `assignments`
--

CREATE TABLE `assignments` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `assignments`
--

INSERT INTO `assignments` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('User', '131', NULL, NULL),
('Authority', '1', '', 's:0:"";'),
('User', '53', NULL, NULL),
('User', '52', NULL, NULL),
('User', '51', NULL, NULL),
('User', '50', NULL, NULL),
('User', '49', NULL, NULL),
('User', '48', NULL, NULL),
('User', '47', NULL, NULL),
('User', '46', NULL, NULL),
('User', '45', NULL, NULL),
('User', '44', NULL, NULL),
('User', '43', NULL, NULL),
('User', '42', NULL, NULL),
('User', '41', NULL, NULL),
('User', '40', NULL, NULL),
('User', '39', NULL, NULL),
('User', '38', NULL, NULL),
('User', '37', NULL, NULL),
('User', '36', NULL, NULL),
('User', '54', NULL, NULL),
('User', '55', NULL, NULL),
('User', '56', NULL, NULL),
('User', '57', NULL, NULL),
('User', '58', NULL, NULL),
('User', '59', NULL, NULL),
('User', '60', NULL, NULL),
('User', '61', NULL, NULL),
('User', '62', NULL, NULL),
('User', '63', NULL, NULL),
('User', '64', NULL, NULL),
('Authority', '65', '', 's:0:"";'),
('Prepod', '81', '', 's:0:"";'),
('User', '66', NULL, NULL),
('User', '67', NULL, NULL),
('User', '68', NULL, NULL),
('User', '69', NULL, NULL),
('User', '70', NULL, NULL),
('User', '71', NULL, NULL),
('User', '72', NULL, NULL),
('User', '73', NULL, NULL),
('User', '74', NULL, NULL),
('User', '75', NULL, NULL),
('User', '76', NULL, NULL),
('User', '77', NULL, NULL),
('User', '78', NULL, NULL),
('User', '79', NULL, NULL),
('User', '80', NULL, NULL),
('User', '129', NULL, NULL),
('User', '82', NULL, NULL),
('User', '83', NULL, NULL),
('User', '84', NULL, NULL),
('User', '85', NULL, NULL),
('User', '86', NULL, NULL),
('User', '87', NULL, NULL),
('User', '88', NULL, NULL),
('User', '89', NULL, NULL),
('User', '90', NULL, NULL),
('User', '111', NULL, NULL),
('User', '92', NULL, NULL),
('User', '93', NULL, NULL),
('User', '94', NULL, NULL),
('User', '95', NULL, NULL),
('User', '96', NULL, NULL),
('User', '97', NULL, NULL),
('User', '98', NULL, NULL),
('User', '99', NULL, NULL),
('User', '100', NULL, NULL),
('User', '101', NULL, NULL),
('User', '102', NULL, NULL),
('User', '103', NULL, NULL),
('User', '104', NULL, NULL),
('User', '105', NULL, NULL),
('User', '106', NULL, NULL),
('User', '107', NULL, NULL),
('User', '108', NULL, NULL),
('User', '110', NULL, NULL),
('Authority', '91', '', 's:0:"";'),
('User', '130', NULL, NULL),
('User', '112', NULL, NULL),
('User', '113', NULL, NULL),
('User', '114', NULL, NULL),
('User', '115', NULL, NULL),
('User', '116', NULL, NULL),
('User', '117', NULL, NULL),
('User', '118', NULL, NULL),
('User', '119', NULL, NULL),
('User', '120', NULL, NULL),
('User', '121', NULL, NULL),
('User', '122', NULL, NULL),
('User', '123', NULL, NULL),
('User', '124', NULL, NULL),
('User', '125', NULL, NULL),
('User', '126', NULL, NULL),
('User', '127', NULL, NULL),
('User', '134', NULL, NULL),
('User', '133', NULL, NULL),
('Prepod', '133', NULL, NULL),
('User', '132', NULL, NULL),
('Prepod', '134', NULL, NULL),
('Prepod', '135', '', 's:0:"";'),
('User', '136', NULL, NULL),
('User', '137', NULL, NULL),
('User', '138', NULL, NULL),
('User', '139', NULL, NULL),
('User', '140', NULL, NULL),
('User', '141', NULL, NULL),
('Prepod', '141', NULL, NULL),
('User', '142', NULL, NULL),
('User', '143', NULL, NULL),
('User', '144', NULL, NULL),
('User', '145', NULL, NULL),
('User', '147', NULL, NULL),
('User', '148', NULL, NULL),
('User', '149', NULL, NULL),
('User', '150', NULL, NULL),
('User', '151', NULL, NULL),
('User', '152', NULL, NULL),
('User', '153', NULL, NULL),
('User', '154', NULL, NULL),
('User', '155', NULL, NULL),
('User', '156', NULL, NULL),
('User', '157', NULL, NULL),
('User', '158', NULL, NULL),
('User', '159', NULL, NULL),
('User', '160', NULL, NULL),
('User', '161', NULL, NULL),
('User', '162', NULL, NULL),
('User', '163', NULL, NULL),
('User', '164', NULL, NULL),
('User', '165', NULL, NULL),
('User', '166', NULL, NULL),
('User', '167', NULL, NULL),
('User', '168', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `authassignment`
--

CREATE TABLE `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `authitem`
--

CREATE TABLE `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `authitemchild`
--

CREATE TABLE `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `group_semestr_statistic`
--

CREATE TABLE `group_semestr_statistic` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `group_id` int(255) NOT NULL,
  `semestr_id` int(255) NOT NULL,
  `statistic_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `itemchildren`
--

CREATE TABLE `itemchildren` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `itemchildren`
--

INSERT INTO `itemchildren` (`parent`, `child`) VALUES
('Admin', 'CommentApprove'),
('Admin', 'CommentDelete'),
('Admin', 'CommentIndex'),
('Admin', 'FilesChangeFolder'),
('Admin', 'FilesDeleteFolder'),
('Admin', 'FilesDoorDownloadFile'),
('Admin', 'FilesDownloadFile'),
('Admin', 'FilesDownloads'),
('Admin', 'FilesFiles'),
('Admin', 'FilesOpenFolder'),
('Admin', 'FilesSaveChangeFolder'),
('Admin', 'FilesUpdateDirectory'),
('Admin', 'ForumDeleteForum'),
('Admin', 'LibraryChangepredmets'),
('Admin', 'LibraryDeleteFile'),
('Admin', 'LibraryDownloads'),
('Admin', 'LibraryEditText'),
('Admin', 'LibraryPrepodpredmets'),
('Admin', 'LibraryUpload'),
('Admin', 'PostAddComment'),
('Admin', 'PostAdmin'),
('Admin', 'PostCreate'),
('Admin', 'PostDelete'),
('Admin', 'PostDeleteMyPost'),
('Admin', 'PostDeletePicterPost'),
('Admin', 'PostLk'),
('Admin', 'PostMyPost'),
('Admin', 'PostSuggestTags'),
('Admin', 'PostUpdate'),
('Admin', 'PostUploadPE'),
('Admin', 'ReestrGetSchedule'),
('Admin', 'SiteActivity'),
('Admin', 'SiteAproveModer'),
('Admin', 'SiteReject'),
('Admin', 'SiteSlide'),
('Admin', 'SlideAdmin'),
('Admin', 'SlideCreate'),
('Admin', 'SlideDelete'),
('Admin', 'SlideIndex'),
('Admin', 'SlideUpdate'),
('Admin', 'SlideView'),
('Admin', 'userAdmin@AdminAproveModer'),
('Admin', 'userAdmin@AdminConfirm'),
('Admin', 'userAdmin@AdminCreateTaskPlan'),
('Admin', 'userAdmin@AdminDeleteGroup'),
('Admin', 'userAdmin@AdminDeleteGroupLeader'),
('Admin', 'userAdmin@AdmindeleteInstitute'),
('Admin', 'userAdmin@AdminDeletePredmet'),
('Admin', 'userAdmin@AdminDeleteUser'),
('Admin', 'userAdmin@AdminEditList'),
('Admin', 'userAdmin@AdminGetGroupLeader'),
('Admin', 'userAdmin@AdminGroup'),
('Admin', 'userAdmin@AdminGroupUsers'),
('Admin', 'userAdmin@AdminGroupview'),
('Admin', 'userAdmin@AdminGroupViews'),
('Admin', 'userAdmin@AdminIndex'),
('Admin', 'userAdmin@AdminInfogroup'),
('Admin', 'userAdmin@AdminInstitute'),
('Admin', 'userAdmin@AdminListBuild'),
('Admin', 'userAdmin@AdminMail'),
('Admin', 'userAdmin@AdminPodobiu'),
('Admin', 'userAdmin@AdminPredmet'),
('Admin', 'userAdmin@AdminPredmetedet'),
('Admin', 'userAdmin@AdminReject'),
('Admin', 'userAdmin@AdminsaveInfogroup'),
('Admin', 'userAdmin@AdminSelectPredmets'),
('Admin', 'userAdmin@AdminUpdateGroup'),
('Admin', 'userAdmin@AdminUpdatePredmet'),
('Admin', 'userAdmin@AdminUsers'),
('Admin', 'userAdmin@AdminWeek'),
('Admin', 'userAdmin@AdminZapolnit'),
('Admin', 'UserBanStudent'),
('Admin', 'UserChageStudentStats'),
('Admin', 'UserChangeFakeProfile'),
('Admin', 'UserClassmateBlokked'),
('Admin', 'UserDeleteActivity'),
('Admin', 'UserDeleteFileGroup'),
('Admin', 'UserDeleteScheduleDay'),
('Admin', 'UserDeleteSmallPost'),
('Admin', 'UserDeleteSPComment'),
('Admin', 'UserDeleteStudent'),
('Admin', 'UserDoorDownloadFile'),
('Admin', 'UserDownloadFile'),
('Admin', 'UserEdit'),
('Admin', 'UserEditProfile'),
('Admin', 'UserEditSchedule'),
('Admin', 'UserGroupfile'),
('Admin', 'UserIndex'),
('Admin', 'UserManageGroup'),
('Admin', 'UserMyGroup'),
('Admin', 'UserMyProfile'),
('Admin', 'UserNewScheduleDay'),
('Admin', 'UserNewSmallPost'),
('Admin', 'UserNewSmallPostComment'),
('Admin', 'UserObjectRating'),
('Admin', 'UserPredmetfile'),
('Admin', 'UserPublicfunctionactiobNewScheduleDay'),
('Admin', 'UserRazBanStudent'),
('Admin', 'UserSaveActivity'),
('Admin', 'UserSaveFakeProfile'),
('Admin', 'UserSchedule'),
('Admin', 'UserUploadAvatar'),
('Admin', 'UserUploadfilegroup'),
('Authority', 'Admin'),
('ManageGroup', 'CommentApprove'),
('ManageGroup', 'CommentDelete'),
('ManageGroup', 'CommentIndex'),
('ManageGroup', 'FilesChangeFolder'),
('ManageGroup', 'FilesDeleteFolder'),
('ManageGroup', 'FilesDoorDownloadFile'),
('ManageGroup', 'FilesDownloadFile'),
('ManageGroup', 'FilesDownloads'),
('ManageGroup', 'FilesFiles'),
('ManageGroup', 'FilesOpenFolder'),
('ManageGroup', 'FilesSaveChangeFolder'),
('ManageGroup', 'FilesUpdateDirectory'),
('ManageGroup', 'ForumDeleteForum'),
('ManageGroup', 'LibraryChangepredmets'),
('ManageGroup', 'LibraryDeleteFile'),
('ManageGroup', 'LibraryDownloads'),
('ManageGroup', 'LibraryEditText'),
('ManageGroup', 'LibraryPrepodpredmets'),
('ManageGroup', 'LibraryUpload'),
('ManageGroup', 'PostAddComment'),
('ManageGroup', 'PostAdmin'),
('ManageGroup', 'PostCreate'),
('ManageGroup', 'PostDelete'),
('ManageGroup', 'PostDeleteMyPost'),
('ManageGroup', 'PostDeletePicterPost'),
('ManageGroup', 'PostLk'),
('ManageGroup', 'PostMyPost'),
('ManageGroup', 'PostSuggestTags'),
('ManageGroup', 'PostUpdate'),
('ManageGroup', 'PostUploadPE'),
('ManageGroup', 'ReestrGetSchedule'),
('ManageGroup', 'SiteActivity'),
('ManageGroup', 'SiteAproveModer'),
('ManageGroup', 'SiteReject'),
('ManageGroup', 'SiteSlide'),
('ManageGroup', 'SlideAdmin'),
('ManageGroup', 'SlideCreate'),
('ManageGroup', 'SlideDelete'),
('ManageGroup', 'SlideIndex'),
('ManageGroup', 'SlideUpdate'),
('ManageGroup', 'SlideView'),
('ManageGroup', 'userAdmin@AdminAproveModer'),
('ManageGroup', 'userAdmin@AdminConfirm'),
('ManageGroup', 'userAdmin@AdminCreateTaskPlan'),
('ManageGroup', 'userAdmin@AdminDeleteGroup'),
('ManageGroup', 'userAdmin@AdminDeleteGroupLeader'),
('ManageGroup', 'userAdmin@AdmindeleteInstitute'),
('ManageGroup', 'userAdmin@AdminDeletePredmet'),
('ManageGroup', 'userAdmin@AdminDeleteUser'),
('ManageGroup', 'userAdmin@AdminEditList'),
('ManageGroup', 'userAdmin@AdminGetGroupLeader'),
('ManageGroup', 'userAdmin@AdminGroup'),
('ManageGroup', 'userAdmin@AdminGroupUsers'),
('ManageGroup', 'userAdmin@AdminGroupview'),
('ManageGroup', 'userAdmin@AdminGroupViews'),
('ManageGroup', 'userAdmin@AdminIndex'),
('ManageGroup', 'userAdmin@AdminInfogroup'),
('ManageGroup', 'userAdmin@AdminInstitute'),
('ManageGroup', 'userAdmin@AdminListBuild'),
('ManageGroup', 'userAdmin@AdminMail'),
('ManageGroup', 'userAdmin@AdminPodobiu'),
('ManageGroup', 'userAdmin@AdminPredmet'),
('ManageGroup', 'userAdmin@AdminPredmetedet'),
('ManageGroup', 'userAdmin@AdminReject'),
('ManageGroup', 'userAdmin@AdminsaveInfogroup'),
('ManageGroup', 'userAdmin@AdminSelectPredmets'),
('ManageGroup', 'userAdmin@AdminUpdateGroup'),
('ManageGroup', 'userAdmin@AdminUpdatePredmet'),
('ManageGroup', 'userAdmin@AdminUsers'),
('ManageGroup', 'userAdmin@AdminWeek'),
('ManageGroup', 'userAdmin@AdminZapolnit'),
('ManageGroup', 'UserBanStudent'),
('ManageGroup', 'UserChageStudentStats'),
('ManageGroup', 'UserChangeFakeProfile'),
('ManageGroup', 'UserClassmateBlokked'),
('ManageGroup', 'UserDeleteActivity'),
('ManageGroup', 'UserDeleteFileGroup'),
('ManageGroup', 'UserDeleteScheduleDay'),
('ManageGroup', 'UserDeleteSmallPost'),
('ManageGroup', 'UserDeleteSPComment'),
('ManageGroup', 'UserDeleteStudent'),
('ManageGroup', 'UserDoorDownloadFile'),
('ManageGroup', 'UserDownloadFile'),
('ManageGroup', 'UserEdit'),
('ManageGroup', 'UserEditProfile'),
('ManageGroup', 'UserEditSchedule'),
('ManageGroup', 'UserGroupfile'),
('ManageGroup', 'UserIndex'),
('ManageGroup', 'UserManageGroup'),
('ManageGroup', 'UserMyGroup'),
('ManageGroup', 'UserMyProfile'),
('ManageGroup', 'UserNewScheduleDay'),
('ManageGroup', 'UserNewSmallPost'),
('ManageGroup', 'UserNewSmallPostComment'),
('ManageGroup', 'UserObjectRating'),
('ManageGroup', 'UserPredmetfile'),
('ManageGroup', 'UserPublicfunctionactiobNewScheduleDay'),
('ManageGroup', 'UserRazBanStudent'),
('ManageGroup', 'UserSaveActivity'),
('ManageGroup', 'UserSaveFakeProfile'),
('ManageGroup', 'UserSchedule'),
('ManageGroup', 'UserUploadAvatar'),
('ManageGroup', 'UserUploadfilegroup'),
('ManegerGroup', 'ManageGroup'),
('Prepod', 'teacher'),
('Student', 'CommentApprove'),
('Student', 'CommentDelete'),
('Student', 'CommentIndex'),
('Student', 'FilesChangeFolder'),
('Student', 'FilesDeleteFolder'),
('Student', 'FilesDoorDownloadFile'),
('Student', 'FilesDownloadFile'),
('Student', 'FilesDownloads'),
('Student', 'FilesFiles'),
('Student', 'FilesOpenFolder'),
('Student', 'FilesSaveChangeFolder'),
('Student', 'FilesUpdateDirectory'),
('Student', 'ForumDeleteForum'),
('Student', 'LibraryChangepredmets'),
('Student', 'LibraryDeleteFile'),
('Student', 'LibraryDownloads'),
('Student', 'LibraryEditText'),
('Student', 'LibraryPrepodpredmets'),
('Student', 'LibraryUpload'),
('Student', 'PostAddComment'),
('Student', 'PostAdmin'),
('Student', 'PostCreate'),
('Student', 'PostDelete'),
('Student', 'PostDeleteMyPost'),
('Student', 'PostDeletePicterPost'),
('Student', 'PostLk'),
('Student', 'PostMyPost'),
('Student', 'PostSuggestTags'),
('Student', 'PostUpdate'),
('Student', 'PostUploadPE'),
('Student', 'ReestrGetSchedule'),
('Student', 'SiteActivity'),
('Student', 'SiteAproveModer'),
('Student', 'SiteReject'),
('Student', 'SiteSlide'),
('Student', 'SlideAdmin'),
('Student', 'SlideCreate'),
('Student', 'SlideDelete'),
('Student', 'SlideIndex'),
('Student', 'SlideUpdate'),
('Student', 'SlideView'),
('Student', 'userAdmin@AdminAproveModer'),
('Student', 'userAdmin@AdminConfirm'),
('Student', 'userAdmin@AdminCreateTaskPlan'),
('Student', 'userAdmin@AdminDeleteGroup'),
('Student', 'userAdmin@AdminDeleteGroupLeader'),
('Student', 'userAdmin@AdmindeleteInstitute'),
('Student', 'userAdmin@AdminDeletePredmet'),
('Student', 'userAdmin@AdminDeleteUser'),
('Student', 'userAdmin@AdminEditList'),
('Student', 'userAdmin@AdminGetGroupLeader'),
('Student', 'userAdmin@AdminGroup'),
('Student', 'userAdmin@AdminGroupUsers'),
('Student', 'userAdmin@AdminGroupview'),
('Student', 'userAdmin@AdminGroupViews'),
('Student', 'userAdmin@AdminIndex'),
('Student', 'userAdmin@AdminInfogroup'),
('Student', 'userAdmin@AdminInstitute'),
('Student', 'userAdmin@AdminListBuild'),
('Student', 'userAdmin@AdminMail'),
('Student', 'userAdmin@AdminPodobiu'),
('Student', 'userAdmin@AdminPredmet'),
('Student', 'userAdmin@AdminPredmetedet'),
('Student', 'userAdmin@AdminReject'),
('Student', 'userAdmin@AdminsaveInfogroup'),
('Student', 'userAdmin@AdminSelectPredmets'),
('Student', 'userAdmin@AdminUpdateGroup'),
('Student', 'userAdmin@AdminUpdatePredmet'),
('Student', 'userAdmin@AdminUsers'),
('Student', 'userAdmin@AdminWeek'),
('Student', 'userAdmin@AdminZapolnit'),
('Student', 'UserBanStudent'),
('Student', 'UserClassmateBlokked'),
('Student', 'UserDeleteActivity'),
('Student', 'UserDeleteFileGroup'),
('Student', 'UserDeleteScheduleDay'),
('Student', 'UserDeleteSmallPost'),
('Student', 'UserDeleteSPComment'),
('Student', 'UserDeleteStudent'),
('Student', 'UserDoorDownloadFile'),
('Student', 'UserDownloadFile'),
('Student', 'UserEdit'),
('Student', 'UserEditProfile'),
('Student', 'UserEditSchedule'),
('Student', 'UserGroupfile'),
('Student', 'UserIndex'),
('Student', 'UserManageGroup'),
('Student', 'UserMyGroup'),
('Student', 'UserMyProfile'),
('Student', 'UserNewScheduleDay'),
('Student', 'UserNewSmallPost'),
('Student', 'UserNewSmallPostComment'),
('Student', 'UserObjectRating'),
('Student', 'UserPredmetfile'),
('Student', 'UserPublicfunctionactiobNewScheduleDay'),
('Student', 'UserRazBanStudent'),
('Student', 'UserSaveActivity'),
('Student', 'UserSchedule'),
('Student', 'UserUploadAvatar'),
('Student', 'UserUploadfilegroup'),
('teacher', 'CommentApprove'),
('teacher', 'CommentDelete'),
('teacher', 'CommentIndex'),
('teacher', 'FilesChangeFolder'),
('teacher', 'FilesDeleteFolder'),
('teacher', 'FilesDoorDownloadFile'),
('teacher', 'FilesDownloadFile'),
('teacher', 'FilesDownloads'),
('teacher', 'FilesFiles'),
('teacher', 'FilesOpenFolder'),
('teacher', 'FilesSaveChangeFolder'),
('teacher', 'FilesUpdateDirectory'),
('teacher', 'ForumDeleteForum'),
('teacher', 'LibraryChangepredmets'),
('teacher', 'LibraryDeleteFile'),
('teacher', 'LibraryDownloads'),
('teacher', 'LibraryEditText'),
('teacher', 'LibraryPrepodpredmets'),
('teacher', 'LibraryUpload'),
('teacher', 'PostAddComment'),
('teacher', 'PostAdmin'),
('teacher', 'PostCreate'),
('teacher', 'PostDelete'),
('teacher', 'PostDeleteMyPost'),
('teacher', 'PostDeletePicterPost'),
('teacher', 'PostLk'),
('teacher', 'PostMyPost'),
('teacher', 'PostSuggestTags'),
('teacher', 'PostUpdate'),
('teacher', 'PostUploadPE'),
('teacher', 'ReestrGetSchedule'),
('teacher', 'SiteActivity'),
('teacher', 'SiteAproveModer'),
('teacher', 'SiteReject'),
('teacher', 'SiteSlide'),
('teacher', 'SlideAdmin'),
('teacher', 'SlideCreate'),
('teacher', 'SlideDelete'),
('teacher', 'SlideIndex'),
('teacher', 'SlideUpdate'),
('teacher', 'SlideView'),
('teacher', 'userAdmin@AdminAproveModer'),
('teacher', 'userAdmin@AdminConfirm'),
('teacher', 'userAdmin@AdminCreateTaskPlan'),
('teacher', 'userAdmin@AdminDeleteGroup'),
('teacher', 'userAdmin@AdminDeleteGroupLeader'),
('teacher', 'userAdmin@AdmindeleteInstitute'),
('teacher', 'userAdmin@AdminDeletePredmet'),
('teacher', 'userAdmin@AdminDeleteUser'),
('teacher', 'userAdmin@AdminEditList'),
('teacher', 'userAdmin@AdminGetGroupLeader'),
('teacher', 'userAdmin@AdminGroup'),
('teacher', 'userAdmin@AdminGroupUsers'),
('teacher', 'userAdmin@AdminGroupview'),
('teacher', 'userAdmin@AdminGroupViews'),
('teacher', 'userAdmin@AdminIndex'),
('teacher', 'userAdmin@AdminInfogroup'),
('teacher', 'userAdmin@AdminInstitute'),
('teacher', 'userAdmin@AdminListBuild'),
('teacher', 'userAdmin@AdminMail'),
('teacher', 'userAdmin@AdminPodobiu'),
('teacher', 'userAdmin@AdminPredmet'),
('teacher', 'userAdmin@AdminPredmetedet'),
('teacher', 'userAdmin@AdminReject'),
('teacher', 'userAdmin@AdminsaveInfogroup'),
('teacher', 'userAdmin@AdminSelectPredmets'),
('teacher', 'userAdmin@AdminUpdateGroup'),
('teacher', 'userAdmin@AdminUpdatePredmet'),
('teacher', 'userAdmin@AdminUsers'),
('teacher', 'userAdmin@AdminWeek'),
('teacher', 'userAdmin@AdminZapolnit'),
('teacher', 'UserBanStudent'),
('teacher', 'UserClassmateBlokked'),
('teacher', 'UserDeleteActivity'),
('teacher', 'UserDeleteFileGroup'),
('teacher', 'UserDeleteScheduleDay'),
('teacher', 'UserDeleteSmallPost'),
('teacher', 'UserDeleteSPComment'),
('teacher', 'UserDeleteStudent'),
('teacher', 'UserDoorDownloadFile'),
('teacher', 'UserDownloadFile'),
('teacher', 'UserEdit'),
('teacher', 'UserEditProfile'),
('teacher', 'UserEditSchedule'),
('teacher', 'UserGroupfile'),
('teacher', 'UserIndex'),
('teacher', 'UserManageGroup'),
('teacher', 'UserMyGroup'),
('teacher', 'UserMyProfile'),
('teacher', 'UserNewScheduleDay'),
('teacher', 'UserNewSmallPost'),
('teacher', 'UserNewSmallPostComment'),
('teacher', 'UserObjectRating'),
('teacher', 'UserPredmetfile'),
('teacher', 'UserPublicfunctionactiobNewScheduleDay'),
('teacher', 'UserRazBanStudent'),
('teacher', 'UserSaveActivity'),
('teacher', 'UserSchedule'),
('teacher', 'UserUploadAvatar'),
('teacher', 'UserUploadfilegroup'),
('User', 'Student');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE `items` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('UserPredmetfile', 0, NULL, NULL, 'N;'),
('Authority', 2, NULL, NULL, NULL),
('ManageGroup', 1, '', '', 's:0:"";'),
('CommentApprove', 0, NULL, NULL, 'N;'),
('CommentDelete', 0, NULL, NULL, 'N;'),
('CommentIndex', 0, NULL, NULL, 'N;'),
('Student', 1, '', '', 's:0:"";'),
('ManegerGroup', 2, '', '', 's:0:"";'),
('Admin', 1, '', '', 's:0:"";'),
('PostAdmin', 0, NULL, NULL, 'N;'),
('PostCreate', 0, NULL, NULL, 'N;'),
('PostDelete', 0, NULL, NULL, 'N;'),
('PostSuggestTags', 0, NULL, NULL, 'N;'),
('PostUpdate', 0, NULL, NULL, 'N;'),
('PostUploadPE', 0, NULL, NULL, 'N;'),
('SiteAproveModer', 0, NULL, NULL, 'N;'),
('User', 2, NULL, NULL, NULL),
('PostLk', 0, NULL, NULL, 'N;'),
('SiteReject', 0, NULL, NULL, 'N;'),
('UserIndex', 0, NULL, NULL, 'N;'),
('UserEdit', 0, NULL, NULL, 'N;'),
('UserEditProfile', 0, NULL, NULL, 'N;'),
('UserUploadAvatar', 0, NULL, NULL, 'N;'),
('userAdmin@AdminIndex', 0, NULL, NULL, 'N;'),
('userAdmin@AdminMail', 0, NULL, NULL, 'N;'),
('userAdmin@AdminUsers', 0, NULL, NULL, 'N;'),
('userAdmin@AdminAproveModer', 0, NULL, NULL, 'N;'),
('userAdmin@AdminPredmet', 0, NULL, NULL, 'N;'),
('userAdmin@AdminDeletePredmet', 0, NULL, NULL, 'N;'),
('userAdmin@AdminUpdatePredmet', 0, NULL, NULL, 'N;'),
('userAdmin@AdminGroup', 0, NULL, NULL, 'N;'),
('userAdmin@AdminDeleteGroup', 0, NULL, NULL, 'N;'),
('userAdmin@AdminUpdateGroup', 0, NULL, NULL, 'N;'),
('userAdmin@AdminGroupViews', 0, NULL, NULL, 'N;'),
('userAdmin@AdminGroupview', 0, NULL, NULL, 'N;'),
('userAdmin@AdminSelectPredmets', 0, NULL, NULL, 'N;'),
('userAdmin@AdminCreateTaskPlan', 0, NULL, NULL, 'N;'),
('userAdmin@AdminListBuild', 0, NULL, NULL, 'N;'),
('userAdmin@AdminPredmetedet', 0, NULL, NULL, 'N;'),
('userAdmin@AdminConfirm', 0, NULL, NULL, 'N;'),
('userAdmin@AdminReject', 0, NULL, NULL, 'N;'),
('userAdmin@AdminGroupUsers', 0, NULL, NULL, 'N;'),
('userAdmin@AdminGetGroupLeader', 0, NULL, NULL, 'N;'),
('userAdmin@AdminDeleteGroupLeader', 0, NULL, NULL, 'N;'),
('userAdmin@AdminEditList', 0, NULL, NULL, 'N;'),
('UserMyGroup', 0, NULL, NULL, 'N;'),
('UserSchedule', 0, NULL, NULL, 'N;'),
('UserObjectRating', 0, NULL, NULL, 'N;'),
('PostAddComment', 0, NULL, NULL, 'N;'),
('UserEditSchedule', 0, NULL, NULL, 'N;'),
('UserPublicfunctionactiobNewScheduleDay', 0, NULL, NULL, 'N;'),
('UserNewScheduleDay', 0, NULL, NULL, 'N;'),
('UserDeleteScheduleDay', 0, NULL, NULL, 'N;'),
('userAdmin@AdminWeek', 0, NULL, NULL, 'N;'),
('UserNewSmallPost', 0, NULL, NULL, 'N;'),
('UserDeleteSmallPost', 0, NULL, NULL, 'N;'),
('UserNewSmallPostComment', 0, NULL, NULL, 'N;'),
('UserDeleteSPComment', 0, NULL, NULL, 'N;'),
('UserBanStudent', 0, NULL, NULL, 'N;'),
('UserDeleteStudent', 0, NULL, NULL, 'N;'),
('PostDeletePicterPost', 0, NULL, NULL, 'N;'),
('UserDownloadFile', 0, NULL, NULL, 'N;'),
('teacher', 1, '', '', 's:0:"";'),
('UserUploadfilegroup', 0, NULL, NULL, 'N;'),
('UserDeleteFileGroup', 0, NULL, NULL, 'N;'),
('UserMyProfile', 0, NULL, NULL, 'N;'),
('UserGroupfile', 0, NULL, NULL, 'N;'),
('UserManageGroup', 0, NULL, NULL, 'N;'),
('UserClassmateBlokked', 0, NULL, NULL, 'N;'),
('ReestrGetSchedule', 0, NULL, NULL, 'N;'),
('SiteActivity', 0, NULL, NULL, 'N;'),
('UserDeleteActivity', 0, NULL, NULL, 'N;'),
('UserSaveActivity', 0, NULL, NULL, 'N;'),
('SiteSlide', 0, NULL, NULL, 'N;'),
('Prepod', 2, '', '', 's:0:"";'),
('UserRazBanStudent', 0, NULL, NULL, 'N;'),
('SlideView', 0, NULL, NULL, 'N;'),
('SlideCreate', 0, NULL, NULL, 'N;'),
('SlideUpdate', 0, NULL, NULL, 'N;'),
('SlideDelete', 0, NULL, NULL, 'N;'),
('SlideIndex', 0, NULL, NULL, 'N;'),
('SlideAdmin', 0, NULL, NULL, 'N;'),
('userAdmin@AdminDeleteUser', 0, NULL, NULL, 'N;'),
('userAdmin@AdminPodobiu', 0, NULL, NULL, 'N;'),
('userAdmin@AdminZapolnit', 0, NULL, NULL, 'N;'),
('userAdmin@AdminInfogroup', 0, NULL, NULL, 'N;'),
('userAdmin@AdminsaveInfogroup', 0, NULL, NULL, 'N;'),
('LibraryUpload', 0, NULL, NULL, 'N;'),
('LibraryPrepodpredmets', 0, NULL, NULL, 'N;'),
('LibraryChangepredmets', 0, NULL, NULL, 'N;'),
('LibraryDownloads', 0, NULL, NULL, 'N;'),
('LibraryDeleteFile', 0, NULL, NULL, 'N;'),
('userAdmin@AdminInstitute', 0, NULL, NULL, 'N;'),
('userAdmin@AdmindeleteInstitute', 0, NULL, NULL, 'N;'),
('LibraryEditText', 0, NULL, NULL, 'N;'),
('UserDoorDownloadFile', 0, NULL, NULL, 'N;'),
('PostMyPost', 0, NULL, NULL, 'N;'),
('PostDeleteMyPost', 0, NULL, NULL, 'N;'),
('ForumDeleteForum', 0, NULL, NULL, 'N;'),
('FilesFiles', 0, NULL, NULL, 'N;'),
('FilesChangeFolder', 0, NULL, NULL, 'N;'),
('FilesDeleteFolder', 0, NULL, NULL, 'N;'),
('FilesUpdateDirectory', 0, NULL, NULL, 'N;'),
('FilesSaveChangeFolder', 0, NULL, NULL, 'N;'),
('FilesOpenFolder', 0, NULL, NULL, 'N;'),
('FilesDownloadFile', 0, NULL, NULL, 'N;'),
('FilesDoorDownloadFile', 0, NULL, NULL, 'N;'),
('FilesDownloads', 0, NULL, NULL, 'N;'),
('UserChangeFakeProfile', 0, NULL, NULL, 'N;'),
('UserSaveFakeProfile', 0, NULL, NULL, 'N;'),
('UserChageStudentStats', 0, NULL, NULL, 'N;');

-- --------------------------------------------------------

--
-- Структура таблицы `statistic`
--

CREATE TABLE `statistic` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `otl` int(255) NOT NULL,
  `hor` int(255) NOT NULL,
  `udov` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_academic_year`
--

CREATE TABLE `tbl_academic_year` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `start` int(128) NOT NULL,
  `end` int(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `tbl_academic_year`
--

INSERT INTO `tbl_academic_year` (`id`, `name`, `start`, `end`) VALUES
(1, '2005-2006', 2005, 2006),
(2, '2006-2007', 2006, 2007),
(3, '2007-2008', 2007, 2008),
(4, '2008-2009', 2008, 2009),
(5, '2009-2010', 2009, 2010),
(6, '2010-2011', 2010, 2011),
(7, '2011-2012', 2011, 2012),
(8, '2012-2013', 2012, 2013),
(9, '2013-2014', 2013, 2014),
(10, '2014-2015', 2014, 2015),
(11, '2015-2016', 2015, 2016),
(12, '2016-2017', 2016, 2017),
(13, '2017-2018', 2017, 2018);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `magnite_date` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `day` varchar(16) NOT NULL,
  `mounth` varchar(16) NOT NULL,
  `year` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Дамп данных таблицы `tbl_activity`
--

INSERT INTO `tbl_activity` (`id`, `magnite_date`, `title`, `content`, `day`, `mounth`, `year`) VALUES
(18, '02/20/2013', 'Тинчуринские чтения', '(дата пока точно не известна)', '20', '02', '2013'),
(25, '03/12/2013', 'мастер-класс', 'Лекция на тему «Основы технологических процессов на ТЭС»', '12', '03', '2013'),
(21, '03/11/2013', 'мастер-класс', 'Экскурсия в филиал ООО «КЭР-Инжиниринг» «КЭР-Автоматика»', '11', '03', '2013'),
(24, '03/13/2013', 'мастер-класс', 'Лекция на тему «Основы технологических процессов на ТЭС»', '13', '03', '2013'),
(31, '03/14/2013', 'мастер-класс', 'Лекция на тему «Основы технологических процессов на ТЭС». Мини-конкурсы', '14', '03', '2013'),
(32, '03/08/2013', 'Переезд сайта на новый хостинг', 'Сайт будет недоступен начиная с 8 часов вечера и до следующего утра', '08', '03', '2013'),
(45, '07/06/2013', 'Курсы программирования', 'Будем рады всем желающим. Начало в 11:00. (js, css, html, php)', '06', '07', '2013'),
(44, '06/29/2013', 'Курсы программирования', 'Будем рады всем желающим. Начало в 11:00. (js, css, html, php)', '29', '06', '2013');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_cafedra`
--

CREATE TABLE `tbl_cafedra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Дамп данных таблицы `tbl_cafedra`
--

INSERT INTO `tbl_cafedra` (`id`, `name`) VALUES
(18, 'Тепловые электрические станции'),
(7, 'Экономика и организация производства'),
(8, 'Инженерный менеджмент'),
(9, 'Политология и право'),
(10, 'Социология'),
(11, 'Педагогика и психология профессионального образования'),
(12, 'Философия'),
(13, 'Иностранные языки'),
(14, 'Документоведение'),
(15, 'Русский и татарский языки'),
(16, 'История, культурология и архивоведение'),
(17, 'Инженерная графика'),
(19, 'Промышленная теплоэнергетика'),
(20, 'Динамика и прочность машин'),
(21, 'Теоретические основы теплотехники'),
(22, 'Энергообеспечение предприятий агропромышленного комплекса'),
(23, 'Химия'),
(24, 'Физическое воспитание'),
(25, 'Энергообеспечение предприятий и энергоресурсосберегающие технологии'),
(26, 'Технология воды и топлива'),
(27, 'Промышленные теплоэнергетические установки и системы теплоснабжения'),
(28, 'Автоматизация технологических процессов и производств'),
(29, 'Электромеханика энергосистем и силового оборудования'),
(30, 'Водные биоресурсы и аквакультура'),
(31, 'Газотурбинные энергоустановки и двигатели'),
(32, 'Электрические станции'),
(33, 'Электроснабжение промышленных предприятий'),
(34, 'Безопасность жизнедеятельности'),
(35, 'Инженерная кибернетика'),
(36, 'Теоретические основы электротехники'),
(37, 'Информатика и информационно-управляющие системы'),
(38, 'Промышленная электроника'),
(39, 'Светотехника и медико-биологическая электроника'),
(40, 'Электроэнергетические системы и сети'),
(41, 'Высшая математика'),
(42, 'Физика'),
(43, 'Электропривод и автоматизация промышленных установок и технологических комплексов'),
(44, 'Материаловедение и технология материалов'),
(45, 'Электрооборудование и электрохозяйство предприятий, организаций и учреждений'),
(46, 'Электрический транспорт'),
(47, 'Релейная защита и автоматизация электроэнергетических систем'),
(48, 'Инженерная экология и рациональное природопользование');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `url` varchar(128) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `profile_id` int(255) NOT NULL,
  `status` int(128) NOT NULL DEFAULT '2',
  `rating` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_post` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_discussion`
--

CREATE TABLE `tbl_discussion` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `profile_id` int(255) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `group_id` int(255) NOT NULL,
  `last_update` int(255) DEFAULT NULL,
  `rating` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_filetopost`
--

CREATE TABLE `tbl_filetopost` (
  `post_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_folder`
--

CREATE TABLE `tbl_folder` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` int(255) NOT NULL,
  `private_status` int(255) NOT NULL DEFAULT '1',
  `parent_id` int(255) DEFAULT NULL,
  `type` int(2) NOT NULL DEFAULT '1',
  `uploads_id` int(255) DEFAULT NULL,
  `hide` int(2) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_forum`
--

CREATE TABLE `tbl_forum` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `content` text,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created` int(255) NOT NULL,
  `rating` int(255) DEFAULT NULL,
  `view` int(255) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_forum_comment`
--

CREATE TABLE `tbl_forum_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `text` text,
  `created` int(255) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `forum_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_forum_tag`
--

CREATE TABLE `tbl_forum_tag` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `forum_id` int(255) NOT NULL,
  `tag_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_group`
--

CREATE TABLE `tbl_group` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `id_year_create` int(20) DEFAULT NULL,
  `id_semestr` int(128) DEFAULT NULL,
  `mean` varchar(64) DEFAULT NULL,
  `all_man` int(11) DEFAULT NULL,
  `curator` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `name`, `id_year_create`, `id_semestr`, `mean`, `all_man`, `curator`) VALUES
(1, 'УИТ', 6, NULL, '4.241', 10, '<a href="http://atpp.in/user/ViewProfile/67">Владимир Плотников</a>'),
(5, 'АТ', 6, NULL, '4.165', 14, 'Наталья Богданова'),
(6, 'УИТ', 7, NULL, '4.544', 20, '<a href="http://atpp.in/user/ViewProfile/35" >Богданов А. Н.</a>'),
(7, 'УИТ', 8, NULL, '3.853', 20, '-'),
(10, 'АТ', 5, NULL, NULL, 10, '-'),
(9, 'УИТ', 5, NULL, NULL, 10, '-'),
(11, 'УИТ', 9, NULL, NULL, 16, 'Андрей Геннадьевич');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_group_file`
--

CREATE TABLE `tbl_group_file` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `file_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `scope_id` int(11) DEFAULT NULL,
  `profile_id` int(11) NOT NULL,
  `create_time` date DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `group_name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_group_year_create`
--

CREATE TABLE `tbl_group_year_create` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `start_year` int(128) NOT NULL,
  `prefix_year` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `tbl_group_year_create`
--

INSERT INTO `tbl_group_year_create` (`id`, `start_year`, `prefix_year`) VALUES
(1, 2004, '04'),
(2, 2005, '05'),
(3, 2006, '06'),
(4, 2007, '07'),
(5, 2008, '08'),
(6, 2009, '09'),
(7, 2010, '10'),
(8, 2011, '11'),
(9, 2012, '12'),
(10, 2013, '13'),
(11, 2014, '14'),
(12, 2015, '15'),
(13, 2016, '16'),
(14, 2017, '17'),
(15, 2018, '18'),
(16, 2019, '19'),
(17, 2020, '20'),
(18, 2021, '21');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_institute`
--

CREATE TABLE `tbl_institute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_institute`
--

INSERT INTO `tbl_institute` (`id`, `name`) VALUES
(4, 'ИТЭ'),
(2, 'ИЭЭ'),
(3, 'ИЭИТ');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_institute_cafedra`
--

CREATE TABLE `tbl_institute_cafedra` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `institute_id` int(255) NOT NULL,
  `cafedra_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Дамп данных таблицы `tbl_institute_cafedra`
--

INSERT INTO `tbl_institute_cafedra` (`id`, `institute_id`, `cafedra_id`) VALUES
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 3, 10),
(11, 3, 11),
(12, 3, 12),
(13, 3, 13),
(14, 3, 14),
(15, 3, 15),
(16, 3, 16),
(17, 3, 17),
(18, 4, 18),
(19, 4, 19),
(20, 4, 20),
(21, 4, 21),
(22, 4, 22),
(23, 4, 23),
(24, 4, 24),
(25, 4, 25),
(26, 4, 26),
(27, 4, 27),
(28, 4, 28),
(29, 4, 29),
(30, 4, 30),
(31, 4, 31),
(32, 2, 32),
(33, 2, 33),
(34, 2, 34),
(35, 2, 35),
(36, 2, 36),
(37, 2, 37),
(38, 2, 38),
(39, 2, 39),
(40, 2, 40),
(41, 2, 41),
(42, 2, 42),
(43, 2, 43),
(44, 2, 44),
(45, 2, 45),
(46, 2, 46),
(47, 2, 47),
(48, 2, 48);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_kurs`
--

CREATE TABLE `tbl_kurs` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tbl_kurs`
--

INSERT INTO `tbl_kurs` (`id`, `name`) VALUES
(1, '1 курс'),
(2, '2 курс'),
(3, '3 курс'),
(4, '4 курс'),
(5, '5 курс');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_lookup`
--

CREATE TABLE `tbl_lookup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `code` int(11) NOT NULL,
  `type` varchar(128) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `tbl_lookup`
--

INSERT INTO `tbl_lookup` (`id`, `name`, `code`, `type`, `position`) VALUES
(1, 'Черновки', 1, 'PostStatus', 1),
(2, 'Опубликовать', 2, 'PostStatus', 2),
(3, 'В архив', 3, 'PostStatus', 3),
(4, 'В ожидании утверждения', 1, 'CommentStatus', 1),
(5, 'Подтвердить', 2, 'CommentStatus', 2),
(6, 'Кафедральные', 1, 'PostTopic', 1),
(7, 'Мировые', 2, 'PostTopic', 2),
(8, 'Показать', 1, 'FotoStatus', 1),
(9, 'Скрыть', 2, 'FotoStatus', 2),
(10, 'не выбран', 1, 'userstatus', 1),
(11, 'Студент', 2, 'userstatus', 2),
(12, 'Преподователь', 3, 'userstatus', 3),
(13, '2', 2, 'rating', 2),
(14, '3', 3, 'rating', 3),
(15, '4', 4, 'rating', 4),
(16, '5', 5, 'rating', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_object_rating`
--

CREATE TABLE `tbl_object_rating` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `type` int(16) NOT NULL,
  `object_id` int(255) NOT NULL,
  `value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_order_pair`
--

CREATE TABLE `tbl_order_pair` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` int(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tbl_order_pair`
--

INSERT INTO `tbl_order_pair` (`id`, `name`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `tags` text,
  `status` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `content_previews` text,
  `topic` tinyint(4) NOT NULL,
  `show_foto` int(2) DEFAULT NULL,
  `cover_id` int(250) DEFAULT NULL,
  `prosmotr` int(255) DEFAULT NULL,
  `profile_id` int(255) DEFAULT NULL,
  `rating` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_predmet`
--

CREATE TABLE `tbl_predmet` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `text` text,
  `cafedra_id` int(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Дамп данных таблицы `tbl_predmet`
--

INSERT INTO `tbl_predmet` (`id`, `name`, `text`, `cafedra_id`) VALUES
(12, 'Инженерная компьютерная графика', '                    Инженерная графика\r\n<br/><br/>\r\nСовременное технологическое оборудование, машины, приборы и системы не представляется возможным освоить, не зная предмет «Инженерная графика». Каждый работник инженерного направления, связанного с техникой, производством изделий, монтажом, сборкой, эксплуатацией и контролем должен владеть им в совершенстве.\r\n<br/><br/>\r\nЧто же такое инженерная графика? Говоря по научному, инженерная графика — это дисциплина, которая изучает, как строится и оформляется технический чертеж. А чертеж представляет собой документ, содержащий контурное изображение предмета, а также иные данные, требуемые при изготовлении, контроле и идентификации изделия. Кроме того, он содержит информацию, необходимую для операций непосредственно с самим документом.\r\n<br/><br/>\r\nБазой для данного предмета является начертательная геометрия. Это раздел геометрии, где изучаются пространственные фигуры путем создания изображений на плоскости, а также методики исследования и решения пространственных задач на плоской поверхности.                  ', 17),
(13, 'Информатика', '                Информа́тика (от информация и автоматика) — наука о методах и процессах сбора, хранения, обработки, анализа и оценивания информации, обеспечивающих возможность её использования для принятия решений. Она включает дисциплины, относящиеся к обработке информации в вычислительных машинах и вычислительных сетях: как абстрактные, вроде анализа алгоритмов, так и конкретные, например разработка языков программирования и протоколов передачи данных.\r\n<br/><br/>\r\nТемами исследований в информатике являются вопросы: что можно, а что нельзя реализовать в программах и базах данных (теория вычислимости и искусственный интеллект), каким образом можно решать специфические вычислительные и информационные задачи с максимальной эффективностью (теория сложности вычислений), в каком виде следует хранить и восстанавливать информацию специфического вида (структуры и базы данных), как программы и люди должны взаимодействовать друг с другом (пользовательский интерфейс и языки программирования и представление знаний) и т. п.  ', 37),
(14, 'Химия', '                Хи́мия — одна из важнейших и обширных областей естествознания, наука о веществах, их свойствах, строении и превращениях, происходящих в результате химических реакций, а также фундаментальных законах, которым эти превращения подчиняются. Поскольку все вещества состоят из атомов, которые благодаря химическим связям способны формировать молекулы, то химия занимается в основном изучением взаимодействий между атомами и молекулами, полученными в результате таких взаимодействий. Предмет химии — химические элементы и их соединения, а также закономерности, которым подчиняются различные химические реакции.  ', 23),
(15, 'Математика', '                Матема́тика  — наука о структурах, порядке и отношениях, которая исторически сложилась на основе операций подсчёта, измерения и описания форм реальных объектов[1]. Математические объекты создаются путём идеализации свойств реальных или других математических объектов и записи этих свойств на формальном языке. Математика не относится к естественным наукам, но широко используется в них как для точной формулировки их содержания, так и для получения новых результатов.\r\n<br/>\r\n Математика — фундаментальная наука, предоставляющая (общие) языковые средства другим наукам; тем самым она выявляет их структурную взаимосвязь и способствует нахождению самых общих законов природы.  ', 41),
(16, 'Физика', '    Фи́зика (от др.-греч. φύσις — природа) — область естествознания. Наука, изучающая наиболее общие и фундаментальные закономерности, определяющие структуру и эволюцию материального мира. Законы физики лежат в основе всего естествознания. \r\n<br/><br/>\r\nТермин «физика» впервые появился в сочинениях одного из величайших мыслителей древности — Аристотеля, жившего в четвертом веке до нашей эры. Первоначально термины «физика» и «философия» были синонимичны, поскольку обе дисциплины пытаются объяснить законы функционирования Вселенной. Однако в результате научной революции XVI века физика выделилась в отдельное научное направление.\r\n<br/><br/>\r\nВ русский язык слово «физика» было введено Михаилом Васильевичем Ломоносовым, когда он издал первый в России учебник физики в переводе с немецкого языка. Первый русский учебник под названием «Краткое начертание физики» был написан первым русским академиком П. И. Страховым.\r\n<br/><br/>\r\nВ современном мире значение физики чрезвычайно велико. Всё то, чем отличается современное общество от общества прошлых веков, появилось в результате применения на практике физических открытий. Так, исследования в области электромагнетизма привели к появлению телефонов и позже мобильных телефонов, открытия в термодинамике позволили создать автомобиль, развитие электроники привело к появлению компьютеров.  ', 42),
(17, 'Иностранный язык', '      ', 13),
(18, 'Физическое воспитание', '      ', 24),
(19, 'ВВС', '(введение в специальность)', 28),
(20, 'Теоретическая Механика', '                    Теорети́ческая меха́ника — наука об общих законах механического движения и взаимодействия материальных тел. Будучи по существу одним из разделов физики, теоретическая механика, вобрав в себя фундаментальную основу в виде аксиоматики, выделилась в самостоятельную науку и получила широкое развитие благодаря своим обширным и важным приложениям в естествознании и технике, одной из основ которой она является.    ', NULL),
(21, 'ОКРЯ', '      ', 15),
(22, 'Программирование и основы алгоритмизации', '      ', 35),
(23, 'Материаловедение', '                Материаловедение — междисциплинарный раздел науки, изучающий изменения свойств материалов, как в твёрдом, так и в жидком состоянии в зависимости от некоторых факторов. К изучаемым свойствам относятся структура веществ, электронные, термические, химические, магнитные, оптические свойства этих веществ. Материаловедение можно отнести к тем разделам физики и химии, которые занимаются изучением свойств материалов. Кроме того, эта наука использует целый ряд методов, позволяющих исследовать структуру материалов. При изготовлении наукоёмких изделий в промышленности, особенно при работе с объектами микро- и наноразмеров необходимо детально знать характеристику, свойства и строение материалов. Решить эти задачи и призвана наука — материаловедение.  ', 44),
(24, 'ГГД', '                Гидрогазодина́мика — раздел физики сплошных сред, изучающий движение идеальных и реальных жидкости и газа. Как и в других разделах физики сплошных сред, прежде всего осуществляется переход от реальной среды, состоящей из большого числа отдельных атомов или молекул, к абстрактной сплошной среде, для которой и записываются уравнения движения.  ', 21),
(25, 'ТОЭ', '    Теоретические основы электроники<br/>\r\nТОЭ — техническая дисциплина, связанная с изучением теории электричества и электромагнетизма.  ', 36),
(26, 'Сопромат', '            Сопротивление материалов (в обиходе — сопромат) — часть механики деформируемого твёрдого тела, которая рассматривает методы инженерных расчётов конструкций на прочность, жесткость и устойчивость при одновременном удовлетворении требований надежности, экономичности и долговечности. Сопротивление материалов относится к фундаментальным дисциплинам общеинженерной подготовки специалистов с высшим техническим образованием, за исключением специальностей, не связанных с проектированием объектов, для которых прочность является важным показателем.', NULL),
(27, 'Моделирование систем', '      ', 35),
(28, 'ВМСС', '      ', 28),
(29, 'Экология', '                Эколо́гия (от др.-греч. οἶκος — обиталище, жилище, дом, имущество и λόγος — понятие, учение, наука) — наука о взаимодействиях живых организмов и их сообществ между собой и с окружающей средой. Термин впервые предложил немецкий биолог Эрнст Геккель в 1866 году в книге «Общая морфология организмов» («Generelle Morphologie der Organismen»).  ', 48),
(30, 'ТАУ', '                Теория автоматического управления<br/><br/>\r\nТеория автоматического управления (ТАУ) — научная дисциплина, изучающая процессы автоматического управления объектами разной физической природы. При этом при помощи математических средств выявляются свойства систем автоматического управления и разрабатываются рекомендации по их проектированию.\r\n\r\nТеория автоматического управления (ТАУ) — это составная часть технической кибернетики, которая предназначена для разработки общих принципов автоматического управления, а также методов анализа (исследования функционирования) и синтеза (выбора параметров) систем автоматического управления (САУ) техническими объектами.  ', 28),
(31, 'Правоведение', '                Сравнительное правоведение, правовая компаративистика, юридическая компаративистика — отрасль (раздел) правоведения (юридической науки), изучающая правовые системы различных государств путем сопоставления одноименных государственных и правовых институтов, их основных принципов и категорий.  ', 9),
(32, 'Экономика', '                Эконо́мика (от др.-греч. οἶκος — дом и νόμος — правило, закон, буквально «правила ведения хозяйства») — хозяйственная деятельность общества, а также совокупность отношений, складывающихся в системе производства, распределения, обмена и потребления.\r\n<br/><br/>\r\nВпервые в научном труде слово «экономика» появляется в IV в. до н. э. у Ксенофонта, который называет её «естественной наукой». Аристотель противопоставлял экономику хрематистике — отрасли деятельности человека, связанной с извлечением выгоды. В современной философии экономика рассматривается как система общественных отношений, рассмотренных с позиции понятия стоимости. Главная функция экономики состоит в том, чтобы постоянно создавать такие блага, которые необходимы для жизнедеятельности людей и без которых общество не сможет развиваться. Экономика помогает удовлетворить потребности человека в мире ограниченных ресурсов.\r\n<br/><br/>\r\nЭкономика общества представляет собой сложный и всеохватывающий организм, который обеспечивает жизнедеятельность каждого человека и общества.  ', 7),
(34, 'Социология', '                Социоло́гия (от лат. socius — общественный + др.-греч. λόγος — наука) — это наука об обществе, системах, составляющих его, закономерностях его функционирования и развития, социальных институтах, отношениях и общностях.\r\n<br/><br/>\r\nТермин «социология» был введён в научный оборот О. Контом в 1832 году в 47-й лекции «Курса позитивной философии»[1]. По мнению ряда исследователей, О. Конт не был первым, кто ввёл и применил этот термин — известный французский политический деятель и публицист эпохи Великой французской революции и Первой империи аббат Э.-Ж. Сийес на полвека раньше (1780 г.) О. Конта использовал его, вкладывая в термин «социология» (по-французски — «sociologie») несколько иной смысл[2]. В «Курсе позитивной философии» О.Конт обосновывает новую науку — социологию. Конт считал, что социология — это наука, занимающаяся, как и другие науки (формы «позитивного знания»), наблюдением, опытом и сравнением, которые адекватны новому социальному порядку индустриального общества. По мнению Г.Спенсера, основной задачей социологии является изучение эволюционных изменений в социальных структурах и институтах. В. И. Ленин полагал, что только с открытием материалистического понимания истории социология впервые была возведена на ступень науки. \r\n<br/><br/>\r\nНесмотря на политическую и идеологическую ориентацию марксистской теории общества, следует признать, что она, безусловно, содержала немало ценных идей, обогативших социологическую мысль.  ', 10),
(35, 'Русский язык', '      ', 15),
(36, 'ТД и ТМО', '      ', 21),
(37, 'Основы энергосбережения', '      ', 25),
(38, 'Философия', '    Филосо́фия (φιλία — любовь, стремление, жажда + σοφία — мудрость → др.-греч. φιλοσοφία (дословно: любовь к мудрости)) — дисциплина, изучающая наиболее общие существенные характеристики и фундаментальные принципы реальности (бытия) и познания, бытия человека, отношения человека и мира[2][3][4]. К задачам философии на протяжении её истории относились как изучение всеобщих законов развития мира и общества, так и изучение самого процесса познания и мышления, а также изучение нравственных категорий и ценностей. К числу основных философских вопросов, например, относятся вопросы «Что первично — материя или сознание?», «Познаваем ли мир?», «Существует ли Бог?», «Что такое истина?», «Что такое хорошо?» и другие  ', 12),
(39, 'ИРАТ', '    история развития автоматизации  ', 28),
(40, 'Политология', '    Политоло́гия (греч. πολιτικός — общественный, от греч. πολίτης — гражданин, далее от греч. πόλις — город; др.-греч. λόγος — учение, слово), или политическая наука, — наука о политике, то есть об особой сфере жизнедеятельности людей, связанной с властными отношениями, с государственно-политической организацией общества, политическими институтами, принципами, нормами, действие которых призвано обеспечить функционирование общества, взаимоотношения между людьми, обществом и государством.\r\n<br/><br/>\r\nТрадиция преподавания политических наук в России существует с 1755 года, когда по предложению М. В. Ломоносова в структуре Московского университета была учреждена кафедра политики[1]. С 1804 по 1835 год в составе Московского университета работал факультет нравственных и политических наук, подготавливающий специалистов в области политики и политической экономии.  ', 9),
(41, 'Психология и педагогика', '      ', 11),
(42, 'Актуальные вопросы', '      ', 7),
(43, 'СПО', '    системы программного обеспечения  ', 28),
(44, 'МСС', '            (метрология стандартизация и сертификация)\r\n<br/><br/>\r\nМетроло́гия (от греч. μέτρον — мера, измерительный инструмент + др.-греч. λόγος — мысль, причина) — наука об измерениях, методах и средствах обеспечения их единства и способах достижения требуемой точности (РМГ 29-99). Предметом метрологии является извлечение количественной информации о свойствах объектов с заданной точностью и достоверностью; нормативная база для этого — метрологические стандарты.      ', 28),
(45, 'ИСТК', '      ', 28),
(46, 'АТПП', '    ( Автоматизация технологического процесса и производств)<br/><br/>\r\n            Автоматизация технологического процесса — совокупность методов и средств, предназначенная для реализации системы или систем, позволяющих осуществлять управление самим технологическим процессом без непосредственного участия человека, либо оставления за человеком права принятия наиболее ответственных решений.\r\n<br/><br/>\r\nКак правило, в результате автоматизации технологического процесса создаётся АСУ ТП.\r\n<br/><br/>\r\nОснова автоматизации технологических процессов — это перераспределение материальных, энергетических и информационных потоков в соответствии с принятым критерием управления (оптимальности).  ', 28),
(47, 'История', '                Исто́рия (др.-греч. ἱστορία — расспрашивание, исследование) — область знаний, а также гуманитарная наука, занимающаяся изучением человека (его деятельности, состояния, мировоззрения, социальных связей и организаций и так далее) в прошлом.\r\n<br/><br/>\r\nВ более узком смысле история — это наука, изучающая всевозможные источники о прошлом для того, чтобы установить последовательность событий, исторический процесс, объективность описанных фактов и сделать выводы о причинах событий.  ', 16),
(48, 'Культурология', '                Культурология (лат. cultura — возделывание, земледелие, воспитание; др.-греч. λόγος — мысль как причина) — совокупность исследований культуры как структурной целостности, выявление закономерностей её развития. В задачи культурологии входит понимание общих характеристик её бытия, системный анализ ее развития. Как самостоятельное направление культурология сложилась в новое время.  ', 16),
(49, 'АИУС', '      ', 28),
(50, 'БЖД', '                Безопасность жизнедеятельности (БЖД) — наука о комфортном и травмобезопасном взаимодействии человека со средой обитания. Является составной частью системы государственных, социальных и оборонных мероприятий, проводимых в целях защиты населения и хозяйства страны от последствий аварий, катастроф, стихийных бедствий, средств поражения противника. Целью БЖД также является снижение риска возникновения чрезвычайной ситуации по вине человеческого фактора  ', 34),
(51, 'РЗА', '     (РЕЛЕЙНАЯ ЗАЩИТА И АВТОМАТИЗАЦИЯ)\r\nРелейная защита — комплекс автоматических устройств, предназначенных для быстрого (при повреждениях) выявления и отделения от электроэнергетической системы повреждённых элементов этой электроэнергетической системы в аварийных ситуациях с целью обеспечения нормальной работы всей системы. Действия средств релейной защиты организованы по принципу непрерывной оценки технического состояния отдельных контролируемых элементов электроэнергетических систем. Релейная защита (РЗ) осуществляет непрерывный контроль состояния всех элементов электроэнергетической системы и реагирует на возникновение повреждений и ненормальных режимов. При возникновении повреждений РЗ должна выявить повреждённый участок и отключить его от ЭЭС, воздействуя на специальные силовые выключатели, предназначенные для размыкания токов повреждения (короткого замыкания).  ', 47),
(52, 'ОПП', '    Организация и планирование производства  ', 7),
(53, 'ТСА и У', '      ', 28),
(54, 'СИИ', NULL, NULL),
(55, 'СПА', '    современные проблемы автоматизации  ', 28),
(56, 'Прикладная механика', '    Прикладная механика — техническая наука, посвящённая исследованиям устройств и принципов механизмов.\r\n<br/>\r\nПрикладная механика занимается изучением и классификацией машин, а также их разработкой.\r\n\r\n  ', 20),
(57, 'ТПИ', NULL, NULL),
(58, 'ТИП', '(технические измерения и приборы)', 28),
(59, 'ТПП', '    технология процессов и производств  ', 18),
(60, 'ТСА', '                технические средства автоматизации  ', 28),
(61, 'ДиНАС', '            ', 28),
(62, 'СПУЭ', '                        современные проблемы управления в энергетике      ', 28),
(63, 'ТЭС и АЭС', '                тепловые электро станции и атомные электрические станции  ', 18),
(64, 'ПАС ', '(Проектирование автоматизированных систем)', 28),
(65, 'МПСУ', '    (микропроцессорные системы управления)\r\n<br/><br/>\r\nМикропроцессорная система (МПС) представляет собой функционально законченное изделие, состоящее из одного или нескольких устройств, главным образом микропроцессорных: микропроцессора и/или микроконтроллера.  ', 28),
(66, 'НИР', '            научно исследовательская работа', NULL),
(67, 'Физкультура', '            ', 24),
(68, 'ТТЭ', NULL, NULL),
(69, 'ТМО', '      ', 21),
(70, 'ФОЭ', NULL, NULL),
(71, 'Физика в теплоэнергетике', NULL, NULL),
(72, 'Термодинамика', '      ', 21),
(74, 'Математическое обеспечение ТАУ', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_predmet_file`
--

CREATE TABLE `tbl_predmet_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uploads_id` int(11) NOT NULL,
  `predmet_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `count_uploads` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_predmet_prepod`
--

CREATE TABLE `tbl_predmet_prepod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `predmet_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `tbl_predmet_prepod`
--

INSERT INTO `tbl_predmet_prepod` (`id`, `predmet_id`, `profile_id`) VALUES
(6, 49, 35),
(7, 53, 35);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_predmet_semestr_group`
--

CREATE TABLE `tbl_predmet_semestr_group` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `predmet_id` int(128) NOT NULL,
  `semestr_id` int(128) NOT NULL,
  `group_id` int(128) NOT NULL,
  `hash_psg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_private_status`
--

CREATE TABLE `tbl_private_status` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_private_status`
--

INSERT INTO `tbl_private_status` (`id`, `name`) VALUES
(1, 'только мне'),
(2, 'мне и студентам'),
(3, 'мне и преподавателям'),
(4, 'всем');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_profile`
--

CREATE TABLE `tbl_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `surname` varchar(128) DEFAULT NULL,
  `patronymic` varchar(128) DEFAULT NULL,
  `private` text,
  `status` int(128) DEFAULT NULL,
  `file_id` int(128) DEFAULT NULL,
  `leader` int(1) DEFAULT NULL,
  `group_id` int(128) DEFAULT NULL,
  `mean` varchar(128) DEFAULT NULL,
  `instruct` int(16) DEFAULT NULL,
  `skype` text,
  `kontakt_email` varchar(255) DEFAULT NULL,
  `pthon` varchar(64) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `kontact` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `minus` int(255) DEFAULT NULL,
  `plus` int(255) DEFAULT NULL,
  `fake` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- Дамп данных таблицы `tbl_profile`
--

INSERT INTO `tbl_profile` (`id`, `user_id`, `name`, `surname`, `patronymic`, `private`, `status`, `file_id`, `leader`, `group_id`, `mean`, `instruct`, `skype`, `kontakt_email`, `pthon`, `contact_email`, `kontact`, `website`, `minus`, `plus`, `fake`) VALUES
(22, 65, 'Админ', 'Админ', 'Админ', '', 2, 427, 1, 1, '3.254', 1, 'm.gryaznov1', 'lkdnvc@gmail.com', '(927) 671-65-11', NULL, 'http://vk.com/googl', 'atpp.in', 3, 28, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `value` int(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `name`, `value`) VALUES
(1, 'неудовлетворительно', 2),
(2, 'удовлетворительно', 3),
(3, 'хорошо', 4),
(4, 'отлично', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `group_id` int(64) NOT NULL,
  `semestr_id` int(64) NOT NULL,
  `weekday_id` int(64) NOT NULL,
  `predmet_id` int(64) DEFAULT NULL,
  `predmet_1_id` int(64) DEFAULT NULL,
  `predmet_2_id` int(64) DEFAULT NULL,
  `time_pair_id` int(64) DEFAULT NULL,
  `type_pair_id` int(64) DEFAULT NULL,
  `room` varchar(64) DEFAULT NULL,
  `order` int(64) NOT NULL,
  `week_razd` int(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Дамп данных таблицы `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `group_id`, `semestr_id`, `weekday_id`, `predmet_id`, `predmet_1_id`, `predmet_2_id`, `time_pair_id`, `type_pair_id`, `room`, `order`, `week_razd`) VALUES
(8, 5, 8, 1, 0, 63, 0, 5, 4, 'Д-422 1,5,9,13 н.', 1, 2),
(9, 5, 8, 1, 0, 63, 0, 6, 4, 'Д-422 1,5,9,13 н.', 2, 2),
(11, 5, 8, 2, 67, 0, 0, 4, 3, 'ул.голубятникова', 1, 1),
(12, 5, 8, 2, 63, 0, 0, 5, 1, 'А-421', 2, 1),
(13, 5, 8, 2, 64, 0, 0, 5, 3, 'В-421', 3, 1),
(14, 5, 8, 3, 0, 63, 0, 4, 3, 'А-422', 1, 2),
(15, 5, 8, 3, 46, 0, 0, 5, 1, 'В-406', 2, 1),
(16, 5, 8, 3, 0, 0, 46, 6, 3, 'В-423', 3, 3),
(17, 5, 8, 4, 0, 65, 0, 3, 4, 'В-423 3,7,11,15 н.', 1, 2),
(18, 5, 8, 4, 65, 0, 0, 4, 4, 'В-423 ', 2, 1),
(19, 5, 8, 4, 0, 65, 0, 5, 1, 'В-421', 3, 2),
(20, 5, 8, 5, 66, 0, 0, 3, 1, 'В-421', 1, 1),
(21, 5, 8, 5, 65, 0, 0, 4, 1, 'В-421', 2, 1),
(22, 5, 8, 5, 65, 0, 0, 5, 3, 'В-423', 3, 1),
(23, 5, 8, 6, 0, 64, 0, 2, 4, 'В-423 1,5,9,13 н.', 1, 2),
(24, 5, 8, 6, 0, 0, 64, 3, 1, 'В-408 ', 2, 3),
(25, 5, 8, 6, 64, 0, 0, 4, 1, 'В-408 ', 3, 1),
(26, 5, 8, 6, 0, 0, 64, 5, 3, 'В-419 ', 4, 3),
(27, 1, 8, 1, 68, 0, 0, 3, 4, 'В-423 1,5,9,13 н.', 1, 1),
(28, 1, 8, 2, 67, 0, 0, 4, 3, 'ул.голубятникова', 1, 1),
(29, 1, 8, 3, 49, 0, 0, 6, 4, 'В-413 2,6,10,14 н', 1, 1),
(30, 1, 8, 4, 68, 0, 0, 5, 1, 'В-423', 1, 1),
(31, 1, 8, 5, 66, 0, 0, 3, 1, 'В-421', 1, 1),
(32, 1, 8, 6, 64, 0, 0, 2, 4, 'В-423 3,7,11,15 н.', 1, 1),
(33, 1, 8, 1, 68, 0, 0, 4, 4, 'В-423 1,5,9,13 н.', 2, 1),
(34, 1, 8, 2, 0, 68, 0, 5, 1, 'В-421', 2, 2),
(35, 1, 8, 2, 0, 0, 49, 5, 1, 'В-419', 2, 3),
(36, 1, 8, 2, 64, 0, 0, 6, 3, 'В-421', 3, 1),
(37, 1, 8, 4, 68, 0, 0, 6, 3, 'В-423', 2, 1),
(38, 1, 8, 6, 0, 0, 64, 3, 1, 'В-408', 2, 3),
(39, 1, 8, 6, 64, 0, 0, 4, 1, 'В-408', 2, 1),
(40, 1, 8, 6, 0, 0, 64, 5, 3, 'В-419', 3, 3),
(41, 5, 8, 6, 0, 64, 0, 3, 4, 'В-423 1,5,9,13 н.', 1, 2),
(43, 7, 4, 1, 67, 0, 0, 2, 3, 'ул.Голубятникова  9.00-10.30', 1, 1),
(44, 7, 4, 1, 0, 38, 0, 3, 1, 'В-103', 3, 2),
(45, 7, 4, 1, 0, 0, 71, 3, 1, 'Д-508', 3, 3),
(46, 7, 4, 1, 0, 0, 40, 4, 3, 'В-611', 4, 3),
(49, 7, 4, 2, 15, 0, 0, 2, 1, 'Д-504', 2, 1),
(48, 7, 4, 2, 71, 0, 0, 1, 3, 'Г-408', 1, 1),
(50, 7, 4, 2, 25, 0, 0, 3, 4, 'А-301 1/2гр*  1/2гр**', 3, 1),
(51, 7, 4, 2, 25, 0, 0, 4, 4, 'А-301 1/2гр*  1/2гр**', 4, 1),
(52, 7, 4, 3, 0, 69, 0, 1, 3, 'Д-116', 1, 2),
(53, 7, 4, 3, 0, 25, 0, 2, 3, 'А-303', 2, 2),
(54, 7, 4, 3, 70, 0, 0, 3, 1, 'А-402', 3, 1),
(55, 7, 4, 3, 0, 0, 40, 2, 1, 'В-303', 2, 3),
(56, 7, 4, 3, 38, 0, 0, 4, 3, 'В-611', 4, 1),
(57, 7, 4, 4, 67, 0, 0, 2, 3, 'ул.Голубятникова  9.00-10.30', 1, 1),
(58, 7, 4, 4, 25, 0, 0, 3, 1, 'А-303', 3, 1),
(59, 7, 4, 4, 30, 0, 0, 4, 1, 'В-410', 4, 1),
(60, 7, 4, 5, 0, 0, 70, 1, 4, 'А-408 1/2гр 2,6,10,14 нед 1/2гр 4,8,12,16 нед', 1, 3),
(61, 7, 4, 5, 0, 0, 70, 2, 4, 'А-408 1/2гр 2,6,10,14 нед 1/2гр 4,8,12,16 нед', 2, 3),
(62, 7, 4, 5, 0, 0, 69, 3, 4, 'Д-108 1/2гр  2,6,10,14 нед 1/2гр  4,8,12,16 нед', 3, 3),
(63, 7, 4, 5, 0, 0, 69, 4, 4, 'Д-108 1/2гр  2,6,10,14 нед 1/2гр  4,8,12,16 нед', 4, 3),
(64, 7, 4, 5, 0, 0, 30, 1, 4, 'В-423 1/2гр. 4,8,12,16 нед 1/2гр. 2,6,10,14 нед', 1, 3),
(65, 7, 4, 5, 0, 0, 30, 2, 4, 'В-423 1/2гр. 4,8,12,16 нед 1/2гр. 2,6,10,14 нед', 2, 3),
(66, 7, 4, 6, 15, 0, 0, 1, 3, 'Д-702', 1, 1),
(67, 7, 4, 6, 69, 0, 0, 2, 1, 'Д-417', 2, 1),
(68, 1, 6, 1, 0, NULL, NULL, 0, 0, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `show_slide` bit(1) NOT NULL,
  `img_link` varchar(255) DEFAULT NULL,
  `left_slide` varchar(10) DEFAULT NULL,
  `top_slide` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `tbl_slide`
--

INSERT INTO `tbl_slide` (`id`, `link`, `text`, `show_slide`, `img_link`, `left_slide`, `top_slide`) VALUES
(14, 'http://atpp.in/post/2', 'ООО «КЭР-Инжиниринг» развивает сотрудничество с КГЭУ', '', 'http://atpp.in/uploads/oli_439eea5d5f73ad8fb6f934c7004e689a.JPG', '', ''),
(13, 'http://atpp.in/post/1', 'Автоматизации и амбиции 2011', '', 'http://atpp.in/uploads/oli_b7df8ab3c45912c6d0c010fab87e0cd2.JPG', '', ''),
(15, 'http://atpp.in/post/3', 'Молодежный потенциал кафедры ', '', 'http://atpp.in/uploads/oli_b638d58321922f382bd195430b3fb0ea.JPG', '', ''),
(16, 'http://atpp.in/post/4', 'Добро пожаловать', '', 'http://atpp.in/uploads/6d52a5cc546497febf20f4498445b706.jpg', '', ''),
(17, 'http://atpp.in/post/6', 'Очередной мастер-класс по автоматизации технологических процессов на ', '', 'http://atpp.in/uploads/sm_f58a5ac925dac3c98be07830d044e73e.jpg', '', '100'),
(18, 'http://atpp.in/post/5', 'тест', '', 'http://img-fotki.yandex.net/get/5625/136672174.35/0_STATICac2f8_fc8968fa_L', '', ''),
(19, 'http://atpp.in/project/dampfturbine', 'Интерактивное электронное техническое руководство по ремонту паровой турбины Т-100-130 ТМЗ', '', 'http://atpp.in/i/icon.png', '200', '60'),
(20, 'http://atpp.in/post/18', 'iВолга - 2013', '', 'http://atpp.in/uploads/db41554a193b58ea848f08e4d78943ca.jpg', '100', '-60'),
(21, 'http://atpp.in/post/19', 'инновационный форум «МИЦ-2013»', '', 'http://atpp.in/uploads/256a7cc82dae3c623059874c0b7c43da.jpg', '40', '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_tag`
--

CREATE TABLE `tbl_tag` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `tbl_tag`
--

INSERT INTO `tbl_tag` (`id`, `name`) VALUES
(1, 'новости'),
(2, 'конкурс'),
(3, 'iволга'),
(4, 'обновление сайта'),
(5, 'test'),
(6, '#обновление сайта'),
(7, 'автоматизация'),
(8, 'умный дом'),
(9, 'жкх'),
(10, 'иэтр');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_time_pair`
--

CREATE TABLE `tbl_time_pair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `value` int(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `tbl_time_pair`
--

INSERT INTO `tbl_time_pair` (`id`, `name`, `value`) VALUES
(1, '8:30 - 9:30', 1),
(2, '9:40 - 11:10', 2),
(3, '11:20 - 12:50', 3),
(4, '13:20 - 14:50', 4),
(5, '15:00 - 16:30', 5),
(6, '16:40 - 18:00 ', 6),
(7, '18:10 - 19:40', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_type_pair`
--

CREATE TABLE `tbl_type_pair` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `value` int(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_type_pair`
--

INSERT INTO `tbl_type_pair` (`id`, `name`, `value`) VALUES
(1, 'Лекция', 1),
(2, 'Семинар', 2),
(3, 'Практика', 3),
(4, 'Лабораторная', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_uploadedfiles`
--

CREATE TABLE `tbl_uploadedfiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orig_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ext` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `invisible` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) DEFAULT NULL,
  `username` varchar(128) DEFAULT NULL,
  `profile` text,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `pin` varchar(255) DEFAULT NULL,
  `vk_id` int(255) DEFAULT NULL,
  `banned` int(11) DEFAULT NULL,
  `laste_enter` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=169 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `password`, `username`, `profile`, `active`, `pin`, `vk_id`, `banned`, `laste_enter`) VALUES
(65, '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL, 1, '74c9a19cc8512d6cf34efd7decbcf6e5', NULL, NULL, 1394305833);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_semestr_predmet`
--

CREATE TABLE `tbl_user_semestr_predmet` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `semestr_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `predmet_id` int(255) NOT NULL,
  `rating_id` int(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_wall`
--

CREATE TABLE `tbl_wall` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `profile_id` int(255) NOT NULL,
  `parent_id` int(255) DEFAULT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  `belong_id` int(255) NOT NULL,
  `last_update` int(255) NOT NULL,
  `rating` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_weekday`
--

CREATE TABLE `tbl_weekday` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tbl_weekday`
--

INSERT INTO `tbl_weekday` (`id`, `name`, `tab`) VALUES
(1, 'Понедельник', 'monday'),
(2, 'Вторник', 'tuesday'),
(3, 'Среда', 'wednesday'),
(4, 'Четверг', 'whursday'),
(5, 'Пятница', 'friday'),
(6, 'Суббота', 'saturday');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_week_mask`
--

CREATE TABLE `tbl_week_mask` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `semestr` int(11) NOT NULL,
  `week_num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_week_mask`
--

INSERT INTO `tbl_week_mask` (`id`, `semestr`, `week_num`) VALUES
(1, 1, 41),
(2, 1, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_week_razd`
--

CREATE TABLE `tbl_week_razd` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_week_razd`
--

INSERT INTO `tbl_week_razd` (`id`, `name`) VALUES
(1, 'каждую неделю'),
(2, 'по нечетным ( * )'),
(3, 'по четным ( ** )');
