<?

//Подключаем файл с константами
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/constants.php'))
{
    include_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/constants.php');
}

//Подключаем файл с обработчиками событий
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/events.php'))
{
    include_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/include/events.php');
}
