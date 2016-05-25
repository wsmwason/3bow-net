<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->setPageTitle(config('site.title'));
        $this->setPageKeywords();
        $this->setPageDescription();
        $this->setPageOgTitle();
        $this->setPageOgImage();
        $this->setPageOgDescription();
        $this->setPageNavKeyword();
    }

    public function setPageTitle($title = '')
    {
        if (!is_array($title)) {
            $title = [$title];
        }
        $title = array_reverse($title);
        if ($this->getRouter()->getCurrentRequest()->getRequestUri() != '/') {
            $title[] = config('site.name');
        }
        foreach ($title as $key => $val) {
            $title[$key] = strip_tags($val);
        }
        $titleString = join(' - ', $title);
        View::share('pageTitle', $titleString);
    }

    public function setPageKeywords($keywords = [])
    {
        View::share('pageKeywords', join(',', $keywords));
    }

    public function setPageDescription($description = '')
    {
        View::share('pageDescription', $description);
    }

    public function setPageOgTitle($title = '')
    {
        View::share('pageOgTitle', $title);
    }

    public function setPageOgImage($imageUrl = '')
    {
        View::share('pageOgImage', $imageUrl);
    }

    public function setPageOgDescription($description = '')
    {
        View::share('pageOgDescription', $description);
    }

    public function setPageNavKeyword($keyword = '')
    {
        View::share('pageNavKeyword', $keyword);
    }

}
