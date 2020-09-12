<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Menus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        \LaravelMenu::register()
            ->addClassNames('mr-auto')
            ->link('about', 'About')
            ->link('news.index', 'News')
            ->dropdown('Content', \LaravelMenu::dropdownContainer()
                ->link('users.index', 'Users')
                ->link('articles.index', 'Articles')
                ->dividerIf(auth()->check())
                ->headerIf(auth()->check(), 'Favorites')
                ->linkIf(auth()->check(), 'quotes.index,quotes.create', 'Quotes')
            )
            ->text('Sample text')
            ->content('<div class="mx-2 text-info pt-2">Sample content</div>');

        \LaravelMenu::register('auth')
            ->dropdownIf(auth()->check(), 'Profile', \LaravelMenu::dropdownContainer()
                ->link('settings', 'Settings')
            )
            ->linkIf(auth()->guest(), 'login', 'Login')
            ->linkIf(auth()->guest(), 'register', 'Register')
            ->linkIf(auth()->check(), 'logout', 'Logout');

        return $next($request);
    }
}
