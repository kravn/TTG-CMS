<?php

namespace App\Providers;

use App\Carousel;
use Session;
use App\Partner;
use App\Setting;
use Response;
use App;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use SimpleXMLElement;

class GeneralServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        Response::macro('xml', function($vars, $status = 200, array $header = array(), $rootElement = 'response', $xml = null)
        {

            if (is_object($vars) && $vars instanceof Illuminate\Support\Contracts\ArrayableInterface) {
                $vars = $vars->toArray();
            }

            if (is_null($xml)) {
                $xml = new SimpleXMLElement('<' . $rootElement . '/>');
            }
            foreach ($vars as $key => $value) {
                if (is_array($value)) {
                    if (is_numeric($key)) {
                        Response::xml($value, $status, $header, $rootElement, $xml->addChild(str_singular($xml->getName())));
                    } else {
                        Response::xml($value, $status, $header, $rootElement, $xml->addChild($key));
                    }
                } else {
                    $xml->addChild($key, $value);
                }
            }
            if (empty($header)) {
                $header['Content-Type'] = 'application/xml';
            }
            return Response::make($xml->asXML(), $status, $header);
        });

        Response::macro('games_list', function()
        {

            return "HAHAHHAHA";
        });

        $this->logo();
        $this->partners();
        $this->copyright();
        //$this->gamelist();
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
    private function gamelist(){
        $url = Config::get('components.xml');
        $xml = new SimpleXMLElement($url);
        $games = [];
        $ctr = 0;
        foreach($xml->menu->submenu as $menu_item) {
            $games[$ctr] = $menu_item['name'];
            $ctr++;
        }
    }

    private function logo() {
        $logo = Setting::first()->logo;
        view()->share('logo', $logo);
    }

    public function partners(){
        $partners = Partner::all();
        view()->share('partners', $partners);
    }

    public function copyright(){
        $copyright = Session::get('current_lang');
        view()->share('copyright', $copyright);
    }

}
