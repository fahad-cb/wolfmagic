<?php
    
	/**
	* 
	*/
	
	class bingVid extends HuntHelp
	{
		function search($q, $max_results = 10) {
			if (!empty($q)) {
				$acctKey = 'F4Aq2ZCowTnSw7NrV6JABtBSHUoz8sLbLuqXAMrU8r8';
				$rootUri = 'https://api.datamarket.azure.com/Bing/Search';
				$serviceOp ='Video';
				$market ='en-us';
				$query = urlencode("'$q'");
				$market = urlencode("'$market'");
				$requestUri = $rootUri."/".$serviceOp."?\$format=json&\$top=10&Query=".$query."&Market=".$market;
				#exit($requestUri);
				$auth = base64_encode("$acctKey:$acctKey");
				$data = array(  
				        'http' => array(
				                    'request_fulluri' => true,
				                    'ignore_errors' => true,
				                    'header' => "Authorization: Basic $auth"
				                    )
				        );
				$context = stream_context_create($data);
				$response = file_get_contents($requestUri, 0, $context);
				$response = json_decode($response,true);
				$response = $response['d']['results'];
				$clean = $this->process_search($response);
				pr($clean,true);
			}
		}

		function process_search($array) {
			if (is_array($array)) {
				$cleaned = array();
				foreach ($array as $key => $value) {
					$current = array();
					$current['id'] = $value['ID'];
					$current['title'] = $value['Title'];
					$current['mediaurl'] = $value['MediaUrl'];
					$current['displayurl'] = $value['DisplayUrl'];
					$current['duration'] = $value['RunTime'];
					$current['thumb'] = $value['Thumbnail']['MediaUrl'];
					$cleaned[] = $current;
				}
				return $cleaned;
			}
		}
	}
?>