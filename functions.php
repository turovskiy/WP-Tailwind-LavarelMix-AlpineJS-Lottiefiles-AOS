<?php

use WpForSteroids\AutoLoader;
use WpForSteroids\View;

/*
 * Настройте наш класс автоматической загрузки и сопоставление нашего пространства имен в каталог приложений.
 *
 * The autoloader follows PSR4 autoloading standards so, provided StudlyCaps are used for class, file, and directory
 * names, any class placed within the app directory will be autoloaded.
 *
 * i.e; If a class named SomeClass is stored in app/SomeDir/SomeClass.php, there is no need to include/require that file
 * as the autoloader will handle that for you.
 * 
 * Автозавантажувач відповідає стандартам автоматичного завантаження PSR4, за умови, 
 * що StudlyCaps використовуються для класу, файлу та каталогу імен, 
 * будь-який клас, розміщений у каталозі програми, буде автоматично завантажено.
 *
 * тобто; Якщо клас з назвою SomeClass зберігається в app/SomeDir/SomeClass.php, 
 * немає потреби включати цей файл оскільки автозавантажувач впорається з цим за Вас.
 */
require get_stylesheet_directory() . '/app/AutoLoader.php';
$loader = new AutoLoader();
$loader->register();
$loader->addNamespace( 'WpForSteroids', get_stylesheet_directory() . '/app' );

View::$view_dir = get_stylesheet_directory() . '/templates/views';

require get_stylesheet_directory() . '/includes/scripts-and-styles.php';



