<?php
namespace JacobSantos\CodingChallenge\Tests\Download;

use JacobSantos\CodingChallenge\Download\DownloadConfiguration;
use PHPUnit\Framework\TestCase;

class DownloadConfigurationTest extends TestCase
{
	/**
	 * @group unit
	 * @group property
	 * @small
	 * @test
	 */
	public function chunk_size_should_return_same()
	{
		$expected = '1MiB';
		$under_test = new DownloadConfiguration;
		$this->assertEquals($expected, $under_test->set_chunk_size($expected)->get_chunk_size());
	}

	/**
	 * @group unit
	 * @group property
	 * @small
	 * @test
	 */
	public function download_size_should_return_same()
	{
		$expected = '4MiB';
		$under_test = new DownloadConfiguration;
		$this->assertEquals($expected, $under_test->set_download_size($expected)->get_download_size());
	}

	/**
	 * @group unit
	 * @group property
	 * @small
	 * @test
	 */
	public function url_should_return_same()
	{
		$expected = 'http://example.com/test';
		$under_test = new DownloadConfiguration;
		$this->assertEquals($expected, $under_test->set_url($expected)->get_url());
	}

	/**
	 * @group unit
	 * @group property
	 * @small
	 * @test
	 */
	public function chunks_should_return_same()
	{
		$expected = 4;
		$under_test = new DownloadConfiguration;
		$this->assertEquals($expected, $under_test->set_chunks($expected)->get_chunks());
	}

	/**
	 * @group functional
	 * @group integration
	 * @small
	 * @test
	 */
	public function download_bytes_should_calculate()
	{
		$expected = 4 * pow(1024, 2);
		$under_test = new DownloadConfiguration;
		$under_test->set_download_size('4MiB');
		$this->assertEquals($expected, $under_test->get_download_bytes());
	}

	/**
	 * @group functional
	 * @group integration
	 * @small
	 * @test
	 */
	public function chunk_bytes_should_calculate()
	{
		$expected = 2 * pow(1024, 2);
		$under_test = new DownloadConfiguration;
		$under_test->set_chunk_size('2MiB');
		$this->assertEquals($expected, $under_test->get_chunk_bytes());
	}

	/**
	 * @group unit
	 * @small
	 * @depends chunk_size_should_return_same
	 * @depends chunk_bytes_should_calculate
	 * @test
	 * @dataProvider part_range_data_provider
	 */
	public function part_range_with_part_should_give_byte_range($part, $chunk_size, $expected)
	{
		$under_test = new DownloadConfiguration;
		$under_test->set_chunk_size($chunk_size);
		$this->assertEquals($expected, $under_test->part_range($part));
	}

	public function part_range_data_provider()
	{
		return [
			[1, "1MiB", "0-1048575"],
			[2, "1MiB", "1048576-2097151"],
			[3, "1MiB", "2097152-3145727"],
			[4, "1MiB", "3145728-4194303"],
		];
	}
}
