<?php
namespace JacobSantos\CodingChallenge\Console;

use JacobSantos\CodingChallenge\Download\CurlMultiplexTransport;
use JacobSantos\CodingChallenge\Download\DownloadConfigurable;
use JacobSantos\CodingChallenge\Download\DownloadConfiguration;
use JacobSantos\CodingChallenge\Download\FileDownloader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DownloadCommand
 *
 * CLI download command
 *
 * @package JacobSantos\CodingChallenge\Console
 */
class DownloadCommand extends Command
{
	protected function configure()
	{
		$this
			->setName('download')
			->setDescription('Download file in chunks.')
			->setHelp('Allows downloading a file in parts.')
			->addArgument('url', InputArgument::REQUIRED, 'Source url address to file to download')
			->addArgument('output', InputArgument::OPTIONAL, 'Destination file path to output')
			->addArgument('chunks', InputArgument::OPTIONAL, 'Number of chunks to download')
			->addArgument('chunk-size', InputArgument::OPTIONAL, 'Size of chunks')
			->addArgument('download-size', InputArgument::OPTIONAL, 'Total size to download of file')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$file_path = $input->getParameterOption('output', getcwd().'/ccc.output');

		$configuration = new DownloadConfiguration;
		$configuration->set_url($input->getParameterOption('url'));
		$configuration->set_chunks($input->getParameterOption('chunks', DownloadConfigurable::DEFAULT_CHUNKS));
		$configuration->set_chunk_size(
			$input->getParameterOption('chunk-size', DownloadConfigurable::DEFAULT_CHUNK_SIZE)
		);
		$configuration->set_download_size(
			$input->getParameterOption('download-size', DownloadConfigurable::DEFAULT_DOWNLOAD_SIZE)
		);

		$downloader = new FileDownloader;
		$downloader->set_configuration($configuration);
		$downloader->set_transport(new CurlMultiplexTransport);

		file_put_contents($file_path, $downloader->download());
	}
}