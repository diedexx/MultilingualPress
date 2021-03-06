<?php # -*- coding: utf-8 -*-

namespace Inpsyde\MultilingualPress\Database;

/**
 * Interface for all tables.
 *
 * @package Inpsyde\MultilingualPress\Database
 * @since   3.0.0
 */
interface Table {

	/**
	 * Returns an array with all columns that do not have any default content.
	 *
	 * @since 3.0.0
	 *
	 * @return string[] All columns that do not have any default content.
	 */
	public function columns_without_default_content(): array;

	/**
	 * Returns the SQL string for the default content.
	 *
	 * @since 3.0.0
	 *
	 * @return string The SQL string for the default content.
	 */
	public function default_content_sql(): string;

	/**
	 * Returns the SQL string for all (unique) keys.
	 *
	 * @since 3.0.0
	 *
	 * @return string The SQL string for all (unique) keys.
	 */
	public function keys_sql(): string;

	/**
	 * Returns the table name.
	 *
	 * @since 3.0.0
	 *
	 * @return string The table name.
	 */
	public function name(): string;

	/**
	 * Returns the primary key.
	 *
	 * @since 3.0.0
	 *
	 * @return string The primary key.
	 */
	public function primary_key(): string;

	/**
	 * Returns the table schema.
	 *
	 * @since 3.0.0
	 *
	 * @return string[] An array with column names as keys and the according SQL definitions as values.
	 */
	public function schema(): array;
}
