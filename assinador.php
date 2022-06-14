<?php

require_once __DIR__ . '/vendor/autoload.php';

use Selective\XmlDSig\DigestAlgorithmType;
use Selective\XmlDSig\XmlSigner;

$xmlSigner = new XmlSigner();

// Load a pfx file
//$xmlSigner->loadPfxFile('10382163893.pfx', '290423');

// or load pfx from a string
//$xmlSigner->loadPfx('pfx content', 'password');

// or load a PEM file
$xmlSigner->loadPrivateKeyFile('certificate2.pem', '290423');

// or load a PEM private key from a string
//$xmlSigner->loadPrivateKey('private key content', 'password');

// Optional: Set reference URI
//$xmlSigner->setReferenceUri('');

// Create a signed file
$xmlSigner->signXmlFile('sinoserra.xml', 'signed-sha1.xml', DigestAlgorithmType::SHA1);

