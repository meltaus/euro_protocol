<?php


class workDB
{
    private $conn;

    //Конструктор. Подключаемся к базе
    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT']."/settings/connectionDB.php";

        // подключаемся к серверу
        $this->conn = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка подключения к базе данных" . mysqli_error($this->conn));
        mysqli_query($this->conn,'SET NAMES utf8');
    }

    //Закрываем подключение
    public function __destruct()
    {
        if( $this->conn )
        {
            mysqli_close($this->conn);
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
     * Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует столбцу запрашиваемой таблицы
     * Получение всех столбцов и строк из таблицы
     * @param $tableName Имя таблицы из которой необходимо получить данные
     */
    public function selectAllDataTable($tableName) {
        $query = "SELECT * FROM ".$tableName;
        $result = mysqli_query($this->conn, $query) or die("Ошибка " . mysqli_error($this->conn));
        if($result)
        {
            $result_array = array();
            while($row = mysqli_fetch_row($result))
            {
                $temp_array = array();
                for ($i = 0; $i < count($row); $i++) {
                    array_push($temp_array, $row[$i]);
                }
                array_push($result_array, $temp_array);
            }
        }

        return $result_array;
    }

    /**
     * Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует
     * столбцу переданному в массиве $columnName запрашиваемой таблицы
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     */
    public function selectDataTable($tableName, $columnName) {
        //Если $columnName массив - составляем и выполняем запрос, если нет - возвращаем null
        if (gettype($columnName) == "array") {
            $query = "SELECT ";
            for ($i = 0; $i < count($columnName); $i++) {
                $query .= "$columnName[$i]";
                if ($i == count($columnName) - 1) {
                    $query .= " ";
                } else {
                    $query .= ", ";
                }
            }
            $query .= "FROM ".$tableName;
            $result = mysqli_query($this->conn, $query) or die("Ошибка " . mysqli_error($this->conn));
            if($result)
            {
                $result_array = array();
                while($row = mysqli_fetch_row($result))
                {
                    $temp_array = array();
                    for ($i = 0; $i < count($row); $i++) {
                        array_push($temp_array, $row[$i]);
                    }
                    array_push($result_array, $temp_array);
                }
            }

            return $result_array;
        }

        return null;
    }

    /**
     * Ведет себя так же как selectDataTable, но к запросу добавляет условие, которое содержится в строке $condition
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     * @param $condition Условие, которое записывается после WHERE
     */
    public function selectDataTableWhere($tableName, $columnName, $condition) {
        //Если $columnName массив - составляем и выполняем запрос, если нет - возвращаем null
        if (gettype($columnName) == "array") {
            $query = "SELECT ";
            for ($i = 0; $i < count($columnName); $i++) {
                $query .= "$columnName[$i]";
                if ($i == count($columnName) - 1) {
                    $query .= " ";
                } else {
                    $query .= ", ";
                }
            }
            $query .= "FROM ".$tableName." ".$condition;
            $result = mysqli_query($this->conn, $query) or die("Ошибка " . mysqli_error($this->conn));
            if($result)
            {
                $result_array = array();
                while($row = mysqli_fetch_row($result))
                {
                    $temp_array = array();
                    for ($i = 0; $i < count($row); $i++) {
                        array_push($temp_array, $row[$i]);
                    }
                    array_push($result_array, $temp_array);
                }
            }

            return $result_array;
        }

        return null;
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