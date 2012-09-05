<?php



class Model_OCTranspoInterface {

	public function getNextStops($stop, $route) {
		
		$appId = APP_ID;
		$apiKey = API_KEY;
		
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
		
		return $result;
	}
}
