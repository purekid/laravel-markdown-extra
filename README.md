# Laravel Markdown Extra

This project is copied from https://github.com/Kindari/laravel-markdown , add support for markdown extra , such as 'table' syntax. 

Laravel Markdown is a wrapper of dflydev/markdown which integrates it into Laravel's View engine. It supports markdown  parsing, php preprocessing of markdown files, and blade preprocessing.

## Installation

Add `purekid/laravel-markdown-extra` to `composer.json`.

    "purekid/laravel-markdown-extra": "dev-master"
    
Run `composer update` to pull down the latest version of Laravel Markdown. Now open up `app/config/app.php` and add the service provider to your `providers` array, *after* the ViewServiceProvider.

    'providers' => array(
    	...
    		'Illuminate\View\ViewServiceProvider',
    		'Purekid\LaravelMarkdownExtra\MarkdownServiceProvider',
		...
    )

## Usage

Create a view file named foobar.md, foobar.md.php or foobar.md.blade.php then use it like normal:

    return View::make('foobar');
