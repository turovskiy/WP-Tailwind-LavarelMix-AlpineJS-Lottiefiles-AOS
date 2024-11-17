<?php

use WpForSteroids\AssetResolver;

add_action( 'wp_enqueue_scripts', function () {

	// Регистрирует сценарии и таблицы стилей
	wp_register_style( 'app', AssetResolver::resolve( 'css/app.css' ), [], false );
	wp_register_script( 'app', AssetResolver::resolve( 'js/app.js' ), [], false, true );

	// Глобальные активы enqueue
	// wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'app' );
	wp_enqueue_script( 'app' );

} );