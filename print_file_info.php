<?php

    echo '<h4> Информация о загруженных файлах. </h4>';  //выводим таблицу с информацией о загруженных файлах
    echo '<table border="1" class="file_table">';

    echo '<tr align="center">';
    echo '<th>name</th>';
    echo '<th>type</th>';
    echo '<th>size</th>';
    echo '<th>tmp_name</th>';
    echo '</tr>';

    echo '<tr align="left">';
    echo '<td>' . $file_1['name'] . '</td>';
    echo '<td>' . $file_1['type'] . '</td>';
    echo '<td>' . $file_1['size'] . '</td>';
    echo '<td>' . $file_1['tmp_name'] . '</td>';
    echo '</tr>';

    echo '<tr align="left">';
    echo '<td>' . $file_2['name'] . '</td>';
    echo '<td>' . $file_2['type'] . '</td>';
    echo '<td>' . $file_2['size'] . '</td>';
    echo '<td>' . $file_2['tmp_name'] . '</td>';
    echo '</tr>';

    echo '</table>';






