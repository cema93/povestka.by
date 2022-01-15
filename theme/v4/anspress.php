<?php get_header('old'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php if(is_tax()) { ?>
						<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
							<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemprop="item" itemid="https://povestka.by/" href="https://povestka.by/"><i class="fa fa-home" aria-hidden="true"></i><span itemprop="name" class="sr-only">Главная</span></a>
								<meta itemprop="position" content="1" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemscope itemtype="https://schema.org/Thing" itemprop="item" itemid="https://povestka.by/questions/" href="https://povestka.by/questions/"><span itemprop="name">Все вопросы</span></a>
								<meta itemprop="position" content="2" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="hidden">
								<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo home_url( $wp->request . '/' ); ?>"><span itemprop="name"><?php the_title();?></span></a>
								<meta itemprop="position" content="3" />
							</li>
						</ol>
					<?php }elseif(is_single() AND ap_user_can_read_question($post->ID, get_current_user_id())) { ?>
						<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
							<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemprop="item" itemid="https://povestka.by/" href="https://povestka.by/"><i class="fa fa-home" aria-hidden="true"></i><span itemprop="name" class="sr-only">Главная</span></a>
								<meta itemprop="position" content="1" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemscope itemtype="https://schema.org/Thing" itemprop="item" itemid="https://povestka.by/questions/" href="https://povestka.by/questions/"><span itemprop="name">Все вопросы</span></a>
								<meta itemprop="position" content="2" />
							</li>
							<?php $cur_term = get_the_terms( $post->ID, 'question_category' ); ?>
							<?php if($cur_term) { ?>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a itemtype="http://schema.org/Thing" itemprop="item" itemid="https://povestka.by/questions/categories/<?php echo $cur_term[0]->slug; ?>/" href="https://povestka.by/questions/categories/<?php echo $cur_term[0]->slug; ?>/"><span itemprop="name"><?php echo $cur_term[0]->name; ?></span></a>
								<meta itemprop="position" content="3" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="hidden">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo home_url( $wp->request . '/' ); ?>"><span itemprop="name"><?php the_title();?></span></a>
								<meta itemprop="position" content="4" />
							</li>
							<?php } ?>
						</ol>
					<?php } ?>
					
					<?php if(!is_tax()) { ?>
						<h1><?php the_title(); ?></h1>
					<?php } ?>
					<!-- start --><?php the_content(); ?><!--end -->
				<?php endwhile; // end of the loop. ?>
				</section>
			</div>
		</div>
<?php get_footer('old'); ?>
