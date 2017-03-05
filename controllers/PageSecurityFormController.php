<?php

namespace Algad\Photography\Controllers;

use Algad\Photography\Helpers\PageUtils;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class PageSecurityFormController extends Controller
{

    public function processRequest()
    {
        session_start();

        $pageURL = Request::input()['pageURL'];
        $submitedCode = Request::input()['protectionCode'];
        $pageProtectionCode = PageUtils::getInstance()->getPageProtectionCode($pageURL);

        if ($pageProtectionCode == $submitedCode)
        {
            if (!isset($_SESSION['accessList']))
            {
                $_SESSION['accessList'] = [$pageURL];
            }
            else
            {
                array_push($_SESSION['accessList'], $pageURL);
            }
            $_SESSION['accessList'] = array_unique($_SESSION['accessList']);

            return Redirect::to($pageURL);
        }
        else
        {
            return Redirect::to($pageURL . '?error=invalid_password');
        }
    }

}
