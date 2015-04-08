	<?php

	function get_course($user, $pwd){

		$url_login = "http://ssfw.xmu.edu.cn/cmstar/userPasswordValidate.portal";
		$url_content = "http://ssfw.xmu.edu.cn/cmstar/index.portal?.pn=p1201_p3530_p3531";
		$post = "Login.Token1=" . $user . "&Login.Token2=" . $pwd . "&goto=http%3A%2F%2Fssfw.xmu.edu.cn%2Fcmstar%2FloginSuccess.portal&gotoOnFail=http%3A%2F%2Fssfw.xmu.edu.cn%2Fcmstar%2FloginFailure.portal";
		$cookie = dirname(__FILE__) . '/cookie.txt';

		login($url_login, $post, $cookie);
		return get_content($url_content, $cookie);

	}

	function login($url, $post, $cookie){

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$output = curl_exec($ch);
		curl_close($ch);

	}

	function get_content($url, $cookie){

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);

		$output = curl_exec($ch);
		curl_close($ch);

		return $output;

		//var_dump($output);
	}

	?>