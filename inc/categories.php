<?php


class CategoriesOne extends \Elementor\Widget_Base {

	protected $_has_template_content = false;

	public function get_name() {
		return 'wc-categories-new';
	}

	public function get_title() {
		return esc_html__( 'Product Categories New', 'elementor-pro' );
	}

	public function get_icon() {
		return 'eicon-product-categories';
	}

	public function get_keywords() {
		return [ 'woocommerce-elements', 'shop', 'store', 'categories', 'product' ];
	}

	public function get_categories() {
		return [
			'woocommerce-elements',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_layout',
			[
				'label' => esc_html__( 'Layout', 'elementor-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

	//	$this->add_columns_responsive_control();

		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Categories Count', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => '4',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter',
			[
				'label' => esc_html__( 'Query', 'elementor-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label' => esc_html__( 'Source', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Show All', 'elementor-pro' ),
					'by_id' => esc_html__( 'Manual Selection', 'elementor-pro' ),
					'by_parent' => esc_html__( 'By Parent', 'elementor-pro' ),
					'current_subcategories' => esc_html__( 'Current Subcategories', 'elementor-pro' ),
				],
				'label_block' => true,
			]
		);

		$categories = get_terms( 'product_cat' );

		$options = [];
		foreach ( $categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Categories', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => $options,
				'default' => [],
				'label_block' => true,
				'multiple' => true,
				'condition' => [
					'source' => 'by_id',
				],
			]
		);

		$parent_options = [ '0' => esc_html__( 'Only Top Level', 'elementor-pro' ) ] + $options;
		$this->add_control(
			'parent',
			[
				'label' => esc_html__( 'Parent', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => $parent_options,
				'condition' => [
					'source' => 'by_parent',
				],
			]
		);

		$this->add_control(
			'hide_empty',
			[
				'label' => esc_html__( 'Hide Empty', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => '',
				'label_on' => 'Hide',
				'label_off' => 'Show',
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'name',
				'options' => [
					'name' => esc_html__( 'Name', 'elementor-pro' ),
					'slug' => esc_html__( 'Slug', 'elementor-pro' ),
					'description' => esc_html__( 'Description', 'elementor-pro' ),
					'count' => esc_html__( 'Count', 'elementor-pro' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'elementor-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'elementor-pro' ),
					'desc' => esc_html__( 'DESC', 'elementor-pro' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_products_style',
			[
				'label' => esc_html__( 'Products', 'elementor-pro' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wc_style_warning',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'elementor-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'products_class',
			[
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'wc-products',
				'prefix_class' => 'elementor-products-grid elementor-',
			]
		);

		$this->add_control(
			'column_gap',
			[
				'label'     => esc_html__( 'Grid Column Gap', 'elementor-pro' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'default'   => [
					'size' => 25,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .container-box' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'row_gap',
			[
				'label'     => esc_html__( 'Grid Row Gap', 'elementor-pro' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'default'   => [
					'size' => 25,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .container-box' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);


		$this->add_control(
			'heading_image_style',
			[
				'label'     => esc_html__( 'Image', 'elementor-pro' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .container-box  a .img img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementor-pro' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .container-box a .img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_title_style',
			[
				'label'     => esc_html__( 'Title', 'elementor-pro' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'elementor-pro' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'global'    => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .container-box h4' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'global'    => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' => '{{WRAPPER}} .container-box h4',
			]
		);


		$this->end_controls_section();
	}

	private function get_shortcode() {
		$settings = $this->get_settings();

		$attributes = [
			'number' => $settings['number'],
			'columns' => 3,
			'hide_empty' => ( 'yes' === $settings['hide_empty'] ) ? 1 : 0,
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
		];

		if ( 'by_id' === $settings['source'] ) {
			$attributes['ids'] = $settings['categories'];
		} elseif ( 'by_parent' === $settings['source'] ) {
			$attributes['parent'] = $settings['parent'];
		} elseif ( 'current_subcategories' === $settings['source'] ) {
			$attributes['parent'] = get_queried_object_id();
		}

		return $attributes;
	}

	public function render() {
		$settings = $this->get_settings();

		$taxonomy     = 'product_cat';
		$orderby      = $this->get_shortcode()['orderby'];  
		$order        = $this->get_shortcode()['order'];  
		$show_count   = 1;        // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no  
		$title        = '';  
		$empty        = $this->get_shortcode()['hide_empty']; 

		$args = array(
				'taxonomy'     => $taxonomy,
				'orderby'      => $orderby,
				'order'      	=> $order,
				'show_count'   => $show_count,
				'pad_counts'   => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li'     => $title,
				'hide_empty'   => $empty
		);
		$all_categories = get_categories( $args );



		//  echo "<pre>";
		// // var_dump($all_categories);
		//  var_dump($this->get_shortcode());

		?>
		<style>
			.container-box{
				display: grid;
				grid-gap: 25px;
				grid-template-columns: repeat(3, minmax(0, 1fr));
			}
			.container-box .category{
				display: flex;
				align-items: center;
				border: 1px solid black;
				justify-content: space-between;
			}
			.container-box .arrow{
				height: 100%;
				display: flex;
				align-items: center;
				padding: 0 10px;
				background-color: black;
				color: white;
			}
			.container-box h4{
				margin: 0 15px;
    			line-height: 1;
				color: black;
			}
			.container-box .img{
				height: 100%;
			}
			.container-box .img img{
				height: 100px;
				width: 100px;
				object-fit: cover;
			}
			@media (max-width: 1018px){
				.container-box{
					grid-template-columns: repeat(2, minmax(0, 1fr));
				}
			}
			@media (max-width: 668px){
				.container-box{
					grid-template-columns: repeat(1, minmax(0, 1fr));
				}
			}
		</style>
		<div class="container-box">
			<?php
				if ( 'by_id' === $settings['source'] ) {
					$count = 0;
					foreach ($all_categories as $cat) {
						// if($cat->category_parent == 0) {
						if(in_array($cat->term_id,  $this->get_shortcode()['ids'])){
							if( $count  < $this->get_shortcode()['number']) {
									$category_id = $cat->term_id;      
									$thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
									$image        = wp_get_attachment_url( $thumbnail_id ); 
									?>
									<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="category">
										<div class="img">
											<?php
											if($image){
												?>
												<img width="100" height="100" src="<?php echo $image; ?>" alt="<?php echo $cat->name; ?>">
												<?php
											}else{
												?>
												<?php echo wc_placeholder_img('thumbnail'); ?>
												<?php
											}
											?>
										</div>
										<h4><?php echo $cat->name; ?></h4>
										<div class="arrow"><i aria-hidden="true" class="fas fa-arrow-right"></i></div>
									</a>
									<?php
					
									// $args2 = array(
									// 		'taxonomy'     => $taxonomy,
									// 		'child_of'     => 0,
									// 		'parent'       => $category_id,
									// 		'orderby'      => $orderby,
									// 		'show_count'   => $show_count,
									// 		'pad_counts'   => $pad_counts,
									// 		'hierarchical' => $hierarchical,
									// 		'title_li'     => $title,
									// 		'hide_empty'   => $empty
									// );
									// $sub_cats = get_categories( $args2 );
									// if($sub_cats) {
									// 	foreach($sub_cats as $sub_category) {
									// 		echo  $sub_category->name ;
									// 	}   
									// }
									$count++;
								}else{
									break;
								}     
						}  
						//}       
					}
				} elseif ( 'by_parent' === $settings['source'] ) {
					$count = 0;
					foreach ($all_categories as $cat) {
						// if($cat->category_parent == 0) {
						if($this->get_shortcode()['parent'] == $cat->parent){
							if( $count  < $this->get_shortcode()['number']) {
									$category_id = $cat->term_id;      
									$thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
									$image        = wp_get_attachment_url( $thumbnail_id ); 
									?>
									<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="category">
										<div class="img">
											<?php
											if($image){
												?>
												<img width="100" height="100" src="<?php echo $image; ?>" alt="<?php echo $cat->name; ?>">
												<?php
											}else{
												?>
												<?php echo wc_placeholder_img('thumbnail'); ?>
												<?php
											}
											?>
										</div>
										<h4><?php echo $cat->name; ?></h4>
										<div class="arrow"><i aria-hidden="true" class="fas fa-arrow-right"></i></div>
									</a>
									<?php
					
									// $args2 = array(
									// 		'taxonomy'     => $taxonomy,
									// 		'child_of'     => 0,
									// 		'parent'       => $category_id,
									// 		'orderby'      => $orderby,
									// 		'show_count'   => $show_count,
									// 		'pad_counts'   => $pad_counts,
									// 		'hierarchical' => $hierarchical,
									// 		'title_li'     => $title,
									// 		'hide_empty'   => $empty
									// );
									// $sub_cats = get_categories( $args2 );
									// if($sub_cats) {
									// 	foreach($sub_cats as $sub_category) {
									// 		echo  $sub_category->name ;
									// 	}   
									// }
									$count++;
								}else{
									break;
								}     
						}  
						//}       
					}
				} elseif ( 'current_subcategories' === $settings['source'] ) {
					$count = 0;
					foreach ($all_categories as $cat) {
						// if($cat->category_parent == 0) {
						if($this->get_shortcode()['parent'] == $cat->parent){
							if( $count  < $this->get_shortcode()['number']) {
									$category_id = $cat->term_id;      
									$thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
									$image        = wp_get_attachment_url( $thumbnail_id ); 
									?>
									<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="category">
										<div class="img">
											<?php
											if($image){
												?>
												<img width="100" height="100" src="<?php echo $image; ?>" alt="<?php echo $cat->name; ?>">
												<?php
											}else{
												?>
												<?php echo wc_placeholder_img('thumbnail'); ?>
												<?php
											}
											?>
										</div>
										<h4><?php echo $cat->name; ?></h4>
										<div class="arrow"><i aria-hidden="true" class="fas fa-arrow-right"></i></div>
									</a>
									<?php
					
									// $args2 = array(
									// 		'taxonomy'     => $taxonomy,
									// 		'child_of'     => 0,
									// 		'parent'       => $category_id,
									// 		'orderby'      => $orderby,
									// 		'show_count'   => $show_count,
									// 		'pad_counts'   => $pad_counts,
									// 		'hierarchical' => $hierarchical,
									// 		'title_li'     => $title,
									// 		'hide_empty'   => $empty
									// );
									// $sub_cats = get_categories( $args2 );
									// if($sub_cats) {
									// 	foreach($sub_cats as $sub_category) {
									// 		echo  $sub_category->name ;
									// 	}   
									// }
									$count++;
								}else{
									break;
								}     
						}  
						//}       
					}	
				}else{
					$count = 0;
					foreach ($all_categories as $cat) {
	
						// if($cat->category_parent == 0) {
							if( $count  < $this->get_shortcode()['number']  ) {
								$category_id = $cat->term_id;      
								$thumbnail_id = get_term_meta( $category_id, 'thumbnail_id', true );
								$image        = wp_get_attachment_url( $thumbnail_id ); 
								?>
								<a href="<?php echo get_term_link($cat->slug, 'product_cat'); ?>" class="category">
									<div class="img">
										<?php
										if($image){
											?>
											<img width="100" height="100" src="<?php echo $image; ?>" alt="<?php echo $cat->name; ?>">
											<?php
										}else{
											?>
											<?php echo wc_placeholder_img('thumbnail'); ?>
											<?php
										}
										?>
									</div>
									<h4><?php echo $cat->name; ?></h4>
									<div class="arrow"><i aria-hidden="true" class="fas fa-arrow-right"></i></div>
								</a>
								<?php
				
								// $args2 = array(
								// 		'taxonomy'     => $taxonomy,
								// 		'child_of'     => 0,
								// 		'parent'       => $category_id,
								// 		'orderby'      => $orderby,
								// 		'show_count'   => $show_count,
								// 		'pad_counts'   => $pad_counts,
								// 		'hierarchical' => $hierarchical,
								// 		'title_li'     => $title,
								// 		'hide_empty'   => $empty
								// );
								// $sub_cats = get_categories( $args2 );
								// if($sub_cats) {
								// 	foreach($sub_cats as $sub_category) {
								// 		echo  $sub_category->name ;
								// 	}   
								// }
								}else{
									break;
							}     
						//}  
						$count++;     
					}
				}
			?>
		</div>
		<?php
	}


	public function get_group_name() {
		return 'woocommerce';
	}
}
