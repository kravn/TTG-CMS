<?php

namespace App\Providers;

use App\Carousel;
use App\Partner;
use App\Setting;
use Response;
use App;
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

        $this->logo();
        $this->partners();

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

    /**
     * Customized application services
     *
     * returns Logo
     */
    private function logo() {
        $logo = Setting::first()->logo;
        view()->share('logo', $logo);
    }

    public function partners(){
        $partners = Partner::all();
        view()->share('partners', $partners);
    }

}
