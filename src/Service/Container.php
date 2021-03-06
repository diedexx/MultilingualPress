<?php # -*- coding: utf-8 -*-

namespace Inpsyde\MultilingualPress\Service;

/**
 * Interface for all container implementations to be used for dependency management.
 *
 * @package Inpsyde\MultilingualPress\Service
 * @since   3.0.0
 */
interface Container extends \ArrayAccess {

	/**
	 * Bootstraps (and locks) the container.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function bootstrap();

	/**
	 * Replaces the factory callback with the given name with the given factory callback.
	 *
	 * @since 3.0.0
	 *
	 * @param string   $name        The name of an existing factory callback.
	 * @param callable $new_factory The new factory callback.
	 *
	 * @return Container Container instance.
	 */
	public function extend( string $name, callable $new_factory ): Container;

	/**
	 * Locks the container.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function lock();

	/**
	 * Stores the given value or factory callback with the given name, and defines it to be accessible even after the
	 * container has been bootstrapped.
	 *
	 * @since 3.0.0
	 *
	 * @param string $name  The name of a value or factory callback.
	 * @param mixed  $value The value or factory callback.
	 *
	 * @return Container Container instance.
	 */
	public function share( string $name, $value ): Container;
}
