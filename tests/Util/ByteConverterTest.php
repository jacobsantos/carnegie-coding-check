<?php
namespace JacobSantos\CodingChallenge\Tests\Util;

use JacobSantos\CodingChallenge\Util\ByteConverter;
use PHPUnit\Framework\TestCase;

/**
 * Class ByteConverterTest
 *
 * No mocking required, expect for to_bytes, but ignore mocking all dependencies tested.
 *
 * @package JacobSantos\CodingChallenge\Tests\Util
 * @small
 */
class ByteConverterTest extends TestCase
{
	/**
	 * @group unit
	 * @test
	 * @dataProvider is_size_success_conditions
	 */
	public function is_size_should_return_true($size, $value)
	{
		$under_test = new ByteConverter($value);
		$this->assertTrue($under_test->is_size($size));
	}

	/**
	 * @group unit
	 * @test
	 * @dataProvider is_size_fail_conditions
	 */
	public function is_size_should_return_false($size, $value)
	{
		$under_test = new ByteConverter($value);
		$this->assertFalse($under_test->is_size($size));
	}

	/**
	 * @group unit
	 * @test
	 * @dataProvider numeric_value_success_conditions
	 */
	public function numeric_value_with_value_should_strip_size($value, $expected)
	{
		$under_test = new ByteConverter($value);
		$this->assertEquals($expected, $under_test->numeric_value());
	}

	/**
	 * @group unit
	 * @group regression
	 * @test
	 * @dataProvider is_kilobyte_success_conditions
	 */
	public function is_kilobyte_should_return_true($value)
	{
		$under_test = new ByteConverter($value);
		$this->assertTrue($under_test->is_kilobyte());
	}

	/**
	 * @group unit
	 * @group regression
	 * @test
	 * @dataProvider is_kibibyte_success_conditions
	 */
	public function is_kibibyte_should_return_true($value)
	{
		$under_test = new ByteConverter($value);
		$this->assertTrue($under_test->is_kibibyte());
	}

	/**
	 * @group unit
	 * @group regression
	 * @test
	 * @dataProvider is_megabyte_success_conditions
	 */
	public function is_megabyte_should_return_true($value)
	{
		$under_test = new ByteConverter($value);
		$this->assertTrue($under_test->is_megabyte());
	}

	/**
	 * @group unit
	 * @group regression
	 * @test
	 * @dataProvider is_mebibyte_success_conditions
	 */
	public function is_mebibyte_should_return_true($value)
	{
		$under_test = new ByteConverter($value);
		$this->assertTrue($under_test->is_mebibyte());
	}

	/**
	 * @group unit
	 * @group regression
	 * @test
	 * @dataProvider is_gigabyte_success_conditions
	 */
	public function is_gigabyte_should_return_true($value)
	{
		$under_test = new ByteConverter($value);
		$this->assertTrue($under_test->is_gigabyte());
	}

	/**
	 * @group unit
	 * @group regression
	 * @test
	 * @dataProvider is_gibibyte_success_conditions
	 */
	public function is_gibibyte_should_return_true($value)
	{
		$under_test = new ByteConverter($value);
		$this->assertTrue($under_test->is_gibibyte());
	}

	/**
	 * @group unit
	 * @depends is_size_should_return_true
	 * @depends is_size_should_return_false
	 * @depends numeric_value_with_value_should_strip_size
	 * @test
	 * @dataProvider to_bytes_success_conditions
	 */
	public function to_bytes_with_value_should_give_correct_bytes($value, $expected)
	{
		$under_test = new ByteConverter($value);
		$this->assertEquals($expected, $under_test->to_bytes());
	}

	public function is_size_success_conditions()
	{
		return [
			['kib', '1kib'],
			['mib', '1MiB'],
			['gib', '1Gib'],
			['kb', '1kb'],
			['mb', '1MB'],
			['gb', '1Gb'],
		];
	}

	public function is_size_fail_conditions()
	{
		return [
			['kib', '1mib'],
			['kib', '1024'],
		];
	}

	public function numeric_value_success_conditions()
	{
		$use = mt_rand(1, PHP_INT_MAX);
		return [
			["{$use}kib", $use],
			["{$use}mib", $use],
			["{$use}gib", $use],
			["{$use}kb", $use],
			["{$use}mb", $use],
			["{$use}gb", $use],
		];
	}

	public function to_bytes_success_conditions()
	{
		return [
			["1kib", 1024],
			["1mib", pow(1024, 2)],
			["1gib", pow(1024, 3)],
			["1kb", 1000],
			["1mb", pow(1000, 2)],
			["1gb", pow(1000, 3)],
			["20kib", 20*1024],
			["20mib", 20*pow(1024, 2)],
			["20gib", 20*pow(1024, 3)],
			["20kb", 20000],
			["20mb", 20*pow(1000, 2)],
			["20gb", 20*pow(1000, 3)],
		];
	}

	public function is_kilobyte_success_conditions()
	{
		return $this->regression_provider_test_data('KB');
	}

	public function is_kibibyte_success_conditions()
	{
		return $this->regression_provider_test_data('KiB');
	}

	public function is_megabyte_success_conditions()
	{
		return $this->regression_provider_test_data('MB');
	}

	public function is_mebibyte_success_conditions()
	{
		return $this->regression_provider_test_data('MiB');
	}

	public function is_gigabyte_success_conditions()
	{
		return $this->regression_provider_test_data('GB');
	}

	public function is_gibibyte_success_conditions()
	{
		return $this->regression_provider_test_data('GiB');
	}

	private function regression_provider_test_data($suffix)
	{
		$extra_value = mt_rand(1, PHP_INT_MAX);
		return [
			["1{$suffix}"],
			["1000{$suffix}"],
			["2048{$suffix}"],
			["{$extra_value}{$suffix}"],
		];
	}
}