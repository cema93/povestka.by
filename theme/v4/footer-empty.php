	<?php wp_footer(); ?>
	<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(27034011, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/27034011" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
	<script type="text/javascript">
		ym(27034011, 'reachGoal', 'user_logged_in', {user_logged_in: "<?php if ( is_user_logged_in() ) { echo "yes"; }else{ echo "no"; } ?>"});
	<?php if( is_404() ){ ?>
			ym(27034011, 'reachGoal', 'error404', {URL: document.location.href});
	<?php } ?>
	</script>
</body>
</html>