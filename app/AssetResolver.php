<?php
/**
 * Використання просторів імен: перехід до глобальної функції
 * https://www.php.net/manual/ru/language.namespaces.fallback.php
 */
namespace WpForSteroids;

/**
 * Class AssetResolver
 *
 * 
 * Ця утиліта формує URI, щоб будувати активи в темі . 
 * Активи мають версію hash в межах своєї назви в файлі 
 * - кожен раз, коли змінюється файл, цей хеш змінюється, та змінюється ім'я файлу до якого додається цей хеш.
 *
 * 
 * Цей клас забезпечує функціональність для формування назви файлу за допомогою генерованого маніфесту
 * /build/mix-manifest.json без необхідності вказати версію хеш.
 *
 * @package WpForSteroids
 */
class AssetResolver {

	/**
	 * @var array
	 */
	private static $manifest = [];

	/**
	 * @param $path
	 *
	 * @return string
	 */
	public static function resolve( $path ) {
		// використаємо (::)
		// https://www.php.net/manual/ru/language.oop5.paamayim-nekudotayim.php#example-224
		if ( $map = self::get_manifest() ) {

			$path = self::leading_slash_it( $path );

			if ( isset( $map[ $path ] ) ) {
				return get_stylesheet_directory_uri() . '/build' . self::leading_slash_it( $map[ $path ] );
			}
		}

		return '';
	}

	/**
	 * 
	 * get_stylesheet_directory()
	 * https://developer.wordpress.org/reference/functions/get_stylesheet_directory/#source
	 * 
	 * file_get_contents — Читаєвміст файлу і виводить врядок
	 * https://www.php.net/manual/ru/function.file-get-contents.php
	 * 
	 * json_decode(string,) -Ця функція працює лише з рядками кодування UTF-8.
	 * https://www.php.net/manual/ru/function.json-decode.php
	 * 
	 * @return array|mixed|object
	 */
	private static function get_manifest() {
		if ( ! self::$manifest ) {
			$manifest = get_stylesheet_directory() . '/build/mix-manifest.json';

			if (
				$map = file_get_contents( $manifest ) and
				is_array( $map = json_decode( $map, true ) )
			) {
				self::$manifest = $map;
			}
		}

		return self::$manifest;
	}


	/**
	 * 
	 * Видаляє початкові "/" риски та зворотні косі риски "\", якщо вони існують
	 * 
	 * https://gist.github.com/mcaskill/4f91db18f9c4cf2e386b
	 * 
	 * @param $string
	 *
	 * @return string
	 */
	private static function leading_slash_it( $string ) {
		return '/' . ltrim( $string, '/\\' );
	}

}