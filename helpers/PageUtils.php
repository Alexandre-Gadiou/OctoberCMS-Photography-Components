<?php

namespace Algad\Photography\Helpers;

use RainLab\Pages\Classes\PageList;
use Illuminate\Support\Facades\File;
use Cms\Classes\Theme;

class PageUtils
{

    private static $_instance = null;

    private function __construct()
    {
        
    }

    public static function getInstance()
    {

        if (is_null(self::$_instance))
        {
            self::$_instance = new PageUtils();
        }

        return self::$_instance;
    }

    public function getPageProtectionCode($pageURL)
    {
        $theme = Theme::getEditTheme();
        $pageList = new PageList($theme);
        $pages = $pageList->listPages();

        $pageProtectionCode = "";
        foreach ($pages as $page)
        {
            if ($page['url'] == $pageURL)
            {
                if (isset($page['viewBag']) && isset($page['viewBag']['protectionCode']))
                {
                    $pageProtectionCode = $page['viewBag']['protectionCode'];
                    break;
                }
            }
        }

        return $pageProtectionCode;
    }

    public function hasAccessTo($accessList, $pageURL)
    {
        $result = false;
        foreach ($accessList as $access)
        {
            if ($access == $pageURL)
            {
                $result = true;
                break;
            }
        }

        return $result;
    }

    public function getAlbumTitle($albumLocation)
    {
        $title = null;
        $titleFilePath = $albumLocation . DIRECTORY_SEPARATOR . "title.txt";
        if (File::exists($titleFilePath))
        {
            $title = File::get($titleFilePath);
        }

        if (empty($title))
        {
            $title = $this->getAlbumName($albumLocation);
        }
        return $title;
    }

    public function getAlbumName($albumLocation)
    {
        $name = null;
        $split = explode('/', $albumLocation);
        $name = end($split);
        return $name;
    }

}
