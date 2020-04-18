<?php
    // créditos: Leonardo Amaro
   
    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
		
    require "..\..\_includes\PHPMailer\src\PHPMailer.php";
	require "..\..\_includes\PHPMailer\src\SMTP.php";
	require "..\..\_includes\PHPMailer\src\Exception.php";
		
    // INCLUIR DB CONNECT
    require_once '../../_mysql/conn.php';

    // INICIANDO SESSÃO
    session_start();
	
    // SISTEMA DE CADASTRO
    if(isset($_GET["validar"])) {
		// RECEBE O CODE ENVIADO PELO USUARIO
		$id = mysqli_escape_string($conn, $_GET['id']);
        $code = mysqli_escape_string($conn, $_GET['code']);
		
		// VERIFICA SE A VARIAVEL CODE ESTÁ VAZIA
        if(empty($id) or empty($code) or $id != $_SESSION['login']) {
            $_SESSION['error'] = 'Campos de texto vazio ou sessão incorreta, verifique e tente novamente.';
			header('location: ../../');
        }
        else {
			$sql = "SELECT * FROM user WHERE id = '$id'";
			if ($result = $conn->query($sql)) {
				$row = $result->fetch_assoc();
				if ($code == $row['code']) {
					$sql = "UPDATE user SET verificada = '1' WHERE id = '$id'";
		            if($conn->query($sql)){
		    	        $_SESSION['success'] = 'Conta validada com sucesso';
						header('location: ../../');
					}
				}
		    }
		    else{
			    $_SESSION['error'] = 'Erro ao criar a conta, comunique um administrador '; //.$conn->error DESCOMENTE PARA MAIS INFORMAÇÕES SOBRE O ERRO
			}
        }
	}
	else if (isset($_POST["code"])) {
		//ID DO MEMBRO
		$id = $_SESSION['login'];
		
		// GERANDO CÓDIGO
		$code = rand(10000, 99999);
		
		// ENCRYTANDO CÓDIGO
		$code = password_hash($code, PASSWORD_DEFAULT);
		
		// ENVIANDO CÓDIGO PARA O SERVIDOR
		$sqlCode = "UPDATE user SET code = '$code' WHERE id = '$id'";
		$conn->query($sqlCode);
		
     	// ENVIADO EMAIL - CRÉDITOS DEV MÉDIA - PHP MAILER
		$mail = new PHPMailer(true);

        // VARIAVEIS A SER ANEXADO NA MENSAGEM
	    $sql = "SELECT * FROM user WHERE id = '$id'";
		if ($result = $conn->query($sql)) {
			$row = $result->fetch_assoc();
			$username = $row['nome'] . " " . $row['sobrenome'] ;
		    $email = $row['email'];
		}
		
		// LINK PARA LIBERAÇÃO 
		$href = $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"] . "/?validar=true&id=$id&code=$code";
		
		try {
   		 	//Server settings
    		$mail = new PHPMailer();
			$mail->CharSet = 'UTF-8';
    		$mail->isSMTP();
    		$mail->Host = 'smtp.gmail.com';
    		$mail->SMTPAuth = true;
    		$mail->SMTPSecure = 'tls';
    		$mail->Username = 'la95112@gmail.com';
    		$mail->Password = 'leozika002556677';
    		$mail->Port = 587;

    		//Recipients
    		$mail->setFrom('la95112@gmail.com', 'ClickSpeedy');
    		$mail->addAddress($email);     // Add a recipient	

    		// Content
    		$mail->isHTML(true);                                  // Set email format to HTML
    		$mail->Subject = 'Ative sua conta no site CLICKSPEEDY'; //TITULO
			
			
			// MENSAGEM QUE VAI SER ENVIADA
			$msg = "<div> <div style='overflow:hidden;color:transparent;width:0;font-size:0;opacity:0;height:0'> Veja os resultados do termo de pesquisa â€˜Auxiliar Administrativoâ€™ &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;<wbr>&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; </div> <table role='presentation' align='center' border='0' cellspacing='0' cellpadding='0' width='100%' bgcolor='#EDF0F3' style='background-color:#edf0f3;table-layout:fixed'> <tbody> <tr> <td align='center'> <center style='width:100%'> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='512' bgcolor='#FFFFFF' style='background-color:#ffffff;margin:0 auto;max-width:512px;width:inherit'> <tbody> <tr> <td bgcolor='#F6F8FA' style='background-color:#f6f8fa;padding:5px 16px 13px;border-bottom:1px solid #ececec'> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%' style='width:100%!important;min-width:100%!important'> <tbody> <tr> <td align='left' valign='middle'><a style='color:#0073b1;display:inline-block;text-decoration:none' target='_blank'> <img alt='ClickSpeedy' border='0' src='https://livedemo00.template-help.com/intense/classic/child/landing-business/images/logo-default-151x49.png' height='42' style='outline:none;color:#ffffff;text-decoration:none' class='CToWUd'></a></td> <td valign='middle' width='100%' align='right'><a href='' style='margin:0;color:#0073b1;display:inline-block;text-decoration:none' target='_blank'> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody>  </tbody> </table></a></td> <td width='1'>&nbsp;</td> </tr> </tbody> </table></td> </tr> <tr> <td> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody> <tr> <td> <table role='presentation' bgcolor='white' border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody> <tr> <td> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%' style='margin:0 auto;table-layout:fixed;width:100%'> <tbody> <tr> <td bgcolor='#0073B1' width='100%' align='center' style='background-color:#0073b1;padding:24px;width:100%;text-align:center'> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody> <tr> <td align='center' style='text-align:center'> <h2 style='margin:0;color:#ffffff;font-weight:700;font-size:16px;line-height:1.5'>Olá, $username</h2></td> </tr> <tr> <td align='center' style='padding-top:24px;padding-bottom:12px;text-align:center'> <h2 style='margin:0;color:#ffffff;font-weight:200;font-size:24px;line-height:1.167'>Ative sua conta na ClickSpeedy agora mesmo !</h2></td> </tr> <tr> <td align='center' style='text-align:center'><p style='margin:0;color:#ffffff;word-break:break-word;font-weight:700;font-size:14px'></p></td> </tr> </tbody> </table></td> </tr> </tbody> </table></td> </tr> <tr> <td> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody> <tr> <td> <table cellspacing='0' cellpadding='0' width='100%' align='center' style='padding:24px;margin:0 auto;table-layout:fixed;width:100%;text-align:center'> <tbody> <tr> <td align='center' style='text-align:center'> <h2 style='margin:0;color:#262626;font-weight:200;font-size:18px;line-height:1.333'>clickando no botão abaixo você será redirecionado para um link, onde será validada sua conta.</h2></td> </tr> </tbody> </table></td> </tr>  </tbody> </table></td> </tr> <tr> <td align='center' style='padding:24px;border-bottom:1px solid #d9d9d9;text-align:center'> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody> <tr> <td align='center'><a href='$href' style='font-weight:500;display:inline-block;text-decoration:none;font-size:16px;background: none repeat scroll 0 0 #0073b1;border: medium none;color: #fff;padding: 11px 20px;text-transform: uppercase;' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://www.linkedin.com/comm/jobs/search?geoId%3D107087645%26savedSearchId%3D627289263%26f_TPR%3Da1585510126-%26midToken%3DAQEmI8857-Un5A%26trk%3Deml-email_job_alert_single_02-jymbii-6-title_jserp%26trkEmail%3Deml-email_job_alert_single_02-jymbii-6-title_jserp-null-d63ldt%257Ek8ev8efn%257Ea4-null-jobs%257Ejserp%257Esearch%26lipi%3Durn%253Ali%253Apage%253Aemail_email_job_alert_single_02%253BWYFSlHLZRwa5fQy4PSTQOw%253D%253D&amp;source=gmail&amp;ust=1585847497580000&amp;usg=AFQjCNHMjYYRaVuQoSBF-9lJbpXkuzkYxg'>Ativar conta</a></td> </tr> <tr> <td align='center' style='padding-top:24px'><a href='https://www.linkedin.com/e/v2?e=d63ldt-k8ev8efn-a4&amp;lipi=urn%3Ali%3Apage%3Aemail_email_job_alert_single_02%3BWYFSlHLZRwa5fQy4PSTQOw%3D%3D&amp;a=jobs-jserp-search-mirror&amp;midToken=AQEmI8857-Un5A&amp;ek=email_job_alert_single_02&amp;li=1&amp;m=footer&amp;ts=manage_alert&amp;alertAction=manage&amp;savedSearchId=627289263' style='color:#555555;font-weight:500;display:inline-block;text-decoration:none;font-size:16px' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://www.linkedin.com/e/v2?e%3Dd63ldt-k8ev8efn-a4%26lipi%3Durn%253Ali%253Apage%253Aemail_email_job_alert_single_02%253BWYFSlHLZRwa5fQy4PSTQOw%253D%253D%26a%3Djobs-jserp-search-mirror%26midToken%3DAQEmI8857-Un5A%26ek%3Demail_job_alert_single_02%26li%3D1%26m%3Dfooter%26ts%3Dmanage_alert%26alertAction%3Dmanage%26savedSearchId%3D627289263&amp;source=gmail&amp;ust=1585847497580000&amp;usg=AFQjCNExrCRfi6VFHyIudPFVaQ2pFuPwuQ'>Caso tenha recebido por engano, favor ignorar esse email.</a></td> </tr> </tbody> </table></td> </tr> <tr> <td> <table role='presentation' border='0' cellspacing='0' cellpadding='0' width='100%'> <tbody> <tr> <td align='center' style='line-height:4px;height:4px;text-align:center'><img src='https://ci6.googleusercontent.com/proxy/KrXvCRk9kG6nQV8PSC-WjQQ8GyegkKTAdU-lc526ifJhdBGBKt7z8yzfxT7ZXoHNWFmvHnQQbeKP8p4v5bO5tkubqoXICDFHYekskAzLwZuCLzLWQP8Fdp_1cZfO12YuMMvsH_Z8kZ9DbDpw1ctok0GvWdweA3CM5jLGR_Yi2ZPEZST49LZQJIEmVyQsDe-XzZUd2IwAQDuzBHnVV1PTaDHpC3YarSND4hCsEzyoF2nL3zFwOamYUcbliAAFaw4Za58BzsNus7jLA7qA-D6F2ZtPyRj1Lc5uT8ZTI-TO3RepEVfIISCGyX9MFmyoWgEHTQ=s0-d-e1-ft#https://static.licdn.com/sc/p/com.linkedin.email-assets-frontend%3Aemail-assets-frontend-static-content%2B__latest__/f/%2Femail-assets-frontend%2Fimages%2Femail%2Fsubs%2Fpremium%2Ftexture_premium_gold_border_1024x4_v1.png' width='100%' border='0' alt='' style='outline:none;color:#ffffff;text-decoration:none;vertical-align:top;height:4px' class='CToWUd'></td> </tr>  <tr> <td> <table border='0' cellspacing='0' cellpadding='0' style='font-family:Helvetica,Arial,sans-serif' width='100%'> <tbody> <tr>   </tr> </tbody> </table></td> </tr> </tbody> </table></td> </tr> </tbody> </table></td> </tr> </tbody> </table></td> </tr>  </tbody> </table> </center></td> </tr> </tbody> </table> <img alt='' role='presentation' src='https://ci3.googleusercontent.com/proxy/zUV2-a9WHtZpmJLZQJqZHzJiiETEvtRB-D64OnuGcFOGI3cxilzqs_Uz8AC0sqo7CtDRh8GZawA9LUE4_99ffkxCYn1OYqVMMtMBms_d4xGY_YT6hVT1RvCbNngX08oITboQsSxlF-p7tAWyea3ixvzfiI2KIOTtto3_OozdMKDXYFXHdRpKfgB7hXG8=s0-d-e1-ft#https://www.linkedin.com/emimp/ip_WkRZemJHUjBMV3M0WlhZNFpXWnVMV0UwOlpXMWhhV3hmYW05aVgyRnNaWEowWDNOcGJtZHNaVjh3TWc9PTo=.gif' style='outline:none;color:#ffffff;text-decoration:none;width:1px;height:1px' class='CToWUd'><div></div><div> </div></div>";
    		$mail->Body    = $msg;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    		$mail->send();
    		$_SESSION['success'] = 'Email enviado com sucesso';
		} 
		catch (Exception $e) {
			$_SESSION['error'] = 'Erro ao enviar email, comunique um administrador | ' . $mail->ErrorInfo;
		}
		header('location: ../validacao.php');
	}
?>