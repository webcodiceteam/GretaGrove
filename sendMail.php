<?php
	include './config.php';
	require "vendor/autoload.php";
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	
	function genrateExcel($mail,$fileName,$conn){
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		
		$sheet->setCellValue('A1', 'Product Name');
		$sheet->setCellValue('b1', 'Quantity');
		$sheet->setCellValue('c1', 'Total');

		$res = mysqli_query($conn, "SELECT * FROM jitendra_produtcs WHERE id=".$_POST['id']);

		while ($row = mysqli_fetch_assoc($res)) {
			$sheet->setCellValue('A2', $row['pName']);
			$sheet->setCellValue('b2', $row['pQty']);
			$sheet->setCellValue('c2', $row['disp']);
		}


		$writer = new Xlsx($spreadsheet);
		$writer->save('./excel/'.$fileName);
		sendMail($mail,$fileName);
	}

	function sendMail($mail,$fileName){
		$filename = $fileName;
		$file = './excel/'.$fileName;
		$mailto = $mail;
		$subject = 'Subject';
		$message = 'My message';
		$content = file_get_contents($file);
		$content = chunk_split(base64_encode($content));
		$separator = md5(time());
		$eol = "\r\n";
		$headers = "From: name <test@test.com>" . $eol;
		$headers .= "MIME-Version: 1.0" . $eol;
		$headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol;
		$headers .= "Content-Transfer-Encoding: 7bit" . $eol;
		$headers .= "This is a MIME encoded message." . $eol;
		// message
		$body = "--" . $separator . $eol;
		$body .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
		$body .= "Content-Transfer-Encoding: 8bit" . $eol;
		$body .= $message . $eol;
		// attachment
		$body .= "--" . $separator . $eol;
		$body .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
		$body .= "Content-Transfer-Encoding: base64" . $eol;
		$body .= "Content-Disposition: attachment" . $eol;
		$body .= $content . $eol;
		$body .= "--" . $separator . "--";
		//SEND Mail
		if (mail($mailto, $subject, $body, $headers)) {
			echo "mail send ... OK"; // or use booleans here
		} else {
			echo "mail send ... ERROR!";
			print_r( error_get_last() );
		}
	}

	$name = rand().'.xlsx';
	genrateExcel('Harman7b@gmail.com',$name,$conn);
?>