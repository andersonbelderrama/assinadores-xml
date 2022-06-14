<?php

require_once __DIR__ . '/vendor/autoload.php';

use Greenter\XMLSecLibs\Sunat\SignedXml;


$xmlPath = 'sinoserra.xml';
$certPath = 'certificate2.pem'; // Antes convertir pfx -> pem (private+certificate keys) 

$signer = new SignedXml();
$signer->setCertificateFromFile($certPath);
// or $signer->setCertificate('-----BEGIN RSA PRIVATE KEY-----.....');

$xmlSigned = $signer->signFromFile($xmlPath);
// or $signer->signXml('<Invoice>....');

file_put_contents("signed.xml", $xmlSigned);

