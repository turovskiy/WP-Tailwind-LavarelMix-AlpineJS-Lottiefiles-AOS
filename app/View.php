<?php

namespace WpForSteroids;

class View {

	public static $view_dir = '';

	/**
	 * Рендер видів шаблону з даними
	 *
	 * Знаходить шаблон перегляду та включає його в межах видимості, як об'єкт/масив даних. Це дає можливість
     * досту до вихідних даних у шаблоні.
	 *
	 * 
	 * Примітка: Будь-які дані, передані в цю функцію, будуть створені як масив, а потім як об'єкт.Остаточні дані
     * в межах шаблону знаходяться у вигляді об'єкта з назвою змінної $data.
	 *
	 * 
	 *
	 *      array('name' => 'Alex', 'age' =>38)
	 *
	 * Буде перетворено на об'єкт, який буде використовуватися як;
	 *
	 *      $data->name
	 *      $data->age
	 *
	 * @param string|null $name Названа зміна для шаблону. Це у формі {$name}.php. Може включати каталоги, де це необхідно.
	 * @param object|array $data Асоціативний масив або об'єкт для використання всередині шаблону.
	 * @param string $suffix Файл суфікс.
	 *
	 * @return  string
	 */
	public static function prepare( $name, $data = [], $suffix = '.php' ) {

		$markup = '';
		$path = self::get_full_path( $name . $suffix );

		if ( $t = self::view_template_exists( $path ) ) {
			$data = self::prepare_data( $data );
			ob_start();
			include $path;
			$markup = ob_get_clean();
		}

		return $markup;
	}

	/**
	 * Використовує це з шаблонами Echo з
	 *
	 * @param $name
	 * @param array $data
	 * @param string $suffix
	 */
	public static function render( $name, $data = [], $suffix = '.php' ) {
		echo self::prepare( $name, $data, $suffix );
	}

	/**
	 * Викид Даних до об'єкта для використання в шаблоні
	 *
	 * @param $data
	 *
	 * @return object
	 */
	private static function prepare_data( $data ) {

		// if data is not already an object, cast as object
		if ( ! is_object( $data ) ) {
			$data = (object) (array) $data;
		}

		return $data;
	}

	/**
	 * Перевіряє, що шаблон існує
	 *
	 * @param $name
	 *
	 * @return bool
	 */
	private static function view_template_exists( $name ) {
		return file_exists( $name );
	}

	/**
	 * Збирає разом повний шлях до файлу
	 *
	 * @param $name
	 *
	 * @return string
	 */
	private static function get_full_path( $name ) {
		return trailingslashit( self::$view_dir ) . ltrim( $name, '/' );
	}

}