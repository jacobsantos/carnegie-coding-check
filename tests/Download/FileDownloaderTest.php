<?php
/**
 * Created by PhpStorm.
 * User: jacobsantos
 * Date: 7/7/18
 * Time: 8:23 AM
 */

namespace JacobSantos\CodingChallenge\Tests\Download;

use JacobSantos\CodingChallenge\Download\CurlMultiplexTransport;
use JacobSantos\CodingChallenge\Download\DownloadConfiguration;
use JacobSantos\CodingChallenge\Download\FileDownloader;
use PHPUnit\Framework\TestCase;

class FileDownloaderTest extends TestCase
{

	/**
	 * @group unit
	 * @medium
	 * @test
	 */
	public function download_should_give_empty_content()
	{
		$this->markTestIncomplete(
			'A look at how using mocks could work. Also needs to use Mockery or better mocking lib'
		);

		$configuration_mock = $this
			->getMockBuilder(DownloadConfiguration::class)
			->setMethods(['get_chunks', 'get_url', 'part_range'])
			->getMock();

		$transport_mock = $this
			->getMockBuilder(CurlMultiplexTransport::class)
			->getMock();

		$under_test = new FileDownloader;
		$under_test->set_configuration($configuration_mock);
		$under_test->set_transport($transport_mock);
		$this->assertEmpty($under_test->download());
	}
}
