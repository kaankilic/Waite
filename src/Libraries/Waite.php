<?php 
namespace Kaankilic\Waite\Libraries;
class Waite{
	const GITHUB_TAGS_ENDPONT="/repos/:owner/:repo/tags";
	protected $currentVersion;
	protected $versionList = array();
	protected $isSuccessful;
	protected checkForVersions(){
		$URL = "http://github.com";
	}
	public function getCurrentVersion(){
		return $this->currentVersion();
	}
	public function setCurrentVersion($currentVersion){
		$this->currentVersion = $currentVersion;
	}
	public function findNextVersion(){
		foreach ($versionList as $version) {
			
		}
	}
	private function upload(){

	}
	private function update(){

	}
}
?>