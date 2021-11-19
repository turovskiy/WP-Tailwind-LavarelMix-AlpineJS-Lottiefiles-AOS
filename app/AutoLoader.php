<?php

namespace WpForSteroids;

/**
 * PSR4 Autoloader реалізація, яка включає необов'язкову
 *Функціональність дозволяючи декількох базових каталогів за єдиний простір імен
 * префікс
 *
 * Sourced from @link http://www.php-fig.org/psr/psr-4/examples/
 *
 * Враховуючи пакет класів Foo-Bar у файловій системі з наступним
 * шляхи ...
 *
 *      <?php
 *      // миттєвий autoloader
 *      $loader = new \Example\AutoLoaderClass;
 *
 *      // зареєструвати autoloader
 *      $loader->register();
 *
 *      // Зареєструйте базові каталоги для префікса простору імен
 *      $loader->addNamespace('Foo\Bar', '/path/to/packages/foo-bar/src');
 *      $loader->addNamespace('Foo\Bar', '/path/to/packages/foo-bar/tests');
 *
 * Наступний рядок призведе до того, що autoloader спробує завантажити
 * \Foo\Bar\Qux\Quux class from /path/to/packages/foo-bar/src/Qux/Quux.php:
 *
 *      <?php
 *      new \Foo\Bar\Qux\Quux;
 *
 * Наступний рядок призведе до того, що автозавантажувач спробує завантажити
 * \Foo\Bar\Qux\QuuxTest class from /path/to/packages/foo-bar/tests/Qux/QuuxTest.php:
 *
 *      <?php
 *      new \Foo\Bar\Qux\QuuxTest;
 */
class AutoLoader {

	/**
	 * Асоціативний масив, де ключ - це префікс імен і значення
	 * є масивом базових каталогів для класів у цьому просторі імен.
	 *
	 * @var array
	 */
	protected $prefixes = array();

	/**
	 * Зареєструватися навантажувач з SPL AutoLoader Stack.
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function register() {
		spl_autoload_register( array( $this, 'loadClass' ) );
	}

	/**
	 *Додає базовий каталог для префікса простору імен.
	 *
	 * @param string $prefix Префікс імен.
	 * @param string $base_dir Базовий каталог для файлів класу в
	 * namespace.
	 * @param bool $prepend Якщо true, привернуте базовий каталог до стека
	 * Замість того, щоб додати його;Це змушує його шукати спочатку
	 * ніж останній.
	 *
	 * @return void
	 */
	public function addNamespace( $prefix, $base_dir, $prepend = false ) {
		// нормалізувати простір імен prefix
		$prefix = trim( $prefix, '\\' ) . '\\';

		// Нормалізуйте базовий каталог з кінцевим сепаратором
		$base_dir = rtrim( $base_dir, DIRECTORY_SEPARATOR ) . '/';

		// Ініціалізуйте масив префікса імен
		if ( isset( $this->prefixes[ $prefix ] ) === false ) {
			$this->prefixes[ $prefix ] = array();
		}

		// зберегти базовий каталог для префікса простору імен
		if ( $prepend ) {
			array_unshift( $this->prefixes[ $prefix ], $base_dir );
		} else {
			array_push( $this->prefixes[ $prefix ], $base_dir );
		}
	}

	/**
	 *Завантажує файл класу для певного класу.
	 *
	 * @param string $class Повноцінне ім'я класу.
	 *
	 * @return mixed Назва файлу у разі успіху, або boolean false
	 * у разі провалу.
	 */
	public function loadClass( $class ) {
		// Поточний префікс імен
		$prefix = $class;

		// work зворотний через простір імен імена повністю кваліфікованого
		// Ім'я класу Щоб знайти назву файлу, що відображається
		while ( false !== $pos = strrpos( $prefix, '\\' ) ) {

			// Зберігає сепаратор іменування імен у префіксі
			$prefix = substr( $class, 0, $pos + 1 );

			// Решта - це назва відносного класу
			$relative_class = substr( $class, $pos + 1 );

			// Спроба завантажити файл відображення для префікса та відносного класу
			$mapped_file = $this->loadMappedFile( $prefix, $relative_class );
			if ( $mapped_file ) {
				return $mapped_file;
			}

			// Видаляє сепаратор іменного простору для наступної ітерації
			// з strrpos()
			$prefix = rtrim( $prefix, '\\' );
		}

		// ніколи не знайшов файл відображеного
		return false;
	}

	/**
	 * Завантажує файл відображення для префікса і відносний клас імен.
	 *
	 * @param string $prefix Префікс імен.
	 * @param string $relative_class Назва відносного класу.
	 *
	 * @return mixed Boolean false Якщо не завантажено файл, або
	 * назва завантаженого файлу, який був завантажений.
	 */
	protected function loadMappedFile( $prefix, $relative_class ) {
		//Чи є якісь базові каталоги для цього префікса простору імен?
		if ( isset( $this->prefixes[ $prefix ] ) === false ) {
			return false;
		}

		// Переглядає базові каталоги для цього префікса простору імен
		foreach ( $this->prefixes[ $prefix ] as $base_dir ) {

			// Замініть префікс простору імен з базовим каталогом,
			// Замінити розділювачі простору імен із сепараторами каталогу
			// У відносній назві класу додає .php
			$file = $base_dir
					. str_replace( '\\', '/', $relative_class )
					. '.php';

			// Якщо відображений файл існує, require його
			if ( $this->requireFile( $file ) ) {
				// Так, ми зробили
				return $file;
			}
		}

		// ніколи не знайшов його
		return false;
	}

	/**
	 * Якщо файл існує,require цого зе з файлової системи.
	 *
	 * @param string $file Файл який require.
	 *
	 * @return bool True якщо файл існує, false якщо ні.
	 */
	protected function requireFile( $file ) {
		if ( file_exists( $file ) ) {
			require $file;

			return true;
		}

		return false;
	}

}