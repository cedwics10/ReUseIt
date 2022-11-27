<?php
const NB_IGNORE = 50;
$nb_recieved = count($pmr_id_pmsubject);

$pmn_id_pmsubject = [];
$pmn_id_member = [];
$pmn_date_stop = [];

for($ign = 1;$ign <= NB_IGNORE;$ign++)
{
    $nb_ign = mt_rand(0,$nb_recieved-1);
    $pmn_id_pmsubject[] = $pmr_id_pmsubject[$nb_ign];
    $pmn_id_member[] = $pmr_id_reciever[$nb_ign];

    $random_day = mt_rand(1, 31);
    $random_month = mt_rand(1, 12);
    $random_year = mt_rand(2010, 2022);

    $pmn_date_stop[] = mktime(0,0,0, $random_month,$random_day, $random_year);
}


$sql = 'INSERT INTO pmnotrecieve VALUES ';
$dataset = [];

$no_ignore = 0;
while($no_ignore < NB_IGNORE) {
    $dataset[] = "('NULL',
    $pmn_id_pmsubject[$no_ignore],
    $pmn_id_member[$no_ignore],
    $pmn_date_stop[$no_ignore])";
    $no_ignore++;
}

$sql .= implode(',', $dataset);
$pdo->query($sql);

?>