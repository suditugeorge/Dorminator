const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
	 mix.sass("home.scss")
	 	.coffee("home.coffee")
		.coffee("dorm.coffee")
    	.coffee("student.coffee")
		.coffee("institution.coffee")
    	.coffee("messages.coffee")
    	.coffee("main.coffee")
	 	.coffee("profile.coffee")
    	.coffee("change-password.coffee")
	 	.coffee("users-admin.coffee");
});
