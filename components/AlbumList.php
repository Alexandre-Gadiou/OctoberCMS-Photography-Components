<?php

namespace Algad\Photography\Components;

use Illuminate\Support\Facades\File;
use Algad\Photography\Components\AbstractAlbum;
use Algad\Photography\Helpers\StringUtils;

class AlbumList extends AbstractAlbum
{

    public function componentDetails()
    {
        return [
            'name' => 'Album list',
            'description' => 'Photos Albums list'
        ];
    }

    public function defineProperties()
    {
        return [
            'albums_folder' => [
                'title' => 'Albums folder',
                'description' => 'Folder where the albums are stored',
                'default' => 'storage/app/media',
                'type' => 'string'
            ],
            'view' => [
                'title' => 'View',
                'default' => 'default',
                'type' => 'dropdown',
                'options' => [
                    'default' => 'default',
                ],
            ],
        ];
    }

    private function getAlbumsFolderLocation()
    {
        return $this->getProperty('albums_folder');
    }

    public function getAlbumsList()
    {
        $directoryPath = $this->getAlbumsFolderLocation();
        $albums_list = array();
        $list = null;
        if (File::exists($directoryPath))
        {
            $list = File::directories($directoryPath);
        }

        if ($list != null)
        {
            foreach ($list as $album)
            {
                $locationExplode = explode("/", $album);
                $folderName = end($locationExplode);
                if (!StringUtils::getInstance()->startsWith($folderName, "hidden_"))
                {
                    if ($this->isAlbumList($album))
                    {
                        $titleFilePath = $album . DIRECTORY_SEPARATOR . "title.txt";
                        if (File::exists($titleFilePath))
                        {
                            array_push($albums_list, $album);
                        }
                    }
                    else
                    {
                        array_push($albums_list, $album);
                    }
                }
            }
        }

        return $albums_list;
    }

    public function onRender()
    {
        return $this->renderPartial('@' . $this->property('view'));
    }

    public function onRun()
    {
        if ($this->property('view') == 'default')
        {
            $this->addCss('/plugins/algad/photography/assets/vendor/animate/animate.css');
            $this->addCss('/plugins/algad/photography/assets/vendor/animate/set.css');
            $this->addCss('/plugins/algad/photography/assets/css/albumList.css');
        }
    }

}
