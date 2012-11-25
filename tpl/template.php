<div class="app-container">
	<table class="app-table">
		<tbody>
			<tr>
				<td class="app-icon">
					<a href="<?php app_store_url(); ?>" target="_blank" rel="nofollow" title="<?php app_title(); ?>"><br /><img src="<?php banner_icon(); ?>" alt="<?php app_title(); ?>" style="margin-top:-15px;" /><br /></a>
				</td>
				<td class="app-title">
					<a href="<?php app_store_url(); ?>" target="_blank" rel="nofollow" title="<?php app_title(); ?>"><?php app_title(); ?></a><br />
					<span class="preis">Preis: <?php app_price(); ?></span>
				</td>
				<td class="app-linkbox">
					<a href="<?php app_store_url(); ?>&referrer=utm_source%3Dblogtogode%26utm_medium%3Dwebsite%26utm_campaign%3Dblog"  target="_blank" rel="nofollow" title="<?php app_title(); ?> bei Google Play" class="button googleplay">Download im<br />Play Store</a>
				</td>
				<td class="app-qrcode">
					<img title="<?php app_title(); ?> bei Google Play" src="http://chart.apis.google.com/chart?cht=qr&#038;chl=<?php app_store_url(); ?>&#038;chs=100x100&#038;chld=L|0" alt="<?php app_title(); ?> bei Google Play" />
				</td>
			</tr>
		</tbody>
	</table>
</div>