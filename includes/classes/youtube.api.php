<?php
	/**
	* 
	*/

	class youtube extends HuntHelp
	{	
		/**
		* Searches YouTube videos against given query
		* @param : { string } { $query } { search term to be used }
		* @param : { integer } { $max_vids } { max videos to fetch }
		* @param : { string } { $token } { token to fetch next page vids }
		* @param : { string } { $sort } { sorting of vidds }
		* @return : { array } { an array with required details }
		*/

		function search($query, $max_vids = false, $token = false, $sort = false) {
			$q_strt = 'https://www.googleapis.com/youtube/v3/search?type=videos&part=snippet&q=';
			if (!$token) {
				$q = $q_strt.$query.'&key='.YOUTUBE_API_KEY;
			} else {
				$q = $q_strt.$query.'&key='.YOUTUBE_API_KEY.'&pageToken='.$token;
			}
			$q = str_replace(" ", "+", $q);
			if ($max_vids) {
				$q .= '&maxResults='.$max_vids;
			}

			if ($sort) {
				switch ($sort) {
					case 'views':
						$q .= '&order=viewCount';
						break;
					case 'likes':
						$q .= '&order=rating';
						break;
					case 'published_desc':
						$q .= '&order=date';
						break;
					default:
						$q .= '&order=relevance';
						break;
				}
			}

			$raw_data = file_get_contents($q);
			$readable = json_decode($raw_data,true);

			if ($token)  {
				return $this->search_process($readable, true);
			} else {
				return $this->search_process($readable);
			}
		}

		function search_channel($query, $max_vids = false, $token = false, $sort = false) {
			$q_strt = 'https://www.googleapis.com/youtube/v3/search?type=channel&part=snippet&q=';
			if (!$token) {
				$q = $q_strt.$query.'&key='.YOUTUBE_API_KEY;
			} else {
				$q = $q_strt.$query.'&key='.YOUTUBE_API_KEY.'&pageToken='.$token;
			}
			$q = str_replace(" ", "+", $q);
			if ($max_vids) {
				$q .= '&maxResults='.$max_vids;
			}

			$raw_data = file_get_contents($q);
			$readable = json_decode($raw_data,true);
			if ($token)  {
				return $this->search_process($readable, true);
			} else {
				return $this->search_process($readable);
			}
		}

		/**
		* Fetch related vids using id of video
		* @param : { string } { $id } { id of youtube video }
		* @param : { integer } { $max_vids } { number of max vids }
		* @param : { string } { $token } { token to get more vids }
		* @return : { array } { cleaned array with only needed details }
		*/

		function related($id, $max_vids = 8, $token = false) {
			if (!empty($id)) {
				$request = 'https://www.googleapis.com/youtube/v3/search?part=snippet&relatedToVideoId='.$id.'&type=video&maxResults='.$max_vids.'&key='.YOUTUBE_API_KEY;
				if ($token) {
					$request .= '&pageToken='.$token;
				}
				$raw_data = file_get_contents($request);
				$readable = json_decode($raw_data,true);
				return $this->search_process($readable, false, true);
			}
		}

		/**
		* Cleans raw data and returns req fields only
		* @param : { array } { $data } { array of raw api data }
		* @param : { boolean } { $more } { pass true when cleaning next page vids }
		* @param : { boolean } { $related } { pass true when cleaning related vids }
		* @return : { array } { array of cleaned data }
		*/

		function search_process($data, $more = false, $related = false, $vidlist = false ) {
			if (is_array($data)) {
				#pex($data,true);
				$clean_data = array();
				$clean_data['website'] = 'YouTube';
				$clean_data['next_token'] = $data['nextPageToken'];
				$clean_data['total'] = $data['pageInfo']['totalResults'];
				$srch_results = $data['items'];
				#pex($srch_results,true);$vidlist
				foreach ($srch_results as $key => $value) {
					$snippet = $value['snippet'];
					$created = $snippet['publishedAt'];
					if (!$vidlist) {
						$thevid = $value['id']['videoId'];
					} else {
						$thevid = $value['id'];
					}
					$clean_data['vid_meta'][$key]['vidid'] = $thevid;
						$published = substr($created, 0, strpos($created, "T"));
				    if ($more) {
				    	$published = $this->clean_time($published);
				    }
						$cont_dets = $this->get_content_details($thevid);
						/*if (!$cont_dets) {
							continue;
						}*/
						$clean_data['vid_meta'][$key]['published'] = $published;
						$clean_data['vid_meta'][$key]['chan_id'] = $snippet['channelId'];
						$clean_data['vid_meta'][$key]['chan_title'] = $snippet['channelTitle'];
						$clean_data['vid_meta'][$key]['description'] = $snippet['description'];
						$clean_data['vid_meta'][$key]['views'] = number_format($cont_dets['viewCount']);
						$clean_data['vid_meta'][$key]['duration'] = $cont_dets['duration'];
					
  					
					$clean_data['vid_meta'][$key]['title'] = $snippet['title'];
					$main_thumb = $snippet['thumbnails']['medium']['url'];
					if (empty($main_thumb)) {
						$main_thumb = $snippet['thumbnails']['medium']['url'];
					}
					$clean_data['vid_meta'][$key]['thumb'] = $main_thumb;
				}
				#pex($clean_data,true);
				return $clean_data;
			} else {
				return false;
			}
		}

		/**
		* Return data for playing a YouTube video
		* @param : { string } { $id } { id of video to play }
		* @return : { array } { $data } { array with req fields }
		*/

		function play_youtube($id, $dl = false) {
			if ($dl) {
				if(!empty($id)) {
					$content = $this->get_content_details($id, 'all');
					$items = $content['items'][0]['snippet'];
					$data = array();
					$data['chan_id'] = $items['channelId'];
					$data['vidid'] = $id;
					$data['title'] = str_replace(array('\n', "'", "’"), ' ', $items['title']);
					$data['description'] = str_replace(array("'", "’"), ' ', $items['description']);
					$data['tags'] = 'l';
					$data['thumb'] = $items['thumbnails']['medium']['url'];
					$data['username'] = $items['channelTitle'];
					$data['date_added'] = $items['publishedAt'];
					#pex($content,true);
					$data['duration'] = $this->conv_youtube_time($content['items'][0]['contentDetails']['duration']);
					$data['views'] = $content['items'][0]['statistics']['viewCount'];
					$data['likes'] = $content['items'][0]['statistics']['likeCount'];
					$data['comments'] = $content['items'][0]['statistics']['commentCount'];
					return $data;
				} else {
					return false;
				}
			} else {
				if(is_array($dl)) {
					$data = array();
					$data['vidid'] = $dl['id'];
					$data['title'] = str_replace(array('\n', "'", "’"), ' ', $dl['fulltitle']);
					$data['description'] = str_replace(array("'", "’"), ' ', $dl['description']);
					$data['tags'] = 'l';
					$data['thumb'] = $dl['thumbnail'];
					$data['username'] = $dl['uploader'];
					$data['date_added'] = $dl['upload_date'];
					#pex($content,true);
					$data['duration'] = $dl['duration'];
					$data['views'] = $dl['view_count'];
					$data['likes'] = $dl['like_count'];
					#$data['comments'] = $content['items'][0]['statistics']['commentCount'];
					#pex($data,true);
					return $data;
				} else {
					return false;
				}
			}
		}

		function get_content_details($id, $type = false) {
			if (!empty($id)) {
				if ($type == 'all') {
					$call = 'https://www.googleapis.com/youtube/v3/videos?id='.$id.'&key='.YOUTUBE_API_KEY.'&part=snippet,contentDetails,statistics';
				} else {
					$call = 'https://www.googleapis.com/youtube/v3/videos?id='.$id.'&key='.YOUTUBE_API_KEY.'&part=contentDetails,statistics';
				}
				#$call = 'http://localhost/pull_it_off/styles/videos';
				$youtube_content = file_get_contents($call);
				$readable = json_decode($youtube_content,true);
				#pex($readable,true);
				$contentDetails = $readable['items'][0]['contentDetails'];
				$stats = $readable['items'][0]['statistics'];
				if (empty($contentDetails) || empty($stats)) {
					$youtube_content = file_get_contents($call);
					$readable = json_decode($youtube_content,true);
					$contentDetails = $readable['items'][0]['contentDetails'];
					$stats = $readable['items'][0]['statistics'];
				}
				$details = array_merge($contentDetails, $stats);
				if (is_array($details)) {
					if (!$type) {
						$details['duration'] = $this->conv_youtube_time($details['duration']);
						return $details;
					} else {
						switch ($type) {
							case 'all':
								if (is_array($readable)) {
									return $readable;
								}
								break;
							case 'duration':
								$duration = $details['duration'];
								if (!empty($duration)) {
									$time = $this->conv_youtube_time($duration);
									if (is_numeric($time)) {
										return $time;
									} else {
										return false;
									}
								} else {
									return false;
								}
								break;
							case 'definition':
								$quality = $details['definition'];
								if (!empty($quality)) {
									return $quality;
								} else {
									return false;
								}
								break;
							case 'views':
								$views = $details['viewCount'];
								if (is_numeric($views)) {
									return $views;
								} else {
									return false;
								}
								break;
							case 'likes':
								$likes = $details['likeCount'];
								if (is_numeric($likes)) {
									return $likes;
								} else {
									return false;
								}
								break;
							case 'dlikes':
								$dlikes = $details['dislikeCount'];
								if (is_numeric($dlikes)) {
									return $dlikes;
								} else {
									return false;
								}
								break;
							case 'favs':
								$favs = $details['favoriteCount'];
								if (is_numeric($favs)) {
									return $favs;
								} else {
									return false;
								}
								break;
							case 'comments':
								$comments = $details['commentCount'];
								if (is_numeric($comments)) {
									return $comments;
								} else {
									return false;
								}
								break;
							default:
								# code...
								break;
						}
					}
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		function get_duration($id) {
			if (!empty($id)) {
				$data = $this->get_content_details($id, 'duration');
				return $data;
			} else {
				return false;
			}
		}

		function get_views($id) {
			if (!empty($id)) {
				$data = $this->get_content_details($id, 'views');
				return $data;
			} else {
				return false;
			}
		}

		function get_likes($id) {
			if (!empty($id)) {
				$data = $this->get_content_details($id, 'likes');
				return $data;
			} else {
				return false;
			}
		}

		/**
		* Extracts all kinds of info about provided YouTube video
		* @param : { string } { $youtube_url } { Link to video }
		* @param : { boolean } { $quality } { false by default. if set to true, returns only video quality }
		* @param : { boolean } { $thumb } { false by default. if set to true, returns thumbs only }
		*/

		function youtube_detailer($youtube_url, $raw = false) {
			if ($this->is_youtube($youtube_url)) {
				$video_id = $this->get_youtube_id($youtube_url);
				$YOUTUBE_API_KEY = YOUTUBE_API_KEY;
				$youtube_content = file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&key='.$YOUTUBE_API_KEY.'&part=snippet,contentDetails');
				$content = json_decode($youtube_content);
				if ( $raw ) {
					$content = json_decode($youtube_content,true);
					$this->pr($content);
				}
				$data = $content->items[0]->snippet;
				$time = $content->items[0]->contentDetails->duration;
				$quality = $content->items[0]->contentDetails->definition;;
				$caption = $content->items[0]->contentDetails->caption;
				$total = $this->conv_youtube_time($time);
				$time_format = $total / 60;				
				$vid_array['title'] 		= $data->title;
				$vid_array['description'] 	= $data->description;
				$vid_array['tags'] 			= $data->title;
				$vid_array['duration'] 		= $total;
				$vid_array['published'] = $data->publishedAt;
				$vid_array['channel_title'] = $data->channelTitle;
				$vid_array['channel_id'] = $data->channelId;
				$vid_array['caption'] = $caption;
				$vid_array['quality'] = $quality;
				$vid_array['thumbs'] = $data->thumbnails;
				return $vid_array;
			} else {
				return false;
			}
		}

		/**
		* Get YouTube channel ID using channel Name
		* @param : { string } { $channel_name } { name of the channel }
		* @return : { integer } { $channel_id } { Id of channel using given name }
		*/

		function yt_chan_byName( $channel_name ) {
			$hit = 'https://www.googleapis.com/youtube/v3/channels';
			$username = 'forUsername='.$channel_name;
			$part = 'part=id';
			$key = 'key='.YOUTUBE_API_KEY;
			$request = $hit.'?'.$username.'&'.$part.'&'.$key;
			$raw_data = file_get_contents($request);
			$readable = json_decode($raw_data);
			$channel_id = $readable->items[0]->id;
			return $channel_id;	
		}

		/**
		* Get YouTube channel ID using video URL
		* @param : { string } { $url } { url of any video of that channel }
		* @return : { integer } { $channel_id } { id of youtube channel }
		*/

		function yt_chan_byVideo( $url ) {
			$hit = 'https://www.googleapis.com/youtube/v3/videos';
			$id = 'id=Xvbfv378SYo';
			$part = 'part=snippet';
			$key = 'key='.YOUTUBE_API_KEY;
			$request = $hit.'?'.$id.'&'.$part.'&'.$key;
			$raw_data = file_get_contents($request);
			$readable = json_decode($raw_data);
			$channel_id = $readable->items[0]->snippet->channelId;
			return $channel_id;
		}

		/**
		* Extract provided youtube video's quality 
		* @param : { string } { $url } { link to youtube video }
		*/

		function youtube_quality( $url ) {
			$extract = $this->youtube_detailer( $url );
			$quality = $extract['quality'];
			return $quality;
		}

		/**
		* Extract all availble thumbs of video
		* @param: { string } { $url } { link to YouTube video to get thumbs }
		*/

		function youtube_thumbs( $url ) {
			$extract = $this->youtube_detailer( $url );
			$thumbs = $extract['thumbs'];
			return $thumbs;
		}

		/**
		* Checks if provided YouTube video is high quality or not
		* @param : { string } { $url } { link to video }
		* @param : { boolean } { $msg } { false by default. if set to true, displays operation messages }
		*/

		function is_youtube_hd($url) {
			if ( $this->is_url($url) ) {
				if ( $this->is_youtube($url) ) {
					$quality = $this->youtube_quality($url);
					if ($quality == 'hd') {
						return $quality;
					} elseif ($quality == 'sd') {
						return $quality;
					} else {
						return false;
						}
				}
			}
		}


		/** 
		* Extracts YouTube video id from URL
		* @param : { string } { $url } { link to youtube video }
		*/

		function get_youtube_id($url) {
			if ($this->is_youtube($url)) {
				$url_string = parse_url($url, PHP_URL_QUERY);
				parse_str($url_string, $args);
				return isset($args['v']) ? $args['v'] : false;
			} else {
				return false;
			}
		}

		/**
		* Checks if provided URL is youtube or not
		* @param : { string } { $url } { link to youtube video }
		*/

		function is_youtube($url) {
			if (strpos($url, 'youtube.com')) {
				$site = true;
			} else {
				$site = false;
			}
			return $site;
		}

		/**
		* Converts YouTube time format (PT3M20S) to seconds
		* @param : { string } { $defaultTime } { youtube time stamp }
		*/

		function conv_youtube_time($defaultTime) {
			preg_match_all('!\d+!', $defaultTime, $matches);
			$elems = $matches[0];
			$items = count($elems);
			switch ($items) {
				case 1:
					$mode = 's'; // secs
					break;
				case 2:
					$mode = 'm'; // mins
					break;
				case 3:
					$mode = 'h'; // hours
					break;
				case 4:
					$mode = 'd'; // days
					break;
				case 5:
					$mode = 'w'; // weeks
					break;
				default:
					# code...
					break;
			}

			switch ($mode) {
				case 's':
					$total = $elems[0];
					break;
				case 'm':
					$mins = $elems[0] * 60;
					$total = $mins + $elems[1];
					break;
				case 'h':
					$hours = $elems[0] * 3600;
					$mins = $elems[1] * 60;
					$total = $hours + $mins + $elems[2];
					break;
				case 'd':
					$days = $elems[0] * 86400;
					$hours = $elems[1] * 3600;
					$mins = $elems[2] * 60;
					$total = $days + $hours + $mins + $elems[3];
					break;
				case 'w':
					$weeks = $this->weeks_to_sec($elems[0]);
					$days = $elems[1] * 86400;
					$hours = $elems[2] * 3600;
					$mins = $elems[3] * 60;
					$total = $weeks + $days + $hours + $mins + $elems[4];
					break;
				
				default:
					return false;
					break;
			}
			return $total;
		}

		function channel($id) {
			$idlen = strlen($id);
			if ($idlen > 4 && $idlen < 10) {
				$id = $this->yt_chan_byName($id);
			}
			$request = 'https://www.googleapis.com/youtube/v3/channels?id='.$id.'&part=snippet,statistics,brandingSettings&key='.YOUTUBE_API_KEY;
			$raw_data = file_get_contents($request);
			$readable = json_decode($raw_data,true);
			#pex($readable,true);
			$cleaned = $this->process_channel($readable, $id);
			return $cleaned;
		}

		function process_channel($readable, $id) {
			if (is_array($readable)) {
				$vids_request = 'https://www.googleapis.com/youtube/v3/search?channelId='.$id.'&part=snippet,id&order=date&maxResults=20&key='.YOUTUBE_API_KEY;
				$raw_vids = json_decode(file_get_contents($vids_request),true);
				$vids = $this->search_process($raw_vids);
				$cleaned = array();
				$cleaned['vids'] = $vids['vid_meta'];
				$read = $readable['items'][0];
				$snip = $read['snippet'];
				$stats = $read['statistics'];
				$cleaned['title'] = $snip['title'];
				$cleaned['description'] = $snip['description'];
				$cleaned['published'] = $snip['publishedAt'];
				$cleaned['avatar'] = $snip['thumbnails']['medium']['url'];
				$cleaned['views'] = $stats['viewCount'];
				$cleaned['subs'] = $stats['subscriberCount'];
				$cleaned['comments'] = $stats['commentCount'];
				$cleaned['videos'] = $stats['videoCount'];
				$cleaned['cover'] = $read['brandingSettings']['image']['bannerMobileExtraHdImageUrl'];
				return $cleaned;
			}
		}

		function cat_vids($catid, $max, $more = false) {
			$request = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&chart=mostPopular&maxResults='.$max;
			if (is_numeric($catid)) {
				$request .= '&videoCategoryId='.$catid;
			}
			if ($more) {
				$request .= "&pageToken=".$more;
			}
			$request .= '&key='.YOUTUBE_API_KEY;
			$raw_data = file_get_contents($request);
			$readable = json_decode($raw_data,true);
			$cleaned = $this->search_process($readable,false,false,true);
			if (!$more) {
				return $cleaned;
			} else {
				echo json_encode($cleaned);
			}
		}

		function video_exists($video) {
			if (strlen($video) <= 12) {
				$ytid = $video;
			} else {
				$ytid = $this->get_youtube_id($video);
			}

			if (!empty($ytid)) {
				$hit = 'https://www.googleapis.com/youtube/v3/videos';
				$id = 'id='.$ytid;
				$part = 'part=snippet';
				$key = 'key='.YOUTUBE_API_KEY;
				$request = $hit.'?'.$id.'&'.$part.'&'.$key;
				$raw_data = file_get_contents($request);
				$readable = json_decode($raw_data,true);
				$snippet = $readable['items'][0]['snippet'];
				if (is_array($snippet)) {
					return $ytid;
				} else {
					return false;
				}
			}
		}

	}
?>