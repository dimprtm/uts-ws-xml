<!DOCTYPE html>
<head>
	<title>UTS WS - XML</title>
</head>
<body>
    <h3>Input Data</h3>
	<form action="#" method="POST">
		<table>
			<tr>
				<td>ID</td>
				<td><input type="text" name="id" id="id"></input></td>
			</tr>
			<tr>
				<td>Nama Burung</td>
				<td><input type="text" name="nama" id="nama"></input></td>
			</tr>
			<tr>
				<td>Umur</td>
				<td><input type="number" name="umur" id="umur"></input></td>
			</tr>
			<tr>
				<td>Warna</td>
				<td><input type="text" name="warna" id="warna"></input></td>
			</tr>
			<tr>
				<td>Trah</td>
				<td><input type="text" name="trah" id="trah"></input></td>
			</tr>
			<tr>
				<td><a href="parsing.php">Lihat Data</a></td>
				<td><input type="submit" name="submit" id="submit" value="Kirim"></input></td>
			</tr>

		</table>
	</form>
	<?php
		// KONEKSI KE DATABASE
		$conn = mysqli_connect("localhost", "root", "", "ws_uts")
        or die("Error ".mysqli_error($conn));

		// MENGAMBIL DATA DARI INPUT FORM
		$id=isset($_POST["id"]) ? $_POST["id"] : "";
		$nama=isset($_POST["nama"]) ? $_POST["nama"] : "";
		$umur=isset($_POST["umur"]) ? $_POST["umur"] : "";
		$warna=isset($_POST["warna"]) ? $_POST["warna"] : "";
		$trah=isset($_POST["trah"]) ? $_POST["trah"] : "";

		// MEMASUKKAN DATA KE DATABASE
		if ($id != '') {
            $query = "INSERT INTO tb_dataxml(id, nama, umur, warna, trah)
                    VALUES ('$id', '$nama', '$umur', '$warna', '$trah')";
            mysqli_query($conn, $query);
            echo "Data dengan nama burung <b>$nama</b> telah tersimpan.";
		}
		else {
		}

		// MENGAMBIL DATA DARI DATABASE
		$query = "SELECT * FROM tb_dataxml";
		$result = mysqli_query($conn, $query);
		$jumField = mysqli_num_fields($result);
		$xml_array = array();

		while ($data = mysqli_fetch_array($result)) {
			$xml_array [] = $data;
		}

		// PARSING DATA
		$document = new DOMDocument();
		$document->formatOutput = true;

		$root = $document->createElement( "data" );
		$document->appendChild( $root );

		foreach( $xml_array as $tb_dataxml ) {
			$block = $document->createElement( "tb_dataxml" );

			$id = $document->createElement( "id" );
			$id->appendChild(
			$document->createTextNode( $tb_dataxml['id'] )
			);
			$block->appendChild( $id );

			$nama = $document->createElement( "nama" );
			$nama->appendChild(
			$document->createTextNode( $tb_dataxml['nama'] )
			);
			$block->appendChild( $nama );

			$umur = $document->createElement( "umur" );
			$umur->appendChild(
			$document->createTextNode( $tb_dataxml['umur'] )
			);
			$block->appendChild( $umur);

			$warna = $document->createElement( "warna" );
			$warna->appendChild(
			$document->createTextNode( $tb_dataxml['warna'] )
			);
			$block->appendChild( $warna );

			$trah = $document->createElement( "trah" );
			$trah->appendChild(
			$document->createTextNode( $tb_dataxml['trah'] )
			);
			$block->appendChild( $trah );

			$root->appendChild( $block );
			}

			// MENYIMPAN DATA KEDALAM BENTUK FILE .xml
			$document->save("datamerpati.xml");
	?>
</body>
</html>