<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \Filament\Http\Responses\Auth\Contracts\LogoutResponse::class,
            \App\Http\Responses\LogoutResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::pluck('value', 'key_name')->all();
                view()->share('siteSettings', $settings);
            }
            if (\Illuminate\Support\Facades\Schema::hasTable('pages') && \Illuminate\Support\Facades\Schema::hasTable('page_contents')) {
                $pages = \App\Models\Page::where('is_active', true)
                    ->with(['contents' => fn($q) => $q->where('is_active', true)])
                    ->get()
                    ->keyBy('slug');
                
                $pageContentData = [];
                foreach ($pages as $slug => $page) {
                    $pageContentData[$slug] = $page->contents->pluck('content_value', 'content_key')->all();
                }
                view()->share('pageContents', $pageContentData);
            }
        } catch (\Throwable $e) {
            // Catch error if database is not migrated/connected yet
        }
    }
}
