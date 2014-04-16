<?php

require "vendor/autoload.php";

$message = new Gaggle\RichMessage;

$message->setHeaders([
	"from"    => "email@address.com",
	"to"      => "email@address.com",
	"subject" => "this should be rich text w/ an attachment",
]);

$message->setMessage("this is some <strong>html</strong> text.");

$message->attachFile("./examples/attachment.txt");

print_r($message->marshal());

