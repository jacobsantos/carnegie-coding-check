<?php
namespace JacobSantos\CodingChallenge\Download;

use JacobSantos\CodingChallenge\Util\ToByteTransformable;

/**
 * Interface DownloadConfigurable
 *
 * Data transfer object for download configuration.
 *
 * @package JacobSantos\CodingChallenge\Download
 */
interface DownloadConfigurable
{
	public const DEFAULT_CHUNKS = 4;
	public const DEFAULT_CHUNK_SIZE = '1MiB';
	public const DEFAULT_DOWNLOAD_SIZE = '4MiB';

	/**
	 * @param ToByteTransformable $converter
	 * @return DownloadConfigurable
	 */
	public function set_size_converter(ToByteTransformable $converter): DownloadConfigurable;

	/**
	 * @param string $value
	 * @return DownloadConfigurable
	 */
	public function set_url(string $value): DownloadConfigurable;

	/**
	 * @return string
	 */
	public function get_url(): string;

	/**
	 * @param int $chunks
	 * @return DownloadConfigurable
	 */
	public function set_chunks(int $chunks=self::DEFAULT_CHUNKS): DownloadConfigurable;

	/**
	 * @return int
	 */
	public function get_chunks(): int;

	/**
	 * @param string $chunk_size
	 * @return DownloadConfigurable
	 */
	public function set_chunk_size(string $chunk_size=self::DEFAULT_CHUNK_SIZE): DownloadConfigurable;

	/**
	 * @return string
	 */
	public function get_chunk_size(): string;

	/**
	 * @return int
	 */
	public function get_chunk_bytes(): int;

	/**
	 * @param string $value
	 * @return DownloadConfigurable
	 */
	public function set_download_size(string $value=self::DEFAULT_DOWNLOAD_SIZE): DownloadConfigurable;

	/**
	 * @return string
	 */
	public function get_download_size(): string;

	/**
	 * @return int
	 */
	public function get_download_bytes(): int;

	/**
	 * Create range header for part.
	 *
	 * @param int $part
	 *     Start at 1.
	 * @return string
	 *     Range string
	 */
	public function part_range(int $part): string;
}