<?php

	/**
	* 
	*/
	class yahoo extends HuntHelp
	{
		function search($query, $max_vids, $page = false, $sort = false, $site = false) {
			if ($page) {
				$start = $page;
			} else {
				$start = false;
			}
			$query = str_replace(" ", "+", $query);

			$request = 'https://video.search.yahoo.com/search/video?p=';
			$request .= $query;
			if ($site) {
				if ($this->valid_yahoo_site($site)) {
					$request .= '&vsite='.$site;
				}
			}
			if ($sort) {
				if (is_numeric($sort) && strlen($sort) < 4) {
					if ($this->is_valid_quality($sort)) {
						$request .= '&vres='.$sort;
					}
				} else {
					if ($this->is_valid_dur($sort)) {
						$request .= '&durs='.$sort;
					}
				}
			}
			$request .= '&fr=sfp&o=js&gs=0&_partner=&fr2=p%3As%2Cv%3Av&b='.$start.'&iid=Y.1&ig=628ba880798a48b39900000000864514&n='.$max_vids;
			#exit($request);
			$raw_data = file_get_contents($request);
			if (!$raw_data) {
				$raw_data = file_get_contents($request);
			}
			$readable = json_decode($raw_data,true);
			#pex($readable,true);
			$cleaned = $this->process_search($readable, $site);
			#pex($cleaned,true);
			return $cleaned;
		}

		function process_search($readable, $site = false) {
			if (is_array($readable)) {
				$cleaned = array();
				$cleaned['total'] = $readable['m']['total'];
				$cleaned['theNext'] = $readable['m']['last'] + 1;
				$cleaned['website'] = ucfirst($site);
				foreach ($readable['results'] as $key => $value) {
					$temp_clean = array();
					$giant_host = $this->is_giant_host($value['rurl']);
					if ($giant_host) {
						$cleaned['vid_meta'][$key]['vidid'] = $giant_host;
					} else {
						/*if ($site == 'metacafe') {
							$cleaned['vid_meta'][$key]['vidid'] = $cafe_id.'&pl=cfe';
						} elseif ($site == 'myspace') {
							$mspace_id = str_replace("https://myspace.com/", "", $value['rurl']);
							$cleaned['vid_meta'][$key]['vidid'] = $mspace_id.'&pl=msp';
						} elseif ($site == 'mtv') {
							$mtvid = str_replace(array("http://www.mtv.com/videos/",".jhtml"), "", $value['rurl']);
							$cleaned['vid_meta'][$key]['vidid'] = $mtvid.'&pl=mtv';
						} elseif ($site == 'cbsnews') {
							$cbsid = str_replace("http://www.cbsnews.com/", "", $value['rurl']);
							$cleaned['vid_meta'][$key]['vidid'] = $cbsid.'&pl=cbs';
						}*/
						$cleaned['vid_meta'][$key]['vidid'] = rtrim($value['rurl'], '/');
					}
					
					$cleaned['vid_meta'][$key]['link'] = $value['rurl'];
					$cleaned['vid_meta'][$key]['title'] = $value['tit'];
					$cleaned['vid_meta'][$key]['description'] = $value['des'];
					$cleaned['vid_meta'][$key]['thumb'] = $this->mold_thumb($value['turl']);
					$cleaned['vid_meta'][$key]['host'] = $value['host'];
					$cleaned['vid_meta'][$key]['published'] = $value['age'];
					$cleaned['vid_meta'][$key]['views'] = number_format($value['views']);
					$cleaned['vid_meta'][$key]['duration'] = $value['l'];
					$cleaned['vid_meta'][$key]['html'] = urldecode(htmlspecialchars($value['html']));
					$file_path = wlf_srch_dir.'/files';
					$file_name = $cleaned['vid_meta'][$key]['vidid'];
					$file_name = str_replace("&pl=", "_", $file_name);
					#pex($cleaned,true);
					$temp_clean[] = $cleaned['vid_meta'][$key];
					if (!$giant_host) {
						file_put_contents($file_path.'/'.$file_name, json_encode($temp_clean));
					}
				}
				#pex($cleaned,true);
				return $cleaned;
			}
		}

		function valid_yahoo_site($site) {
			$site = strtolower($site);
			#exit($site);
			$sites_array = array('metacafe', 'hulu', 'vevo', 'myspace', 'mtv', 'cbsnews', 'foxnews', 'cnn', 'bing');
			if (in_array($site, $sites_array)) {
				return $site;
			} else {
				return false;
			}
		}

		function is_valid_dur($dur) {
			$dur = strtolower($dur);
			$dur_array = array('short','medium','long');
			if (in_array($dur, $dur_array)) {
				return $dur;
			} else {
				return false;
			}
		}

		function is_valid_quality($quality) {
			$quality_array = array('360','480','720','1080');
			if (in_array($quality, $quality_array)) {
				return $quality;
			} else {
				return false;
			}
		}

		function mold_thumb($url) {
			$turl = substr($url, 0, strpos($url, "&h="));
			return $turl .= '&h=180&w=320';
		}
	}
?>