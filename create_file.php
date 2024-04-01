<?php

$file = "C:/OSPanel/domains/test/test.txt"; // создаём файл для записи
$file_handle = fopen($file, 'w');

if ($file_handle) { // проверка на возможность открытия файла

    if (!empty($departmentData)) {  // записываем информацию в файл об отделениях
        fwrite($file_handle, "Информация об отделениях:\n");
        foreach ($departmentData as $index => $row) {
            fwrite($file_handle, $index+1 . ".");
            fwrite($file_handle, " id: " . $row['id'] . "\n");
            fwrite($file_handle, "   parent_Id: " . $row['parent_id'] . "\n");
            fwrite($file_handle, "   name: " . $row['name'] . "\n");
            fwrite($file_handle, "\n");
        }
    }

    if (!empty($usersData)) { // записываем информацию в файл о сотрудниках
        fwrite($file_handle, "Информация о сотрудниках:\n");
        foreach ($usersData as $index => $row) {
            fwrite($file_handle, $index+1 . ".");
            foreach ($row as $column_name => $value) {
                if ($column_name != 'id' && $column_name != 'user_id') {
                    fwrite($file_handle, "   " . $column_name . ": " .$value . "\n");
                }
            }
            fwrite($file_handle, "\n");
        }
    }

    echo '<br>' . "Данные успешно записаны в файл. " .  "<a href='test.txt' download>Скачать файл</a>";
} else {
    echo '<br>' ."Ошибка записи данных в файл.";
}

fclose($file_handle); // закрываем файл после записи данных