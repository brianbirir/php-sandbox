<?php

function generate_uuid() {

	$string_format = '%05x%04x-%04x-%04x-%04x-%04x%04x%04x';

    return sprintf( $string_format,
     	mt_rand( 0, 0xffff ), 
     	mt_rand( 0, 0xffff ),
     	mt_rand( 0, 0xffff ),
     	mt_rand( 0, 0x0fff ) | 0x4000,
     	mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}


echo generate_uuid();

?>