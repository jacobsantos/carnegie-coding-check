<?php
namespace JacobSantos\CodingChallenge\Download;

/**
 * Interface Downloadable
 *
 * Define an implementation of a file downloader.
 *
 * @package JacobSantos\CodingChallenge\Download
 */
interface Downloadable
{
	public function set_configuration(DownloadConfigurable $dto): Downloadable;

	public function set_transport(MultiplexTransportable $transport): Downloadable;

	public function download(): string;
}