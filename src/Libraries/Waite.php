<?php 
namespace Kaankilic\Waite\Libraries;
use Illuminate\Support\Facades\Storage;
class Waite{
	const GITHUB_TAGS_ENDPONT="/repos/:owner/:repo/releases/latest";
	protected $currentVersion;
	public $latestVersion;
	public $latestPackage;
	protected $isSuccessful;
	protected  function checkForVersions(){
		$URL = "http://github.com";
	}
	public function getCurrentVersion(){
		return Storage::disk("upload")->get("VERSION.md");
	}
	public function setCurrentVersion($currentVersion){
		self::$currentVersion = $currentVersion;
	}
	public function getLatestVersion(){
		$client = new \GuzzleHttp\Client();	
		$res = $client->request('GET', "https://api.github.com/".self::GITHUB_TAGS_ENDPONT);
		if ($res->getStatusCode()==200) {
			self::$latestVersion = $res->getBody->tag_name;
			self::$latestPackage = $res->getBody->zipball_url;
		}
	}
	private function hasVersion(){
		return version_compare(self::getCurrentVersion(),self::getLatestVersion(),"<");
	}
	public static function update(){
		if (self::hasVersion()) {
			Storage::disk("upload")->put(self::getLatestPackage,"latest_version.zip");
			Zipper::make('latest_version.zip')->extractTo('/', array('vendor','config'), Zipper::BLACKLIST);
		}
	}
}
?>