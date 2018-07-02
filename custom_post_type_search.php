								<div class="row">
										<div class="cus_search_form">
											<form class="search" action="<?php echo get_permalink(); ?>">
											  <input type="search" name="search" placeholder="Find a Blood Bank">
											  <input type="submit" value="Search">
											  
											</form>	
											
										</div>

								      <?php
								      	$posts_per_page=30;
										$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

										if(trim( $_GET['search'])):										

											$args = array(
												'posts_per_page' => $posts_per_page,
												'post_type' => 'blood_bank',
												'paged' => $paged,
												'post_status' => 'publish',
												'orderby'=> 'title', 
												'order' => 'ASC',												
												'meta_query'    => array(
												    'relation' => 'OR',
												    array(
												        'key'       => 'bloodb_name',
												        'value'     => urldecode( $_GET['search'] ),
												        'compare'   => 'LIKE',
												    ),
													array(
														'relation' => 'OR',
														array(
															'key'     => 'bloodb_address',
															'value'   => urldecode( $_GET['search'] ),
															'compare' => 'LIKE'
														)
													),	
													array(
														'relation' => 'OR',
														array(
															'key'     => 'bloodb_area',
															'value'   => urldecode( $_GET['search'] ),
															'compare' => 'LIKE'
														)
													),																									    
												)									

											);
										else:
											$args = array(
												'posts_per_page' => $posts_per_page,
												'post_type' => 'blood_bank',
												'paged' => $paged,
												'post_status' => 'publish',
												'orderby'=> 'title', 
												'order' => 'ASC',												
											);																																
										
										endif;


										if(trim( $_GET['search'])):										
					                        $cur_url=site_url('/blood-bank');
					                        echo "<a class='button bck_btn' href='".$cur_url."'> Back </a>";	
										endif;

										$wp_query = new WP_Query( $args );
										if ( $wp_query->have_posts() ) : ?>
											<table class="datatable">
												<thead>
													<tr>
														<th>Name</th>
														<th>Address</th>
														<th>Phone</th>
														<th>Area</th>
													</tr>
												</thead>
												<tbody>		

													<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
													<?php $post_id=get_the_ID(); ?>
													<tr>														
														<td><?php echo get_post_meta( $post_id, 'bloodb_name',true); ?></td>
														<td><?php echo get_post_meta( $post_id, 'bloodb_address',true);?></td>
														<td><?php echo get_post_meta( $post_id, 'bloodb_phone',true); ?></div></td>
														<td><?php echo get_post_meta( $post_id, 'bloodb_area',true); ?></td>
													</tr>					

											      	<?php endwhile; ?>
										      	</tbody>
										    </table>
										    <div class='pagination_custom'>
												<?php

													$big = 999999999; // need an unlikely integer
													echo paginate_links( array(
														'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
														'format' => '?paged=%#%',
														'current' => max( 1, get_query_var('paged') ),
														'total' => $wp_query->max_num_pages,
													    'prev_text'          => __( '<< Previous', 'twentyfifteen' ),
													    'next_text'          => __( 'Next >>', 'twentyfifteen' ),
													    'type' => 'list'													
													) );
												?>
											</div>
											
											
										<?php else: ?>
										
											<div class="column one search-not-found">
											
												<div class="snf-pic">
													<i class="themecolor <?php mfn_opts_show( 'error404-icon', 'icon-traffic-cone' ); ?>"></i>
												</div>
												
												<div class="snf-desc">
													<h2><?php echo $translate['search-title']; ?></h2>
													<h4><?php echo $translate['search-subtitle'] .' '. esc_html( $_GET['search'] ); ?></h4>
												</div>	
															
											</div>	
											
										<?php endif; 							
								  		
									   	wp_reset_query();
									  	?>		    


								</div>
