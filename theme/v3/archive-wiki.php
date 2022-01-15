<?php get_header(); ?>
<?php

$terms = get_terms( array(
	'taxonomy'      => 'wiki-cat',
	'orderby'       => 'name', 
	'hide_empty'    => false, 
	'count'         => false,
	'hierarchical'  => true, 
) );
$terms = wp_list_filter( $terms, array('parent'=>0) );
?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h1>wiki</h1>
			<?php
				$prev_char = null;
				if( $terms && ! is_wp_error($terms) ){
					foreach( $terms as $term ){
						$char = mb_strtoupper(mb_substr($term->name,0,1, "UTF-8"), "UTF-8");
						if( $prev_char != $char ){
							if($prev_char != null) echo '</ul>';
							$prev_char = $char;
							echo "<h4>". $char ."</h4>";
							echo '<ul>';
						}
						echo "<li><a href='". get_term_link( (int) $term->term_id, 'wiki-cat' ) ."'>". $term->name ."</a></li>";
					}
					echo "</ul>";
				}
			?>
			</div>
		</div>
					<?php if(display_ad() AND wp_is_mobile()) { ?>
						<!-- Yandex.RTB R-A-270077-10 -->
						<div id="yandex_rtb_R-A-270077-10-1"></div>
						<script type="text/javascript">
							(function(w, d, n, s, t) {
								w[n] = w[n] || [];
								w[n].push(function() {
									Ya.Context.AdvManager.render({
										blockId: "R-A-270077-10",
										renderTo: "yandex_rtb_R-A-270077-10-1",
										pageNumber: 1,
										async: true
									});
								});
								t = d.getElementsByTagName("script")[0];
								s = d.createElement("script");
								s.type = "text/javascript";
								s.src = "//an.yandex.ru/system/context.js";
								s.async = true;
								t.parentNode.insertBefore(s, t);
							})(this, this.document, "yandexContextAsyncCallbacks");
						</script>
					<?php } ?>
					<?php if(display_ad() AND !wp_is_mobile()) { ?>
						<div class="clearfix"></div>
						<!-- Yandex.RTB R-A-270077-2 -->
						<div id="yandex_rtb_R-A-270077-2-1"></div>
						<script type="text/javascript">
							(function(w, d, n, s, t) {
								w[n] = w[n] || [];
								w[n].push(function() {
									Ya.Context.AdvManager.render({
										blockId: "R-A-270077-2",
										renderTo: "yandex_rtb_R-A-270077-2-1",
										pageNumber: 1,
										async: true
									});
								});
								t = d.getElementsByTagName("script")[0];
								s = d.createElement("script");
								s.type = "text/javascript";
								s.src = "//an.yandex.ru/system/context.js";
								s.async = true;
								t.parentNode.insertBefore(s, t);
							})(this, this.document, "yandexContextAsyncCallbacks");
						</script>
					<?php } ?>
	</div>
<?php get_footer(); ?>
