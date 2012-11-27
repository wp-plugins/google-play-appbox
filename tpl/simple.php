<div class="appcontainer simple">
	<a href="<?php app_store_url(); ?>" target="_blank" rel="nofollow" title="<?php app_title(); ?>"><img src="<?php banner_icon(); ?>" alt="<?php app_title(); ?>" class="appicon" /></a>
	<img style="width: 86px !important; height: 86px !important;" title="<?php app_title(); ?> bei Google Play" src="http://chart.apis.google.com/chart?cht=qr&chs=400x400&chl=<?php app_store_url_enc(); ?>&chld=H|0" alt="<?php app_title(); ?> bei Google Play" class="qrcode qrcode-boxed" />
	<a href="<?php app_store_url(); ?>"  target="_blank" rel="nofollow" title="<?php app_title(); ?> bei Google Play" class="appbutton">Download im<br />Play Store</a>
	<div class="appdetails">
		<a href="<?php app_store_url(); ?>" target="_blank" rel="nofollow" title="<?php app_title(); ?>" class="apptitle"><?php app_title(); ?></a><br />
		<span class="developer">Entwickler: <a href="<?php author_store_url(); ?>" title="<?php app_author(); ?> im Play Store" class="appauthor" target="_blank" rel="nofollow"><?php app_author(); ?></a></span><br />
		<span class="price">Preis: <?php app_price(); ?></span>
	</div>
</div>