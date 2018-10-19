<?php
namespace CeddyG\ClaraEvent;

use Illuminate\Support\ServiceProvider;

/**
 * Description of EntityServiceProvider
 *
 * @author CeddyG
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishesConfig();
		$this->publishesTranslations();
        $this->loadRoutesFrom(__DIR__.'/routes.php');
		$this->publishesView();
    }
    
    /**
	 * Publish config file.
	 * 
	 * @return void
	 */
	private function publishesConfig()
	{
		$sConfigPath = __DIR__ . '/../config';
        if (function_exists('config_path')) 
		{
            $sPublishPath = config_path();
        } 
		else 
		{
            $sPublishPath = base_path();
        }
		
        $this->publishes([$sConfigPath => $sPublishPath], 'clara.event.config');  
	}
	
	private function publishesTranslations()
	{
		$sTransPath = __DIR__.'/../resources/lang';

        $this->publishes([
			$sTransPath => resource_path('lang/vendor/clara-event'),
			'clara.event.trans'
		]);
        
		$this->loadTranslationsFrom($sTransPath, 'clara-event');
    }

	private function publishesView()
	{
        $sResources = __DIR__.'/../resources/views';

        $this->publishes([
            $sResources => resource_path('views/vendor/clara-event'),
        ], 'clara.event.views');
        
        $this->loadViewsFrom($sResources, 'clara-event');
	}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.event.php', 'clara.event'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.navbar.php', 'clara.navbar'
        );
        
        $this->mergeConfigFrom(
            __DIR__ . '/../config/clara.event-category.php', 'clara.event-category'
        );
    }
}
