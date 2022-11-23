<?php
include('pdo.php');
function make_sql_insert_query()
{
    global $pdo;
    
    $all_args = func_get_args();
    $number_of_args = func_num_args();
    $number_of_entries = count($all_args[1]);

    if($number_of_args == 0)
        return false;
    
    $table_name = $all_args[0];

    $sql = "INSERT INTO $all_args[0]  VALUES ";
    $entries = [];

    for($entry = 0;$entry<$number_of_entries;$entry++)
    {
        $data_row_i = [];
        for($field = 1;$field<$number_of_args;$field++)
        {
            $row_data = '(';
            
            $data_row_i[] = $all_args[$field][$entry];
        }

        $row_data .= implode(',', $data_row_i) . ')';
        $entries[] = $row_data;
    }
    $sql .= implode(',', $entries) . ';';
    $pdo->exec($sql);
}
?>