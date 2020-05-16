<?php
function http_request($url){
    //persiapkan CURL
    $ch = curl_init();

    //set URL
    curl_setopt($ch, CURLOPT_URL, $url);

    //aktifkan fungsi trans nilai
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //matikan SSL agar bisa diakses di localhost
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    //Akses nilainya dan tampung hasil
    $output = curl_exec($ch);

    //close
    curl_close($ch);

    return $output;
}

//panggil http_req
$data = http_request("https://api.kawalcorona.com/indonesia/provinsi/");

//ubah format JSON to array assoc
$data = json_decode($data, TRUE);

$jumlah = count($data);
$nomor = 1;
//for ($i=0; $i<$jumlah; $i++){
//$hasil = $data[$i]['attributes'];

foreach ($data as $singledata){
    $hasil = $singledata['attributes'];
?>
    <tr>
        <td><?=$nomor++; ?></td>
        <td><?=$hasil['Provinsi']; ?></td>
        <td><?=$hasil['Kasus_Posi']; ?></td>
        <td><?=$hasil['Kasus_Semb']; ?></td>
        <td><?=$hasil['Kasus_Meni']; ?></td>
    </tr>

<?php
}

?>
