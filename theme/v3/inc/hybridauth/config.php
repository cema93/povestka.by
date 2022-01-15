<?php

/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return array(
    "base_url" => "https://povestka.by/wp-content/themes/stable/inc/hybridauth/",
    "providers" => array(
        "Vkontakte" => array(
            "enabled" => true,
            "keys" => array("id" => "5961671", "secret" => "G1q5nqKhkKpOPmJW4562"),
			"scope" => "email,offline"
        ),
        "Facebook" => array(
            "enabled" => true,
            "keys" => array("id" => "314169135665430", "secret" => "06ddfcbd092b8a0f9ef530d5f43c769f"),
			"scope" => "email"
        ),
        "Google" => array(
            "enabled" => true,
            "keys" => array("id" => "211624549566-dsuc64gt236j5d8v8ob204pgg318iemk.apps.googleusercontent.com", "secret" => "F83wJ_HgTgIi2ardpeTaC23K"),
			"scope" => "email"
        )
    ),
    // If you want to enable logging, set 'debug_mode' to true.
    // You can also set it to
    // - "error" To log only error messages. Useful in production
    // - "info" To log info and error messages (ignore debug messages)
    "debug_mode" => false,
    // Path to file writable by the web server. Required if 'debug_mode' is not false
    "debug_file" => "",
);
