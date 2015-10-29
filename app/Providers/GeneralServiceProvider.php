<?php

namespace App\Providers;

use App\Carousel;
use App\Setting;
use Response;
use Illuminate\Support\ServiceProvider;

class GeneralServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('logo', function()
        {
            return $logo = Setting::first()->logo;
        });

        Response::macro('xml', function(array $vars, $status = 200, array $header = [], $rootElement = 'response', $xml = null)
        {
            if (is_null($xml)) {
                $xml = new \SimpleXMLElement('<'.$rootElement.'/>');
            }

            foreach ($vars as $key => $value) {
                if (is_array($value)) {
                    Response::xml($value, $status, $header, $rootElement, $xml->addChild($key));
                } else {
                    if( preg_match('/^@.+/', $key) ) {
                        $attributeName = preg_replace('/^@/', '', $key);
                        $xml->addAttribute($attributeName, $value);
                    } else {
                        $xml->addChild($key, $value);
                    }
                }
            }

            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }

            return Response::make($xml->asXML(), $status, $header);
        });

        Response::macro('carousel', function()
        {
            $language = Session::get('current_lang');
            $carousel_images = $language->carousels()->get();

            return $carousel_images;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
