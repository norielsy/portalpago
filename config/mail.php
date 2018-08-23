<?php
/*
return [
	'driver' => 'smtp',
	'host' => 'smtp.gmail.com',
	'port' => 587,
	'from' => ['address' => 'atencion@portaldepagos.cl', 'name' => 'atencion@portaldepagos.cl'],
	//'encryption' => 'ssl',
	'encryption' => 'tls',
	'username' => 'atencion@portaldepagos.cl',
	'password' => 'ppufrj08',
	//'sendmail' => '\"C:\xampp\sendmail\sendmail.exe\" -t',
	//'sendmail' => '/usr/sbin/sendmail -bs',
	'pretend' => false,
];
*/

return [
	'driver' => 'smtp',
	'host' => 'smtp.gmail.com',
	'port' => 465,
	'from' => ['address' => 'atencion@portaldepagos.cl', 'name' => 'atencion@portaldepagos.cl'],
	'encryption' => 'ssl',
	'username' => 'atencion@portaldepagos.cl',
	'password' => 'Ppufrj1601!',
	//'sendmail' => '\"C:\xampp\sendmail\sendmail.exe\" -t',
	'sendmail' => '/usr/sbin/sendmail -bs',
];