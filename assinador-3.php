<?php

require_once __DIR__ . '/vendor/autoload.php';

use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

// Load the XML to be signed
$doc = new DOMDocument();
$doc->load('sinoserra.xml');

// Create a new Security object 
$objDSig = new XMLSecurityDSig();
// Use the c14n exclusive canonicalization
$objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
// Sign using SHA-256
$objDSig->addReference(
    $doc, 
    XMLSecurityDSig::SHA1, 
    array('http://www.w3.org/2000/09/xmldsig#enveloped-signature')
);

// Create a new (private) Security key
$objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type'=>'private'));
/*
If key has a passphrase, set it using
$objKey->passphrase = '<passphrase>';
*/
// Load the private key
$objKey->loadKey('certificate2.pem', TRUE);

// Sign the XML file
$objDSig->sign($objKey);

// Add the associated public key to the signature
$objDSig->add509Cert(file_get_contents('certificate.pem'));

// Append the signature to the XML
$objDSig->appendSignature($doc->documentElement);
// Save the signed XML
$doc->save('signedv2.xml');

