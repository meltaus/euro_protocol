<?php
class workDB
{
    private $conn;

    //Конструктор. Подключаемся к базе
    public function __construct()
    {
        $host = 'localhost'; // адрес сервера
        $database = 'euro_protocol'; // имя базы данных
        $user = 'root'; // имя пользователя
        $password = 'Y@lt;lf99'; // пароль
        $nameApp = ""; //Имя приложения
        $charset = "UTF-8";           //Кодировка
        // подключаемся к серверу
        $this->conn = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка подключения к базе данных" . mysqli_error($this->conn));
        if (!mysqli_query($this->conn, "use euro_protocol")) {
            $fd = fopen("use.txt", 'w') or die("не удалось создать файл");
            fwrite($fd, mysqli_error($this->conn));
            fclose($fd);
        }
        mysqli_query($this->conn, "SET NAMES utf8") or die("Ошибка " . mysqli_error($this->conn));
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
        $query = "INSERT INTO ".$tableName." ";
        $columnArray = array();
        $valuesArray = array();
        foreach ($columnValues as $key => $value) {
            array_push($columnArray, $key);
            array_push($valuesArray, $value);
        }
        $iter = count($columnArray);
        $column = "(";
        $values = "(";
        for ($i = 0; $i < $iter; $i++) {
            if ($i == $iter - 1) {
                $column .= $columnArray[$i].")";
                $values .= "'".$valuesArray[$i]."')";
            } else {
                $column .= $columnArray[$i].", ";
                $values .= "'".$valuesArray[$i]."', ";
            }
        }
        $query .= $column." values ".$values;
        $this->anyQueryDB($query);
    }

    /**
     * Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует столбцу запрашиваемой таблицы
     * Получение всех столбцов и строк из таблицы
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @return array Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует столбцу запрашиваемой таблицы
     */
    public function selectAllDataTable($tableName) {
        $query = "SELECT * FROM ".$tableName;

        return $this->analysisResult($this->anyQueryDB($query));
    }

    /**
     * Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует
     * столбцу переданному в массиве $columnName запрашиваемой таблицы
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     * @return array Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует столбцу запрашиваемой таблицы
     */
    public function selectDataTable($tableName, $columnName) {
        //Если $columnName массив - составляем и выполняем запрос, если нет - возвращаем null
        if (gettype($columnName) == "array") {
            $query = "SELECT ";
            $iter = count($columnName);
            for ($i = 0; $i < $iter; $i++) {
                $query .= "$columnName[$i]";
                if ($i == $iter - 1) {
                    $query .= " ";
                } else {
                    $query .= ", ";
                }
            }
            $query .= "FROM ".$tableName;
            return $this->analysisResult($this->anyQueryDB($query));
        }

        return null;
    }

    /**
     * Возвращает двумерный массив уникльных начений таблицы по заданному столбцу,
     * где array[$i] является массивом, в котором каждый элемент соответствует
     * столбцу переданному в массиве $columnName запрашиваемой таблицы
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     * @return array Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует столбцу запрашиваемой таблицы
     */
    public function selectUniqueDataTable($tableName, $columnName) {
        //Если $columnName массив - составляем и выполняем запрос, если нет - возвращаем null
        if (gettype($columnName) == "array") {
            $query = "SELECT DISTINCT ";
            $iter = count($columnName);
            for ($i = 0; $i < $iter; $i++) {
                $query .= "$columnName[$i]";
                if ($i == $iter - 1) {
                    $query .= " ";
                } else {
                    $query .= ", ";
                }
            }
            $query .= "FROM ".$tableName;
            return $this->analysisResult($this->anyQueryDB($query));
        }

        return null;
    }

    /**
     * Ведет себя так же как selectDataTable, но к запросу добавляет условие, которое содержится в строке $condition
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     * @param $condition Условие, которое записывается после WHERE
     * @return array Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует столбцу запрашиваемой таблицы
     */
    public function selectDataTableWhere($tableName, $columnName, $condition) {
        //Если $columnName массив - составляем и выполняем запрос, если нет - возвращаем null
        if (gettype($columnName) == "array") {
            $query = "SELECT ";
            $iter = count($columnName);
            for ($i = 0; $i < $iter; $i++) {
                $query .= "$columnName[$i]";
                if ($i == $iter - 1) {
                    $query .= " ";
                } else {
                    $query .= ", ";
                }
            }
            $query .= "FROM ".$tableName." ".$condition;
            return $this->analysisResult($this->anyQueryDB($query));
        }

        return null;
    }
	
