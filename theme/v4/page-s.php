<?php
if(isset($_GET['text']) AND !empty($_GET['text'])) {
	wp_redirect( 'https://povestka.by/?s='.$_GET['text'] );
	exit;
}else{
	wp_redirect( 'https://povestka.by/?s=' );
	exit;
	
}
//if(isset($_GET['text']) AND !empty($_GET['text'])) { 
//	global $wpdb;
//	$data = array('text' => $_GET['text']);
//	$wpdb->insert('povestka_wp_search_query',$data);
//}
?>
<?php get_header(); ?>
<section>
	<div class="container">
	<?php  if(isset($_GET['text']) AND !empty($_GET['text'])) { ?>
		<div id="ya-site-results" data-bem="{&quot;tld&quot;: &quot;ru&quot;,&quot;language&quot;: &quot;ru&quot;,&quot;encoding&quot;: &quot;&quot;,&quot;htmlcss&quot;: &quot;1.x&quot;,&quot;updatehash&quot;: true}"></div><script type="text/javascript">(function(w,d,c){var s=d.createElement('script'),h=d.getElementsByTagName('script')[0];s.type='text/javascript';s.async=true;s.charset='utf-8';s.src=(d.location.protocol==='https:'?'https:':'http:')+'//site.yandex.net/v2.0/js/all.js';h.parentNode.insertBefore(s,h);(w[c]||(w[c]=[])).push(function(){Ya.Site.Results.init();})})(window,document,'yandex_site_callbacks');</script>
<style>
#ya-site-results {
	 background: transparent !important;
}
 #ya-site-results .b-body-items {
	 padding-left: 0 !important;
}
 #ya-site-results .b-serp-item__number {
	 display: none;
}
 #ya-site-results .b-serp-list {
	 margin: 0 auto;
}
 #ya-site-results .b-serp-item {
	 border-radius: 20px;
	 background: #fff;
	 padding: 15px 25px;
	 display: flex;
	 flex-direction: row;
	 align-items: center;
	 position: relative;
	 box-shadow: 0 40px 30px -15px rgba(0, 0, 0, 0.05);
	 margin-bottom: 30px;
}
 #ya-site-results .b-serp-item__mime {
	 color: #29322f !important;
	 font-family: "Manrope", sans-serif;
}
 #ya-site-results .b-serp-item__title-link, #ya-site-results .ad .ad-link {
	 color: #29322f !important;
	 font-weight: 600 !important;
	 font-size: 20px !important;
	 font-family: "Manrope", sans-serif;
}
 #ya-site-results .b-serp-item__title-link:hover {
	 color: #2daf00 !important;
	 font-family: "Manrope", sans-serif;
}
 #ya-site-results .b-bottom-wizard {
	 text-align: center;
	 margin-left: 0 !important;
}
 #ya-site-results .b-bottom-wizard .b-pager {
	 margin-left: 0 !important;
	 font-family: "Manrope", sans-serif;
}
 #ya-site-results .b-bottom-wizard .b-pager .b-pager__title {
	 display: none;
}
 #ya-site-results .b-bottom-wizard .b-pager__sorted {
	 display: none;
}
 #ya-site-results .b-bottom-wizard .b-link, #ya-site-results .b-bottom-wizard .b-pager__pages a {
	 color: #8f9398 !important;
	 font-size: 20px;
	 font-family: "Manrope", sans-serif;
}
 #ya-site-results .b-bottom-wizard .b-pager__arrow {
	 color: #29322f !important;
	 font-family: "Manrope", sans-serif;
}
 #ya-site-results .b-bottom-wizard .b-pager__current {
	 font-size: 20px;
	 color: #29322f !important;
	 border-bottom: 3px solid #2daf00;
	 background: none;
	 padding: 0;
	 margin: 0.15em 0.3em;
	 font-family: "Manrope", sans-serif;
}
 #ya-site-results .b-bottom-wizard .b-link:hover, #ya-site-results .b-bottom-wizard .b-pager__pages a:hover {
	 color: #8f9398 !important;
	 border-bottom: 3px solid #2daf00;
	 font-family: "Manrope", sans-serif;
}
 @media (max-width: 767.98px) {
	 #ya-site-results .b-bottom-wizard .b-pager .b-pager__key {
		 display: none;
	}
}
 		
</style>		
	<?php } ?>
	</div>
</section>
<?php get_footer(); ?>