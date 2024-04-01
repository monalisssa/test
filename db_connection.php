<?php

$link = new mysqli('localhost', 'root', "000000", "workers");  // соединение с базой данных
if ($link->connect_error) { // проверка установления соединения
    die('Connection failed: ' . $link->connect_error);
}

$sqlScript = file_get_contents('workers.sql'); // чтение SQL-скрипта из файла

if (!mysqli_select_db($link, 'workers')) {
    if(!mysqli_multi_query($link, $sqlScript))
    echo "Ошибка создания базы данных. " . mysqli_error($link);  // выполнение SQL-скрипта генерирования базы данных
}

$file_department = fopen($targetFilePath_1, 'r');  // открываем загруженный файл с отделами
fgetcsv($file_department); // пропускаем строку с заголовками

$success = true; // флаг успешного добавления данных

while (!feof($file_department)) {
    $mass = fgetcsv($file_department, 1024, ";");   // получаем одну строку данных

    $sql = "INSERT INTO department (id, parent_id, name) VALUES ('$mass[0]', '$mass[1]','$mass[2]')";  // формируем sql-запрос

    if ($link->query($sql) !== TRUE) {
        echo "<br>". "Ошибка при добавлении данных! Возможно некорректный формат файла с информацией об отделениях." . '<br>';
        $success = false;
        break;
    }
}

if ($success) {
    echo "Все данные об отделениях успешно добавлены в базу данных!" . '<br>';
}

$file_users = fopen($targetFilePath_2, 'r'); // открываем загруженный файл с сотрудниками
fgetcsv($file_users); // пропускаем строку с заголовками

while (!feof($file_users)) {
    $mass = fgetcsv($file_users, 1024, ";");

    if(!empty($mass)) {
        $sql_1 = "INSERT INTO users (xml_id, last_name, name, second_name, department, work_position) VALUES ('$mass[0]', '$mass[1]','$mass[2]','$mass[3]','$mass[4]', '$mass[5]')";
        $sql_2 = "INSERT INTO users_info (email, mobile_phone, phone, login, password, user_id) VALUES ('$mass[6]', '$mass[7]','$mass[8]','$mass[9]','$mass[10]', '$mass[0]')";

        $result_1 = $link->query($sql_1);
        $result_2 = $link->query($sql_2);

        if ($result_1 !== TRUE && $result_2 !== TRUE) {
            echo "<br>" . "Ошибка при добавлении данных! Возможно некорректный формат файла с информацией о сотрудниках.";
            $success = false;
            break;
        }
    }
}
if ($success) {
    echo "Все данные о сотрудниках успешно добавлены в базу данных!";
}

$link->close();  // закрываем соединение с базой данных