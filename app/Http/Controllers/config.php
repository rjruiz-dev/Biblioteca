<?
$tabla				=	"gbwin_";
$bdatos				=	"spainebook_demo";
$bd_Host			=	"localhost";
$bd_User			=	"spainebook_demo";
$bd_Pass			=	"Abundio2020";

/*
$mail_Host 			= 	"bolnet.es";
$mail_SMTPAuth 		= 	true;
$mail_Username 		= 	"info@bolnet.es";
$mail_Password 		= 	"P1zx8q2*";
$mail_SMTPSecure 	= 	"";
$mail_Port 			=    25;
*/




$mail_Host = "smtp.eu.mailgun.org";
$mail_Port = 587;
$mail_SMTPSecure = "tls";
$mail_SMTPAuth = true;
$mail_Username = "postmaster@bolnet.es";
$mail_Password = "d1d91367586909a821fbf80dcacbd465-4167c382-77590c26";


/*
$mail_Host = "smtp.sparkpostmail.com";
$mail_Port = 587;
$mail_SMTPSecure = "tls";
$mail_SMTPAuth = true;
$mail_Username = "SMTP_Injection";
$mail_Password = "980f0853c1d5921813b1991f6aedea4e5ad9ea85";
*/
$tversion="99";

foreach ($_REQUEST as $var=>$value) {
$_REQUEST[$var]= preg_replace('#[<>\"\'\`;]|&3C|%3E|&lt;|&gt;|0x|select|insert|update|delete#', '',$value);
$$var = $_REQUEST[$var];
}