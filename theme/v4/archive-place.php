<?php get_header('old'); ?>
	<div class="container">
		<div class="row">
			<h1>Карта военкоматов, воинских частей, АГС и служб помощи призывникам</h1>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
				<div id="map" style=" width: 100%;height:450px;display:none;"></div>
				<div id="map-loading" style=" width:100%;height:450px;/*background-color:#82CDFF;*/text-align:center;line-height:450px;font-size:80px;"><i class="fa fa-spinner fa-spin"></i></div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 place-cat-list">
			<?php
				$terms = get_terms(array( 'taxonomy' => 'place-cat', 'parent' => 0, 'hide_empty' => false ));
				foreach($terms as $term) {
					if($term->count>0){
						echo '<img src="https://povestka.by/wp-content/themes/stable/img-old/map-placemark/'.get_field('ymap_placemark_color', 'place-cat_'.$term->term_id).'.png"><input type="checkbox" checked id="islands#'.get_field('ymap_placemark_color', 'place-cat_'.$term->term_id).'DotIcon"><label for="islands#'.get_field('ymap_placemark_color', 'place-cat_'.$term->term_id).'DotIcon" class="btn '.get_field('ymap_placemark_color', 'place-cat_'.$term->term_id).'">'. $term->name .'</label><br>';
					}else{
						echo '<img src="https://povestka.by/wp-content/themes/stable/img-old/map-placemark/gray.png"><label for="'. $term->term_id .'" class="btn gray">'. $term->name .'</label><br>';
					}
				}
			?>
			</div>
		</div>
	</div>
<?php get_footer('old'); ?>
