<?php
// strtok($uri, '?') clean ? in uri
class WUPPUriParser
{

	public static function parse()
	{
		if (self::check_route()) {
			$response_result = call_user_func(self::get_current_route_function(), self::get_current_route());
			if (is_array($response_result)) {
				wp_send_json($response_result);
			}
			exit;
		}
	}

	private static function get_current_route_function()
	{
		return self::get_routes()[self::get_current_route()];
	}

	private static function check_route()
	{
		$bool1 = in_array(self::get_current_route(), array_keys(self::get_routes()));
		if ($bool1) {
			return true;
		}

		$full_address = self::get_full_current_route(false);
		foreach (self::get_routes() as $route) {
			if ((site_url() . $route) == $full_address) {
				return true;
			}
		}

		return false;
	}

	private static function get_routes()
	{
		return WUPPRouter::all_routers();
	}

	private static function have_localhost()
	{
		return strpos(site_url(), 'localhost') !== false;
	}

	public static function get_normal_route($have_parm = false)
	{
		if ($have_parm) {
			return $_SERVER['REQUEST_URI'];
		}
		$route = explode('?', $_SERVER['REQUEST_URI'])[0];

		if (self::have_localhost()) {
			$route_parts = explode('/', $route);
			unset($route_parts[0]);

			return implode('/', $route_parts);
		}

		return $route;
	}

	public static function get_site_protocol()
	{
		return strpos(site_url(), 'https://') !== false ? 'https://' : 'http://';
	}

	public static function get_full_current_route($have_parm = true)
	{
		$site = str_replace('http://', '', site_url());
		$site = str_replace('https://', '', $site);
		$site = explode('/', $site)[0];
		return self::get_site_protocol() . $site . self::get_normal_route($have_parm);
	}

	public static function get_current_route()
	{
		$site = self::get_full_current_route(false);
		return str_replace(site_url(), '', $site);
	}
	/**
	 * get current route parse with wp parse url
	 *
	 * @param [string] $status
	 */
	public static function get_current_route_parse_url(string $status = 'full')
	{
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$parsed = wp_parse_url($actual_link);
		$constructed_url = $parsed['scheme'] . '://' . $parsed['host'] . $parsed['path'];
		switch ($status) {
			case 'full':
				return $actual_link;
				break;
			case 'query-less':
				return $constructed_url;
				break;
			case 'path':
				return $parsed['path'];
				break;
			case 'query':
				return $parsed['query'];
				break;
			default:
				return $actual_link;
				break;
		}
	}
}
