<?
//Создание типа почтового события для уведомления о добавлении в группу

$obEventType = new CEventType;
$obEventType->Add(array(
	"EVENT_NAME"    => "USER_NEW_GROUP",
	"NAME"          => "Новый пользователь в группе",
	"LID"           => "ru",
	"DESCRIPTION"   => "
		#USER_INFO# - Информация о пользователе
		#GROUP_ID# - ID группы
		#EMAIL_USERS_GROUP# - Email текущих пользователей группы
		"
	));


$fields["ACTIVE"] = "Y";
$fields["EVENT_NAME"] = "USER_NEW_GROUP";
$fields["LID"] = array("s1");
$fields["EMAIL_FROM"] = "#DEFAULT_EMAIL_FROM#";
$fields["EMAIL_TO"] = "#EMAIL_USERS_GROUP#";
$fields["BCC"] = "";
$fields["SUBJECT"] = "Добавлен новый пользователь в группу #GROUP_ID#";
$fields["BODY_TYPE"] = "text";
$fields["MESSAGE"] = "
В группу с id - #GROUP_ID# добавлен новый пользователь #USER_INFO#.
";
$obTemplate = new CEventMessage;
$obTemplate->Add($fields);
?>
