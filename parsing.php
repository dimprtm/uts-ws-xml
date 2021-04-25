<?php
    //MENAMPILKAN DATA XML KE HTML
    $dataxml = simplexml_load_file('datamerpati.xml');

    echo "<h3>Data Burung Merpatiku (XML)</h3>";
    foreach($dataxml->tb_dataxml as $row) {
        echo "Nama Burung : ".$row->nama."<br>";
        echo "Umur : ".$row->umur." Tahun <br>";
        echo "Warna : ".$row->warna."<br>";
        echo "Trah : ".$row->trah."<hr>";
    }
    echo "<a href='index.php'>Kembali ke Form</a>";
?>