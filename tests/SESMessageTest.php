<?php

require_once "vendor/autoload.php";

FUnit::test("SESMessage -- create full message", function(){
	$message = new \Gaggle\SESMessage;
	$message->setFrom("from@email.com");
	$message->setTo(["to1@email.com", "to2@email.com"]);
	$message->setCc(["cc1@email.com"]);
	$message->setCc(["cc2@email.com"], true);
	$message->setBcc(["bcc@email.com"]);
	$message->setReplyTo(["replyto@email.com"]);
	$message->setReturnPath("returnpath@email.com");
	$message->setSubject("THIS IS A SUBJECT");
	$message->setMessage("<strong>OMG!</strong> It's like, <b>WOAH!</b> For real, I'm kinda <i>freaking</i> out right now.");

	$expected = array(
		"Source"      => "from@email.com",
		"Destination" => array(
			"ToAddresses"  => ["to1@email.com", "to2@email.com"],
			"CcAddresses"  => ["cc1@email.com", "cc2@email.com"],
			"BccAddresses" => ["bcc@email.com"],
		),
		"Message" => array(
			"Subject" => array(
				"Data" => "THIS IS A SUBJECT",
				"Charset" => "UTF-8",
			),
			"Body" => array(
				'Html' => array(
					"Data" => "<strong>OMG!</strong> It's like, <b>WOAH!</b> For real, I'm kinda <i>freaking</i> out right now.",
					"Charset" => "UTF-8",
				),
				'Text' => array(
					"Data" => "OMG! It's like, WOAH! For real, I'm kinda freaking out right now.",
					"Charset" => "UTF-8",
				),
			),
		),
		"ReplyToAddresses" => ["replyto@email.com"],
		"ReturnPath"       => "returnpath@email.com",
	);

	FUnit::equal($expected, $message->marshal());
});

FUnit::test("SESMessage -- create partial message", function(){
	$message = new \Gaggle\SESMessage;
	$message->setFrom("from@email.com");
	$message->setTo(["to1@email.com", "to2@email.com"]);
	// $message->setCc(["cc1@email.com"]);
	// $message->setCc(["cc2@email.com"], true);
	// $message->setBcc(["bcc@email.com"]);
	// $message->setReplyTo(["replyto@email.com"]);
	// $message->setReturnPath("returnpath@email.com");
	$message->setSubject("THIS IS A SUBJECT");
	$message->setMessage("<strong>OMG!</strong> It's like, <b>WOAH!</b> For real, I'm kinda <i>freaking</i> out right now.");

	$expected = array(
		"Source"      => "from@email.com",
		"Destination" => array(
			"ToAddresses"  => ["to1@email.com", "to2@email.com"],
			// "CcAddresses"  => ["cc1@email.com", "cc2@email.com"],
			// "BccAddresses" => ["bcc@email.com"],
		),
		// "ReplyToAddresses" => ["replyto@email.com"],
		// "ReturnPath"       => "returnpath@email.com",
		"Message" => array(
			"Subject" => array(
				"Data" => "THIS IS A SUBJECT",
				"Charset" => "UTF-8",
			),
			"Body" => array(
				'Html' => array(
					"Data" => "<strong>OMG!</strong> It's like, <b>WOAH!</b> For real, I'm kinda <i>freaking</i> out right now.",
					"Charset" => "UTF-8",
				),
				'Text' => array(
					"Data" => "OMG! It's like, WOAH! For real, I'm kinda freaking out right now.",
					"Charset" => "UTF-8",
				),
			),
		),
	);

	FUnit::equal($expected, $message->marshal());
});