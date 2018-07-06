<?php
namespace JacobSantos\CodingChallenge\Util;

/**
 * Class ByteConverter
 *
 * Convert decimal and binary size string to numeric size value.
 *
 * @package JacobSantos\CodingChallenge\Util
 */
class ByteConverter implements ToByteTransformable
{
	/** @var string Raw value */
	private $value;

	/**
	 * ByteConverter constructor.
	 *
	 * @param string $size
	 *     Optional. Allow dependency injection and for testing.
	 *     Assumes bytes when not KB, KiB, MB, MiB, GB, GiB.
	 */
	public function __construct(string $size = null)
	{
		$this->value = $size;
	}

	/**
	 * @param null|string $value
	 * @return ToByteTransformable
	 */
	public function from_size(?string $value): ToByteTransformable
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * Converts size string to bytes.
	 *
	 * Assumes bytes when not KB, KiB, MB, MiB, GB, GiB.
	 *
	 * @return int
	 *     Byte size.
	 */
	public function to_bytes(): int
	{
		$value = $this->numeric_value();
		switch (true) {
			case $this->is_kilobyte():
				return $value * self::KB;
			case $this->is_kibibyte():
				return $value * self::KIB;
			case $this->is_megabyte():
				return $value * self::MB;
			case $this->is_mebibyte():
				return $value * self::MIB;
			case $this->is_gigabyte():
				return $value * self::GB;
			case $this->is_gibibyte():
				return $value * self::GIB;
		}
		return $value;
	}

	/**
	 * Whether KB.
	 * @return bool
	 */
	public function is_kilobyte(): bool
	{
		return $this->is_size('kb');
	}

	/**
	 * Whether KiB.
	 * @return bool
	 */
	public function is_kibibyte(): bool
	{
		return $this->is_size('kib');
	}

	/**
	 * Whether MB.
	 * @return bool
	 */
	public function is_megabyte(): bool
	{
		return $this->is_size('mb');
	}

	/**
	 * Whether MiB.
	 * @return bool
	 */
	public function is_mebibyte(): bool
	{
		return $this->is_size('mib');
	}

	/**
	 * Whether GB.
	 * @return bool
	 */
	public function is_gigabyte(): bool
	{
		return $this->is_size('gb');
	}

	/**
	 * Whether GiB.
	 * @return bool
	 */
	public function is_gibibyte(): bool
	{
		return $this->is_size('gib');
	}

	/**
	 * Convert raw value from string to integer.
	 * @return int
	 */
	public function numeric_value(): int
	{
		return (int) preg_replace('/[kmg][i]?[b]/i', '', $this->value);
	}

	/**
	 * @param string $order
	 * @return int
	 */
	public function is_size(string $order): int
	{
		return stripos($this->value, $order) !== false;
	}
}