<?php
include_once('kadmin/config.php');
include_once('kadmin/startup.php');
include_once('kadmin/Model/Model.php');
include_once('templates/blocks/translation.php');

startup();

$db = Model::Instance();

//$contacts = $db->Row_by_id('sections','4');

