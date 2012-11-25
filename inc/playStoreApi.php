<?php
	error_reporting(0);
	include_once('Queryelements.php');
	class PlayStoreApi{
	
		private $base_store_url = 'https://play.google.com';
		
		function get_fcontent($url, $javascript_loop = 0, $timeout = 5) {
			$url = str_replace("&amp;", "&", urldecode(trim($url)));
			$cookie = tempnam ("/tmp", "CURLCOOKIE");
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_ENCODING, "");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
			$content = curl_exec($ch);
			$response = curl_getinfo($ch);
			curl_close ($ch);
			if ($response['http_code'] == 301 || $response['http_code'] == 302) {
				ini_set("user_agent", "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
				if ($headers = get_headers($response['url'])) {
					foreach($headers as $value) {
						if (substr( strtolower($value), 0, 9) == "location:") return get_url(trim(substr($value, 9, strlen($value))));
					}
				}
			}
			if (( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value) || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value) ) && $javascript_loop < 5) return get_url( $value[1], $javascript_loop+1 );
			else return array( $content, $response );
		}
		
		function itemInfo($item_id) {
			$playstoreurl = 'https://play.google.com/store/apps/details?id=';
			if(strpos($item_id, $playstoreurl) === false) $page_url = $playstoreurl.$item_id;
			else $page_url = $item_id;
			$this_content = $this->get_fcontent($page_url);
			if(isset($this_content[0])) {
				phpQuery::newDocumentHTML($this_content[0]);
				$error_found = pq("#error-section")->text();
				if($error_found != '') return 0;
				$banner_image = pq('.doc-banner-image-container > img')->attr('src');
				$banner_icon = pq('.doc-banner-icon > img')->attr('src');
				$ratings_context = explode(' ',pq('.ratings')->attr('title'));
				if(isset($ratings_context[1])) $ratings = $ratings_context[1];
				else $ratings = 'Not defined';
				$app_title = pq('.doc-banner-title')->html();
				$app_author = pq('.doc-header-link')->html();
				$author_store_url = $this->base_store_url.''.pq('.doc-header-link')->attr('href');
				$app_price = pq('.buy-button-price')->html();
				if(strpos($app_price, 'Install') !== false) $app_price = 'Kostenlos';
				$app_price = str_replace('Übersetzen', '', $app_price);
				$app_price = str_replace('kaufen', '', $app_price);
				$app_price = str_replace('Für ', '', $app_price);
				foreach(pq('.screenshot-image-wrapper > img') as $appshots) {
					$app_screen_shots = pq($appshots)->attr('src');
					$app_info['ScreenShots'][] = (object) array('screen_shot' => $app_screen_shots);
				}
				$os_required = 'Android '.pq('dt[itemprop="operatingSystems"] + dd')->html();
				$app_store_url = $page_url;
				$app_info['General'][] = (object) array(
					'app_store_url' => $app_store_url,
					'banner_image' => $banner_image, 
					'banner_icon' => $banner_icon, 
					'app_title' => $app_title, 
					'app_author' => $app_author, 
					'author_store_url' => $author_store_url,
					'app_price' => $app_price,
					'os_required' => $os_required,
				);
				return $app_info;
			}
			else return 0;
		}
	}
?>