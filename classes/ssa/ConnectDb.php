<?php
/** Класс подключения к бд */
class ConnectDB
{
    static function connect()
    {
        /** Подключаемся к базе данных */
        $DBConnection = new DBConnection($GLOBALS["DATABASES"], "MySql");
        $connectionObject = $DBConnection->Connect();
        return $connectionObject;
    }
}
