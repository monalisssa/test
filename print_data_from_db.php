<?php

$link = new mysqli('localhost', 'root', "000000", "workers"); // соединение с базой данных

if ($link->connect_error) {
    die("Ошибка соединения с базой данных: " . $link->connect_error);
}

$department = $link->query("SELECT * FROM department"); // получаем данные из таблицы с отделениями

$departmentData = array(); // объявляем массив данных с отделениями

while ($row = $department->fetch_assoc()) {
    $departmentData[] = $row; // добавляем строку данных в массив
}

$query = "SELECT users.*, users_info.*  
          FROM users
          INNER JOIN users_info ON users.xml_id = users_info.user_id
          ORDER BY users.xml_id";

$users = $link->query($query);

$usersData = array(); // объявляем массив данных о сотрудниках

while ($row = $users->fetch_assoc()) {
    $usersData[] = $row; // добавляем строку данных в массив
}

header("Content-Type: text/html; charset=utf-8");

if (!empty($departmentData)) {
    echo '<h4> Все данные об отделениях из базы данных. </h4>';
    echo '<table cellpadding="1" border="1" class="data_table">';
    echo '<tr align="center">';
    echo '<th>id</th>';
    echo '<th>parent_Id</th>';
    echo '<th>name</th>';
    echo '</tr>';

    foreach ($departmentData as $row) {
        echo '<tr align="left">';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['parent_id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "Нет данных об отделениях";
}

if (!empty($usersData)) {
    echo '<h4> Все данные о сотрудниках из базы данных. </h4>';
    echo '<table cellpadding="1" border="1" class="data_table">';
    echo '<tr align="left">';
    $firstRow = reset($usersData); // получаем первую строку данных для получения полей
    foreach ($firstRow as $column_name => $value) {
        if ($column_name != 'id' && $column_name != 'user_id') {
            echo '<th>' . $column_name . '</th>';
        }
    }
    echo '</tr>';

    foreach ($usersData as $row) { // выводим все данные о сотрудниках
        echo '<tr align="left">';
        foreach ($row as $column_name => $value) {
            if ($column_name != 'id' && $column_name != 'user_id') {
                echo '<td>' . $value . '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "Нет данных о сотрудниках";
}