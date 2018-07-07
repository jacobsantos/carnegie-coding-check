<?php
namespace JacobSantos\CodingChallenge\Download;

use JacobSantos\CodingChallenge\Util\ByteConverter;
use JacobSantos\CodingChallenge\Util\ToByteTransformable;

/**
 * Class DownloadConfiguration
 *
 * Data transfer object for downloading.
 *
 * @package JacobSantos\CodingChallenge\Download
 */
class DownloadConfiguration implements DownloadConfigurable
{
	/**
	 * Address of file to download
	 * @var string
	 */
	private $url;

	/**
	 * The number of chunks to download
	 * @var int
	 */
	private $chunks;

	/**
	 * Chunk size in bytes
	 * @var int
	 */
	private $chunk_size;

	/**
	 * Raw download size
	 * @var int
	 */
	private $download_size;

	/**
	 * Object to convert size string to bytes.
	 * @var ToByteTransformable
	 */
	private $size_converter;

	public function __construct()
	{
		$this->size_converter = new ByteConverter;
	}

	/**
	 * @param ToByteTransformable $converter
	 * @return DownloadConfigurable
	 */
	public function set_size_converter(ToByteTransformable $converter): DownloadConfigurable
	{
		$this->size_converter = $converter;
		return $this;
	}

	/**
	 * @param string $value
	 * @return DownloadConfigurable
	 */
	public function set_url(string $value): DownloadConfigurable
	{
		$this->url = $value;
		return $this;
	}

	/**
	 * @return string
	 */
	public function get_url(): string
	{
		return $this->url;
	}

	/**
	 * @return int
	 */
	public function get_chunks(): int
	{
		return $this->chunks;
	}

	/**
	 * @param int $chunks
	 * @return DownloadConfigurable
	 */
	public function set_chunks(int $chunks = self::DEFAULT_CHUNKS): DownloadConfigurable
	{
		$this->chunks = $chunks;
		return $this;
	}

	/**
	 * @return string
	 */
	public function get_download_size(): string
	{
		return $this->download_size;
	}

	/**
	 * @param string $value
	 * @return DownloadConfigurable
	 */
	public function set_download_size(string $value=self::DEFAULT_DOWNLOAD_SIZE): DownloadConfigurable
	{
		$this->download_size = $value;
		return $this;
	}

	/**
	 * @return int
	 */
	public function get_download_bytes(): int
	{
		return $this->size_converter->from_size($this->download_size)->to_bytes();
	}

	/**
	 * @param string $chunk_size
	 * @return DownloadConfigurable
	 */
	public function set_chunk_size(string $chunk_size = self::DEFAULT_CHUNK_SIZE): DownloadConfigurable
	{
		$this->chunk_size = $chunk_size;
		return $this;
	}

	/**
	 * @return string
	 */
	public function get_chunk_size(): string
	{
		return $this->chunk_size;
	}

	/**
	 * @return int
	 */
	public function get_chunk_bytes(): int
	{
		return $this->size_converter->from_size($this->chunk_size)->to_bytes();
	}

	/**
	 * Create range header for part.
	 *
	 * @param int $part
	 *     Start at 1.
	 * @return string
	 *     Range string
	 */
	public function part_range(int $part): string
	{
		$chunk_bytes = $this->get_chunk_bytes();
		$start_range = ($part - 1) * $chunk_bytes;
		$end_range = $part * $chunk_bytes - 1;
		return "{$start_range}-{$end_range}";
	}
}