<?php 
namespace Kaankilic\Waite\Libraries;
use Illuminate\Support\Facades\Storage;
class Waite{
	const GITHUB_TAGS_ENDPONT="/repos/kaankilic/disket/releases/latest";
	const GITHUB_API_ENDPONT="https://api.github.com";

	protected static $latestVersion;
	protected static $latestPackage;

	protected $isSuccessful;

	private static function getCurrentVersion(){
		$version = Storage::disk("local")->get("VERSION.md");
		return $version;
	}
	private static function getEndpoint(){
		return self::GITHUB_API_ENDPONT.self::GITHUB_TAGS_ENDPONT;
	}
	private static function getLatestVersion(){
		$client = new \GuzzleHttp\Client();	
		$res = $client->request('GET', self::getEndpoint(),['headers'=>['Accept'=>'application/vnd.github.v3+json']]);
		if ($res->getStatusCode()==200) {
			self::$latestVersion = json_decode($res->getBody())->tag_name;
			self::$latestPackage = json_decode($res->getBody())->zipball_url;
		}
	}
	private static function hasVersion(){
		return version_compare(self::getCurrentVersion(),self::getLatestVersion(),"<");
	}
	public static function update(){
		if (self::hasVersion()) {
			Storage::disk("local")->put(self::getLatestPackage,"latest_version.zip");
			Zipper::make('latest_version.zip')->extractTo('/', array('vendor','config','storage','public'), Zipper::BLACKLIST);
		}else{
			echo 'already updated';
		}
	}
}
?>