<?php
// Arrays of example data from pm
const nb_of_subjects = 400;

const titres = [
    'Faire des pâtes', 'Devenir développeur',
    'Devenir riche avec la coupe du monde', 'Regarder des streamings',
    'Procrastriner', 'Arrêter de procrastiner', 'Faire de la couture',
    'Regarder la TV', 'Manger des nouilles', 'Refaire du taekwendo',
    'Défier le champion du monde de escrime', 'Sauter en parachute'
];




function generate_pmanswers($data)
{
    $pma_id = [];
    $$pma_id_subject = [];
    $$pma_id_sender = [];
    $$pma_message = [];
    $pma_time = [];	

    $sql = '';
    
    # EDIT
    $i = 0;
    while($i < nb_of_subjects)
    {
        shuffle(titres);

        $pma_id[] = 'NULL';
        $pma_id_subject[] = $data['id_subject'];
        shuffle($data['member_list']);
        $pma_id_sender[] = $data['member_list'][0];
        $pma_message[] = titres[array_rand(titres)];
        $pma_time[] = ;	
        $i++;
    }

    $sql = 'INSERT INTO pmsubjects VALUES ';
    $i = 0;
    $dataset = [];
    while($i < nb_of_subjects)
    {
        $dataset[] = "({$pms_id[$i]}, {$pms_id_author[$i]},
        ". ($pdo->quote($pms_name[$i])) .",{$pms_task[$i]},
        {$pms_status[$i]}, '{$pms_ip[$i]}')";
        $i++;
    }
    $sql = $sql . ' ' . implode(',' . PHP_EOL , $dataset);
    return $sql;
}
?>