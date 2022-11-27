<?php
const ONE_OUR = 60 * 60;

$pmr_id_pmsubject = [];
$pmr_id_answer = [];
$pmr_id_reciever = [];
$pmr_date_recieved = [];
$pmr_date_read = [];

for($answer_no = 0; $answer_no < nb_of_message;$answer_no++)
{
    $number_subject = floor($answer_no / 8);
    foreach($member_lists_subjects[$number_subject] as $id_reciever)
    {
        $pmr_id_pmsubject[] = $number_subject;
        $$pmr_id_answer[] = $answer_no;
        $pmr_id_reciever[] = $id_reciever;
        $pmr_date_recieved[] = $pma_date_first_answer[$answer_no];
        $pmr_date_read[] = $pma_date_first_answer[$answer_no] + ONE_OUR;
    }

    break;
}

?>