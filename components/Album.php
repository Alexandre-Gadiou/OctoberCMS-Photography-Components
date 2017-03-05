<?php

namespace Algad\Photography\Components;

use Algad\Photography\Components\AbstractAlbum;

class Album extends AbstractAlbum
{

    public function componentDetails()
    {
        return [
            'name' => 'Album',
            'description' => 'Photo album'
        ];
    }

    public function defineProperties()
    {
        return [
            'album_folder' => [
                'title' => 'Album folder',
                'description' => 'Album folder',
                'default' => 'storage/app/media',
                'type' => 'string'
            ],
            'gallery_height' => [
                'title' => 'Gallery height',
                'default' => '500px',
                'type' => 'string'
            ],
            'photos_width' => [
                'title' => 'Photos width',
                'default' => '23.5%',
                'description' => '(view folio)',
                'type' => 'string'
            ],
            'photos_spacing' => [
                'title' => 'Spacing',
                'description' => 'Spacing in px or % (view folio)',
                'default' => '0.5%',
                'type' => 'string'
            ],
            'photos_info' => [
                'title' => 'Show photo info',
                'description' => '(view folio)',
                'default' => 'false',
                'type' => 'checkbox'
            ],
            'view' => [
                'title' => 'View',
                'default' => 'default',
                'type' => 'dropdown',
                'options' => [
                    'default' => 'default',
                    'folio' => 'folio',
                ],
            ]
        ];
    }

    public function onRender()
    {
        return $this->renderPartial('@' . $this->property('view'));
    }

    public function onRun()
    {
        $this->addJs('/plugins/algad/photography/assets/vendor/galleria/javascript/galleria-1.5.3.min.js');
    }

    private function getAlbumLocation()
    {
        return $this->property('album_folder');
    }

    public function getName()
    {
        $albumLocation = $this->getAlbumLocation();
        return $this->getAlbumName($albumLocation);
    }

    public function getTitle()
    {
        $albumLocation = $this->getAlbumLocation();
        return $this->getAlbumTitle($albumLocation);
    }

    public function getLogo()
    {
        $albumLocation = $this->getAlbumLocation();
        return $this->getAlbumLogo($albumLocation);
    }

    public function getPhotoList()
    {
        $albumLocation = $this->getAlbumLocation();
        return $this->getAlbumPhotoList($albumLocation);
    }

    public function getPhotoTitle($photo)
    {
        $split = explode('/', $photo);
        $title = end($split);
        return $title;
    }

}
