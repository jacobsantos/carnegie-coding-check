<?php
namespace JacobSantos\CodingChallenge\Util;

/**
 * Interface ToByteTransformable
 * @package JacobSantos\CodingChallenge\Util
 */
interface ToByteTransformable
{
	public const KB = 1000;
	public const KIB = 1024;
	public const MB = self::KB*self::KB;
	public const MIB = self::KIB*self::KIB;
	public const GB = self::KB*self::KB*self::KB;
	public const GIB = self::KIB*self::KIB*self::KIB;

	/**
	 * Raw size string.
	 *
	 * @param null|string $value
	 *     Assumes bytes when not KB, KiB, MB, MiB, GB, GiB.
	 * @return ToByteTransformable
	 */
	public function from_size(?string $value): ToByteTransformable;

	/**
	 * Converts size string to bytes.
	 *
	 * Assumes bytes when not KB, KiB, MB, MiB, GB, GiB.
	 *
	 * @return int
	 *     Byte size.
	 */
	public function to_bytes(): int;
}