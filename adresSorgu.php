<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://adres.nvi.gov.tr/Harita/'. $_POST["url"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "ilKimlikNo=34");

if (!empty($_POST["postKey"])){
$array = array($_POST["postKey"] => $_POST["postValue"]);
}

if (!empty($_POST["postKey2"])){
$array[$_POST["postKey2"]] = $_POST["postValue2"];
}


$fields = http_build_query($array);

curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Cookie: __RequestVerificationToken=ryJPr2ycLJZ2Kc-9pAuKrbE1m_RloMdpsYbTCvLa8DIYAbLup-Pv9H5ezTh43BYV3uctqGoioax8ptrVz3GR3heCUWQ1; ASP.NET_SessionId=dizaxf4tnchkwdxnzcbccjtg; TS01f94f95=0179b2ce45a89ca1c5ada323aeceacd80afddd113d351765168c930224f6652f8cf460ed0da0391c8a4ee55966c26c947c64a85e45c1cc92adb368c2d334812ba7037145cc2845b9de2a7f40ee3290bfe71b8942fb';
$headers[] = 'Origin: https://adres.nvi.gov.tr';
$headers[] = 'Alexatoolbar-Alx_ns_ph: AlexaToolbar/alx-4.0.3';
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Accept: */*';
$headers[] = 'Referer: https://adres.nvi.gov.tr/VatandasIslemleri/AdresSorgu';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'Connection: keep-alive';
$headers[] = '__requestverificationtoken: PmGLNmjRldmKzN2VgvZ29_NaHBx68rM0f06CzQ_tfS-2W52sW7zR39kV88BQ3h6RsSOUobuRH1UUs2qbCRSNGeDa9L81';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'Error:' . curl_error($ch);
}
echo $result;
curl_close ($ch);