	 /**
     * Ведет себя так же как selectDataTable, но к запросу добавляет условие, которое содержится в строке $condition
     * @param $tableName Имя таблицы из которой необходимо получить данные
     * @param $columnName Массив строк, содержащий столбцы, которые необходимо получить
     * @param $condition Условие, которое записывается после WHERE
     * @return array Возвращает двумерный массив, где array[$i] является массивом, в котором каждый элемент соответствует столбцу запрашиваемой таблицы
     */
    public function selectDataTableOrderBy($tableName, $columnName, $condition) {
        //Если $columnName массив - составляем и выполняем запрос, если нет - возвращаем null
        if (gettype($columnName) == "array") {
            $query = "SELECT ";
            $iter = count($columnName);
            for ($i = 0; $i < $iter; $i++) {
                $query .= "$columnName[$i]";
                if ($i == $iter - 1) {
                    $query .= " ";
                } else {
                    $query .= ", ";
                }
            }
            $query .= "FROM ".$tableName." ORDER BY ".$condition;
            return $this->analysisResult($this->anyQueryDB($query));
        }

        return null;
    }

    /**
     * Отправляет к БД произвольный запрос. Возвращает ответ от БД
     * @param $query Произвольны запрос к БД
     * @return bool|mysqli_result ответ от БД
     */
    public function anyQueryDB ($query) {
        $result = mysqli_query($this->conn, $query) or die("Ошибка " . mysqli_error($this->conn));
        return $result;
    }

    /**
     * Удалить строку из таблицы
     * @param $tableName Имя таблицы из которой необходимо удалить строку
     * @param $nameIDColumn Имя столбца с никальными значениями, по которому можно вычислить строку для удаления
     * @param $id Значения столбца $nameIDColumn
     */
    public function deleteRowDataTable ($tableName, $nameIDColumn, $id) {
        if (($tableName) && ($nameIDColumn) && (id)) {
            $columnName = array("id");
            $condition = "WHERE " . $nameIDColumn . " = '" . $id . "'";
            $result = $this->selectDataTableWhere($tableName, $columnName, $condition);
            $query = "DELETE FROM ".$tableName." WHERE id = ".$result[0][0];
            $this->anyQueryDB($query);
        }
    }

    /**
     * Метод вставки данных в таблицу по имени таблицы и массиву ключ-значение. Проверки на соотсветствия типа данных нет.
     * @param $tableName Имя таблицы в которую будет производиться запись
     * @param $columnValues Массив ключ-значение, где ключ имя столбца в которое вносится изменение, а значение то, что
     *                      необходимо внести
     * @param $nameIDColumn Имя столбца с никальными значениями, по которому можно вычислить строку для удаления
     * @param $id Значения столбца $nameIDColumn
     */
    public function updateDataTable($tableName, $columnValues, $nameIDColumn, $id) {
        $query = "UPDATE ".$tableName." SET";
        foreach ($columnValues as $key => $value) {
            $query .= " ".$key." = ".$value.",";
        }
        $query = substr($query,0,-1);
        $query .= " WHERE ".$nameIDColumn. " = ".$id;

        $result = $this->anyQueryDB($query);
    }

    /**
     * Разбор ответа из БД
     * @param $result ответ из БД
     * @return array Двумерный массив строка\колонка
     */
    public function analysisResult($result) {
        if($result)
        {
            $result_array = array();
            while($row = mysqli_fetch_row($result))
            {
                $temp_array = array();
                $iter = count($row);
                for ($i = 0; $i < $iter; $i++) {
                    array_push($temp_array, $row[$i]);
                }
                array_push($result_array, $temp_array);
            }
        }
        return $result_array;
    }
	
}