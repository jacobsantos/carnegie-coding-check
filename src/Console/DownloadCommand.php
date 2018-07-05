<?php
namespace JacobSantos\CodingChallenge\Console;

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
			->addArgument('parts', InputArgument::OPTIONAL, 'Number of chunks to download')
			->addArgument('part-size', InputArgument::OPTIONAL, 'Size of chunks')
			->addArgument('download-size', InputArgument::OPTIONAL, 'Total size to download of file')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		//
	}
}