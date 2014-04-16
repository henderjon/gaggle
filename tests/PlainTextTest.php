<?php

require_once "vendor/autoload.php";

FUnit::test("PlainMessage::marshal()", function(){

	$message = new Gaggle\PlainMessage;

	$message->setHeaders([
		"from"    => "email@address.com",
		"to"      => "email@address.com",
		"subject" => "this should be plain text",
	]);

	$message->setMessage("this is some <strong>plain</strong> text.");

	$expected = file_get_contents("./tests/samples/sample_PlainText.txt");
	$expected = str_replace("\n", "\r\n", $expected);

	FUnit::equal($expected, $message->marshal());

});