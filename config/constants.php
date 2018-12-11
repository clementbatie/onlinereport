<?php

//file : app/config/constants.php
//this was entirely defined by NNA on 13-feb-2016
//to be used as : echo Config::get('constants.MEMOS'); //that will return 1.
//'MINISTRIES'=>'1',
//MINISTRIES is hard coded in db as 1 see userlevels table
//RECORDS_OFFIC is hard coded as 2
return [
	'PAGINATIONSIZE' =>'4',
	'MEMOS'=>'1',
	'FORWARDING_LETTERS'=>'2',
	'DECISION_LETTERS'=>'3',
	'AGENDAS'=>'4',
	'APPROVAL_MEMOS'=>'5',
	'APPROVALDECISION_LETTERS'=>'6',
	'COMMITTEE_REPORTS'=>'7',
	'MINUTES'=>'8',
	'ATTACHMENTS'=>'9',
	
	'RECORDS_OFFICE'=>'2'

];

//i just took out ministries constant. there are many ministries. Not sure where else used. Will fix it if breaks.