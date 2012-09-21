<?php



class Model_OCTranspoInterface {
	

	public function getNextStops($stop, $route) {
		$appId = APP_ID;
		$apiKey = API_KEY;
		
		$cacheKey = sha1($appId . $apiKey) . "-$stop-$route";
		$c = new Model_SimplePHPcache_Cache;
		$c->setCache('OKNowGetNextStops');
		$c->eraseExpired();
		
		$result;
		if($c->isCached($cacheKey)) {
			$result = $c->retrieve($cacheKey);
			
			self::debugCheck("Retrieving from cache");
			
		}
		else {
			$url = "https://api.octranspo1.com/GetNextTripsForStop";
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST,4);
			curl_setopt($ch,CURLOPT_POSTFIELDS,"appID=$appId&apiKey=$apiKey&routeNo=$route&stopNo=$stop");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$result = curl_exec($ch);
			curl_close($ch);
			if($result === FALSE) {
				throw new Exception("curl_exec returned FALSE");
			}
			$c->store($cacheKey, $result, 30);

			self::debugCheck("Retrieving from web and stored in cache");			
			
		}
		
		return $result;
	}
	
	
	protected static function debugCheck($message) {
		if(DEBUG_LOG != '') {
			file_put_contents(DEBUG_LOG, date('c') . '   ' . $message . "\n", FILE_APPEND);
		}
	}
}
