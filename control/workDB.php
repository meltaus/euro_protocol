<?php


class workDB
{
    private $conn;

    //Конструктор. Подключаемся к базе
    public function __construct()
    {
        require_once '../settings/connectionDB.php';
        $connectionInfo = array("UID" => $user, "PWD" => $password, "Database"=>$database, "APP"=>$nameApp, "CharacterSet"=>$charset);
        $this->conn = sqlsrv_connect( $host, $connectionInfo);
    }

    //Закрываем подключение
    public function __destruct()
    {
        if( $this->conn )
        {
            sqlsrv_close($this->conn);
        }
    }

    /**
     * Метод вставки данных в таблицу по имени таблицы и массиву ключ-значение. Проверки на соотсветствия типа данных нет.
     * @param $tableName Имя таблицы в которую будет производиться запись
     * @param $columnValues Массив ключ-значение, где ключ имя столбца в которое вносится изменение, а значение то, что
     *                      необходимо внести
     */
    public function insertDataTable($tableName, $columnValues) {

    }

    /**
     * Получение всех столбцов и строк из таблицы
     * @param $tableName Имя таблицы из которой необходимо получить данные
     */
    public function selectAllDataTable($tableName) {

    }

    /**
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     */
    public function selectDataTable($tableName, $columnName) {

    }

    /**
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     * @param $condition Условие, которое записывается после WHERE
     */
    public function selectDataTableWhere($tableName, $columnName, $condition) {

    }

    /**
     * @param $query Произвольны запрос к БД
     */
    public function anyQueryDB ($query) {

    }

    /**
     * Удалить строку из таблицы
     * @param $tableName Имя таблицы из которой необходимо удалить строку
     * @param $nameIDColumn Имя столбца с никальными значениями, по которому можно вычислить строку для удаления
     * @param $id Значения столбца $nameIDColumn
     */
    public function deleteRowDataTable ($tableName, $nameIDColumn, $id) {

    }

    /**
     * Метод вставки данных в таблицу по имени таблицы и массиву ключ-значение. Проверки на соотсветствия типа данных нет.
     * @param $tableName Имя таблицы в которую будет производиться запись
     * @param $columnValues Массив ключ-значение, где ключ имя столбца в которое вносится изменение, а значение то, что
     *                      необходимо внести
     */
    public function updateDataTable($tableName, $columnValue) {

    }
}