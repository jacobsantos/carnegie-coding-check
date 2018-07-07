<?php
namespace JacobSantos\CodingChallenge\Download;

/**
 * Class CurlMultiplexTransport
 * @package JacobSantos\CodingChallenge\Download
 */
class CurlMultiplexTransport implements MultiplexTransportable
{
	private $multi_handle = null;

	private $handles = [];

	/**
	 * @param string $url
	 * @param string $range_header
	 * @return resource|void
	 */
	public function setup(string $url, string $range_header)
	{
		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_HEADER, false);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_RANGE, $range_header);
		$this->handles[] = $handle;
	}

	public function multiplex_setup()
	{
		$this->multi_handle = curl_multi_init();
		foreach ($this->handles as $handle) {
			curl_multi_add_handle($this->multi_handle, $handle);
		}
	}

	public function multiplex_execute()
	{
		do {
			curl_multi_exec($this->multi_handle, $active);
		} while ($active);
	}

	public function get_content()
	{
		$content = [];
		foreach ($this->handles as $handle) {
			$content[] = curl_multi_getcontent($handle);
		}
		return implode('', $content);
	}

	public function destroy()
	{
		foreach ($this->handles as $handle) {
			curl_multi_remove_handle($this->multi_handle, $handle);
		}

		curl_multi_close($this->multi_handle);

		foreach ($this->handles as $handle) {
			curl_close($handle);
		}
	}
}