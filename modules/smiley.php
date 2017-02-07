<?php
function smiley($text)
{
	$text = str_replace(":)", '<img src="images/emoicons/happy.png">', $text);
	$text = str_replace("):)", '<img src="images/emoicons/angel.png">', $text);
	$text = str_replace(">:(", '<img src="images/emoicons/angry.png">', $text);
	$text = str_replace("o.o", '<img src="images/emoicons/cool.png">', $text);
	$text = str_replace("O.O", '<img src="images/emoicons/cool.png">', $text);
	$text = str_replace(":'(", '<img src="images/emoicons/crying.png">', $text);
	$text = str_replace(">:)", '<img src="images/emoicons/evil.png">', $text);
	$text = str_replace("<3<3", '<img src="images/emoicons/in_love.png">', $text);
	$text = str_replace(":*", '<img src="images/emoicons/kiss.png">', $text);
	$text = str_replace(":D", '<img src="images/emoicons/lol.png">', $text);
	$text = str_replace(":x", '<img src="images/emoicons/private.png">', $text);
	$text = str_replace("?:o", '<img src="images/emoicons/question.png">', $text);
	$text = str_replace("?:O", '<img src="images/emoicons/question.png">', $text);
	$text = str_replace(":(", '<img src="images/emoicons/sad.png">', $text);
	$text = str_replace("-.-", '<img src="images/emoicons/sleeping.png">', $text);
	$text = str_replace(":o", '<img src="images/emoicons/surprised.png">', $text);
	$text = str_replace(":O", '<img src="images/emoicons/surprised.png">', $text);
	$text = str_replace(":p", '<img src="images/emoicons/tongue.png">', $text);
	$text = str_replace(":P", '<img src="images/emoicons/tongue.png">', $text);
	$text = str_replace(";)", '<img src="images/emoicons/wink.png">', $text);
	return $text;
}
?>