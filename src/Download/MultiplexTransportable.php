<?php
namespace JacobSantos\CodingChallenge\Download;


interface MultiplexTransportable
{
	/**
	 * @param string $url
	 * @param string $range_header
	 * @return void
	 */
	public function setup(string $url, string $range_header);

	/**
	 * @return void
	 */
	public function multiplex_setup();

	/**
	 * @return void
	 */
	public function multiplex_execute();

	/**
	 * @return string
	 */
	public function get_content();

	/**
	 * @return void
	 */
	public function destroy();
}