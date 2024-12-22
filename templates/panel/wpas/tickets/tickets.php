<?php if ( WUPPTools::wupp_is_awesome_Support_activated() ): ?>
	<?php if ( isset( $_GET['page'] ) && $_GET['page'] == 'my-tickets' ): ?>
        <?php global $post;?>
        <?php $page = get_page_by_path(WUPPPages::get_login_page_path())?>
        <?php $post = get_post($page->ID);?>
        <?php echo do_shortcode('[ticket-submit]')?>
	<?php else: ?>
		<?php wpas_sc_client_account() ?>
		<?php global $wpas_tickets;
		if ( $wpas_tickets->have_posts() ):
			$columns = wpas_get_tickets_list_columns();

			$tickets_per_page = wpas_get_option( 'tickets_per_page_front_end' );
			if ( empty( $tickets_per_page ) ) {
				$tickets_per_page = 5;
			}

			?>
            <div class="wpas wpas-ticket-list">

				<?php wpas_get_template( 'partials/ticket-navigation' ); ?>

                <h2 class="mt-5 h5"><?php echo __( 'Tickets list', 'user-panel-pro' ); ?></h2>
                <div class="card bg-white mt-3">
                    <table id="wpas_ticketlist" class="table table-hover text-center mb-0"
                           data-filter="#wpas_filter"
                           data-filter-text-only="true" data-page-navigation=".wpas_table_pagination"
                           data-page-size=" <?php echo $tickets_per_page ?> ">
                        <thead>
                        <tr>
							<?php foreach ( $columns as $column_id => $column ) {

								$data_attributes = '';

								// Add the data attributes if any
								if ( isset( $column['column_attributes']['head'] ) && is_array( $column['column_attributes']['head'] ) ) {
									$data_attributes = wpas_array_to_data_attributes( $column['column_attributes']['head'] );
								}

								printf( '<th id="wpas-ticket-%1$s" %3$s>%2$s</th>', $column_id, $column['title'], $data_attributes );

							} ?>
                        </tr>
                        </thead>
                        <tbody>
						<?php
						while ( $wpas_tickets->have_posts() ):

							$wpas_tickets->the_post();

							echo '<tr class="wpas-status-' . wpas_get_ticket_status( $wpas_tickets->post->ID ) . '" id="wpas_ticket_' . $wpas_tickets->post->ID . '">';

							foreach ( $columns as $column_id => $column ) {

								$data_attributes = '';

								// Add the data attributes if any
								if ( isset( $column['column_attributes']['body'] ) && is_array( $column['column_attributes']['body'] ) ) {
									$data_attributes = wpas_array_to_data_attributes( $column['column_attributes']['body'], true );
								}

								printf( '<td %s>', $data_attributes );

								/* Display the content for this column */
								wpas_get_tickets_list_column_content( $column_id, $column );

								echo '</td>';

							}

							echo '</tr>';

						endwhile;

						wp_reset_query(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
		<?php else: ?>
			<?php echo wpas_get_notification_markup( 'info', sprintf( __( 'You haven\'t submitted a ticket yet. <a href="%s">Click here to submit your first ticket</a>.', 'awesome-support' ), wpas_get_submission_page_url() ) ); ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>
