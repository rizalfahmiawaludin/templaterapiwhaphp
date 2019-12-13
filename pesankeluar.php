<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WhatsUp</title>
</head>
<body>
	<div class="">
<div class="latar">
	<h1>Pesan Keluar</h1>
	<div class="body">
		<table class="pesan" border="1">
			<tr>
				<th>No</th>
				<th>Tanggal</th>
				<th>Pengirim</th>
				<th>Type Pesan</th>
				<th>Isi Pesan</th>
			</tr>
			<?php
			include 'koneksikedb.php';
			$my_apikey = "API KEY ANDA";
			$number = "NOMOR ANDA";
			$type = "OUT";
			$markaspulled = "0";
			$getnotpulledonly = "0";
			$creation_date = "";
			$api_url = "http://panel.rapiwha.com/get_messages.php";
			$api_url .= "?apikey=". urlencode ($my_apikey);
			$api_url .= "&number=". urlencode ($number);
			$api_url .= "&type=". urlencode ($type);
			$api_url .= "&markaspulled=". urlencode ($markaspulled);
			$api_url .= "&getnotpulledonly=". urlencode ($getnotpulledonly);
			$my_json_result = file_get_contents($api_url, false);
			$my_php_arr = json_decode($my_json_result);
			rsort($my_php_arr);
			$i=1;
			foreach($my_php_arr as $item)
			{
			  $from_temp = $item->from;
			  $to_temp = $item->to;
			  $text_temp = $item->text;
			  $type_temp = $item->type;
			  $creation_date_temp = $item->creation_date;
			          echo "<tr>";
			                  echo "<td>$i</td>
			                  <td>$creation_date_temp</td>
			                  <td>$to_temp</td>
			                  <td>$type_temp</td>
			                  <td>$text_temp</td>";
			              echo "</tr>";

						
			$sql="INSERT INTO tbl_msgout (tgl_kirim, no_tujuan, isi_pesan_kirim) VALUES ('$creation_date_temp', '$to_temp', '$text_temp')";

 			if ($conn->query($sql)) {
 				 $respone["MASSAGE"]="SAVE DATA BERHASIL";
 				 $respone["STATUS"]=200;
 			} else {
 				 $respone["MASSAGE"]="SAVE DATA GAGAL";
 				 $respone["STATUS"]=500;
 				 
 			 // echo json_encode(respone);
 				}
 			}

						?>

		</table>

				</script>

	</div>
 </div>
</div>
</body>