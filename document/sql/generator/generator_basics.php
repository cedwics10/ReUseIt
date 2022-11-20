<?php

include('pdo.php');

$sql = file_get_contents('../reuseit.sql');
$pdo->exec($sql);

// Generate data of members
include('generators/generator_member.php');

// Generate data of forum
include('generators/generator_forum.php');

// Arrays of example data from forums 
// Arrays of example data from subjects
// Arrays of example data from messages
// Arrays of example data from lists
// Arrays of example data from tasks
// Arrays of example data from pmsubjects
// Arrays of example data from pmanswers
// Arrays of example data from pmrecievers
// Arrays of example data from pmnotrecieve
// Arrays of example data from blacklist

// Generate data of forums 
// Generate data of subjects
// Generate data of messages
// Generate data of lists
// Generate data of tasks
// Generate data of pmsubjects
// Generate data of pmanswers
// Generate data of pmrecievers
// Generate data of pmnotrecieve
// Generate data of blacklist
