<?php

/**
 * Class Member
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class Member extends Controller
{
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function login()
    {
		$_URL = URL . $_SESSION["Lang"] . "/";

        // load views
		$content = 'view/member/login.php';
        require APP . 'view/_templates/layout.php';
    }	

	public function register()
	{
		$_URL = URL . $_SESSION["Lang"] . "/";

        // load views
		$content = 'view/member/register.php';
        require APP . 'view/_templates/layout.php';
	}

}
