<?php
namespace JacobSantos\CodingChallenge\Download;

/**
 * Class FileDownloader
 *
 * Download a file in multiple parts.
 *
 * @package JacobSantos\CodingChallenge\Download
 */
class FileDownloader implements Downloadable
{
	/** @var DownloadConfigurable */
	private $configuration;

	/** @var MultiplexTransportable */
	private $transport;

	public function set_configuration(DownloadConfigurable $dto): Downloadable
	{
		$this->configuration = $dto;
		return $this;
	}

	public function set_transport(MultiplexTransportable $transport): Downloadable
	{
		$this->transport = $transport;
		return $this;
	}

	public function download(): string
	{
		foreach (range(1, $this->configuration->get_chunks()) as $part) {
			$this->transport->setup($this->configuration->get_url(), $this->configuration->part_range($part));
		}

		$this->transport->multiplex_setup();
		$this->transport->multiplex_execute();
		$content = $this->transport->get_content();
		$this->transport->destroy();
		return $content;
	}
}