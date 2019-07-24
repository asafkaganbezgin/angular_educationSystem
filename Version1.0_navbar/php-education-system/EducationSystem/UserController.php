<?php
require_once 'User.php';

$newUser = new User("emre","karataşoğlu","emrek@emrek.com");

$newUser->getUserInfoToString();
?>