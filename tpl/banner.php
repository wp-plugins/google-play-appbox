<div class="appcontainer banner">
	<div style="width:auto; height:auto; position: relative !important;">
		<a href="<?php app_store_url(); ?>" target="_blank" rel="nofollow" title="<?php app_title(); ?>"><img src="<?php banner_image(); ?>" alt="<?php app_title(); ?>" class="appbanner" /></a>
		<img style="width: 86px !important; height: 86px !important;" title="<?php app_title(); ?> bei Google Play" src="http://chart.apis.google.com/chart?cht=qr&chs=400x400&chl=<?php app_store_url_enc(); ?>&chld=H|0" alt="<?php app_title(); ?> bei Google Play" class="qrcode qrcode-banner" />
	</div>
	<table class="appdetails">
		<tr>
			<td>
				<a href="<?php app_store_url(); ?>" target="_blank" rel="nofollow" title="<?php app_title(); ?>" class="apptitle"><?php app_title(); ?></a><br />
				<span class="developer">Entwickler: <a href="<?php author_store_url(); ?>" title="<?php app_author(); ?> im Play Store" class="appauthor" target="_blank" rel="nofollow"><?php app_author(); ?></a></span><br />
				<span class="price">Preis: <?php app_price(); ?></td>
			</td>
			<td class="appbutton">
				<a href="<?php app_store_url(); ?>"  target="_blank" rel="nofollow" title="<?php app_title(); ?> bei Google Play">Download im<br />Play Store</a>
			</td>
		</tr>
	</table>
</div>