<?php
/*
 *  Mail : subinpvasu@gmail.com
 *  Skype : subinpvasu 
 *  AdWords API integration
 */
require_once './Processor/Processor.php';
$data = new Processor();
$data->modify_account(Credentials::$ACCOUNT_ID);