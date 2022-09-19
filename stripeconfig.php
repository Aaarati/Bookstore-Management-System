<?php
	require('stripe-php-master/init.php');
	$publishableKey = 
	"pk_test_51LPzAQItba4jCM0DlPQxcZO3kttSy8QgJLHfz6e1YniVQnBdbADN4xAhDYCU2kuU014buz6UH7xommdFdiQ5W6yW00QsJGmDbU";
	$secretKey = 
	"sk_test_51LPzAQItba4jCM0DDNpkcxTD8AFUkoTk9y5sChKjqP5PP2INWW1Y8YZ1EGe4bEtBvUk3928mTMAybQ4F3JSt6iA000Izcgi0tL";
	\Stripe\Stripe::setApiKey($secretKey);
?>