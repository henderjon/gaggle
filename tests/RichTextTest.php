<?php

require_once "vendor/autoload.php";

FUnit::test("RichMessage::marshal()", function(){

	$message = new Gaggle\RichMessage;

	$message->setHeaders([
		"from"    => "email@address.com",
		"to"      => "email@address.com",
		"subject" => "this should be rich text",
	]);

	$message->setMessage("this is some <strong>html</strong> text.");

	$expected = file_get_contents("./tests/samples/sample_RichText.txt");
	$expected = str_replace("\n", "\r\n", $expected);

	$cleanups = [
		"!boundary=\"\w+\"!i" => "boundary=\"SHA1-HASH\"",
		"!--\w+!i" => "--SHA1-HASH",
	];

	$marshaled = preg_replace(array_keys($cleanups), array_values($cleanups), $message->marshal());

	FUnit::equal($expected, $marshaled);

});

FUnit::test("RichMessage::marshal() w/ attachment", function(){

	$message = new Gaggle\RichMessage;

	$message->setHeaders([
		"from"    => "email@address.com",
		"to"      => "email@address.com",
		"subject" => "this should be rich text w/ an attachment",
	]);

	$message->setMessage("this is some <strong>html</strong> text.");
	$message->attachFile("./tests/samples/sample_attachment.txt");

	$expected = file_get_contents("./tests/samples/sample_RichTextAttachment.txt");
	$expected = str_replace("\n", "\r\n", $expected);

	$cleanups = [
		"!boundary=\"\w+\"!i" => "boundary=\"SHA1-HASH\"",
		"!--\w+!i" => "--SHA1-HASH",
	];

	$marshaled = preg_replace(array_keys($cleanups), array_values($cleanups), $message->marshal());

	// drop($expected, $marshaled);

	FUnit::equal($expected, $marshaled, "random/unique sha1s are difficult to test against.");

});

FUnit::test("RichMessage::marshal() w/ all headers", function(){

	$message = new Gaggle\RichMessage;

	$message->setFrom("email@address.com")
		->setTo(["email@address.com"])
		->setReplyTo(["email@address.com"])
		->setCc(["email@address.com"])
		->setBcc(["email@address.com"])
		->setReturnPath("email@address.com")
		->setSubject("this should be rich text w/ all headers")
		->setMessage("this is some <strong>html</strong> text.");

	$expected = file_get_contents("./tests/samples/sample_RichTextAllHeaders.txt");
	$expected = str_replace("\n", "\r\n", $expected);

	$cleanups = [
		"!boundary=\"\w+\"!i" => "boundary=\"SHA1-HASH\"",
		"!--\w+!i" => "--SHA1-HASH",
	];

	$marshaled = preg_replace(array_keys($cleanups), array_values($cleanups), $message->marshal());

	// drop($expected, $marshaled);

	FUnit::equal($expected, $marshaled, "random/unique sha1s are difficult to test against.");

});