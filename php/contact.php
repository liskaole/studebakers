<?php

require '../phpmailer/PHPMailerAutoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
if(!$_POST) exit;

// Email address verification, do not edit.
function isPhone($phone) {
    return(preg_match('/^((8|[\+ ]?7)[\- ]?)?(\(?9\d{2}\)?[\- ]?)(\d{3}[\- ]?\d{2}[\- ]?\d{2})/',$phone));
	//return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

$name     = $_POST['name'];
$phone    = $_POST['phone'];
//$comments = $_POST['comments'];

if(trim($name) == '' && trim($name) == 'Имя') {
	echo '<div class="error_message">Введите имя.</div>';
	exit();
} else if(trim($phone) == '') {
	echo '<div class="error_message">Введите корректный номер телефона.</div>';
	exit();
} else if(!isPhone($phone)) {
	echo '<div class="error_message">Введите корректный номер телефона и попробуйте снова.</div>';
	exit();
}
$mail_from = 'studebakers@inbox.ru';
$mail_from_password = 'dayofjoy1';
$mail_to = 'mixanius@gmail.com';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.mail.ru';
$mail->SMTPAuth = true;
$mail->Username = $mail_from;
$mail->Password = $mail_from_password;
$mail->SMTPSecure = 'ssl';
$mail->Port = '465';
$mail->CharSet = 'UTF-8';
$mail->setFrom($mail_from, 'Студия детейлинга');
$mail->addAddress($mail_to,'STUDEBAKERS Заявка на обратный звонок');
$mail->isHTML(true);
$mail->Subject = 'STUDEBAKERS ПОЗВОНИТЕ МНЕ';
$mail->Body = '<body link="white" vlink="gray"><table cellpadding="0" cellspacing="0" border="0">
					  <tr>
						<td width="100%" height="27px" style="opacity: 0.6"></td>
					  </tr>
					  <tr>
						<td width="100%" style="background-color: #F5F5F5; opacity: 0.97"><div style = "padding: 10px 40px">ЗАЯВКА НА ОБРАТНЫЙ ЗВОНОК STUDEBAKERS: </br></br> Мое имя : '.$name.' ; </br> Мой номер: '.$phone.' ; </br></div></td>
					  </tr>
					</table></body>';

if ($mail->Send()) {
    echo "<fieldset>";
    echo "<div id='success_page'>";
    echo "<h3 style='color:green'>Ваш запрос успешно отправлен.</h3>";
    echo "<p style='margin-bottom: 15px;'>Спасибо <strong>$name</strong>, мы перезвоним вам в ближайшее время.</p>";
    echo "</div>";
    echo "</fieldset>";
}
else {
    echo "<fieldset>";
    echo "<div>";
    echo "<h3>Не удалось отправить запрос :( </h3>
          <p>Вы можете связаться с нами по намерам:</p>
          <p>+79290079990 | ЕВГЕНИЙ </p>
          <p style='margin-bottom: 15px;'>+79038594447 | МИХАИЛ </p>";
    echo "</div>";
    echo "</fieldset>";
}