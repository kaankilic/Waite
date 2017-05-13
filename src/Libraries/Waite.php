<?php 
namespace Kaankilic\Waite\Libraries;
use Illuminate\Support\Facades\Storage;
class Waite{
	const GITHUB_TAGS_ENDPONT="/repos/:owner/:repo/releases/latest";
	protected $currentVersion;
	public $latestVersion;
	public $latestPackage;
	protected $isSuccessful;
	protected checkForVersions(){
		$URL = "http://github.com";
	}
	public function getCurrentVersion(){
		return Storage::disk("upload")->get("VERSION.md");
	}
	public function setCurrentVersion($currentVersion){
		$this->currentVersion = $currentVersion;
	}
	public function getLatestVersion(){
		$client = new \GuzzleHttp\Client();	
		$res = $client->request('GET', "https://api.github.com/".self::GITHUB_TAGS_ENDPONT);
		if ($res->getStatusCode()==200) {
			$this->latestVersion = $res->getBody->tag_name;
			$this->latestPackage = $res->getBody->zipball_url;
		}
	}
	private function hasVersion(){
		return version_compare($this->getCurrentVersion(),$this->getLatestVersion(),"<");
	}
	private function update(){
		if ($this->hasVersion()) {
			Storage::disk("upload")->put($this->getLatestPackage,"latest_version.zip");
			Zipper::make('latest_version.zip')->extractTo('/', array('vendor','config'), Zipper::BLACKLIST);
		}
	}
}
?>