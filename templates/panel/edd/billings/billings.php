<?php $keys = []; ?>
    <div class="row edd">
        <div class="col-12 card p-0">
			<?php if ( ! empty( $_GET['edd-verify-success'] ) ) : ?>
                <p class="edd-account-verified edd_success">
					<?php _e( 'purchase history', 'easy-digital-downloads' ); ?>
                </p>
			<?php endif; ?>

			<?php if ( is_user_logged_in() ):
				$payments = edd_get_users_purchases( get_current_user_id(), 50, true, 'any' );
				if ( $payments ) :
					do_action( 'edd_before_purchase_history', $payments ); ?>
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead>
                        <tr>
							<?php do_action( 'edd_purchase_history_header_before' ); ?>
                            <th scope="row"><?php _e( 'ID', 'easy-digital-downloads' ); ?></th>
                            <th scope="row"><?php _e( 'Date', 'easy-digital-downloads' ); ?></th>
                            <th scope="row"><?php _e( 'Amount', 'easy-digital-downloads' ); ?></th>
                            <th scope="row"><?php _e( 'Details', 'easy-digital-downloads' ); ?></th>
							<?php do_action( 'edd_purchase_history_header_after' ); ?>
                        </tr>
                        </thead>
						<?php foreach ( $payments as $payment ) : ?>
							<?php $payment = new EDD_Payment( $payment->ID ); ?>
                            <tr>
								<?php do_action( 'edd_purchase_history_row_start', $payment->ID, $payment->payment_meta ); ?>
                                <td>#<?php echo $payment->number ?></td>
                                <td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $payment->date ) ); ?></td>
                                <td>
                                    <span class="edd_purchase_amount"><?php echo edd_currency_filter( edd_format_amount( $payment->total ) ); ?></span>
                                </td>
                                <td>
									<?php if ( $payment->status != 'publish' ) : ?>
                                        <span class="edd_purchase_status <?php echo $payment->status; ?>"><?php echo $payment->status_nicename; ?></span>
										<?php if ( $payment->is_recoverable() ) : ?>
                                            &mdash; <a class="btn btn-sm btn-primary"
                                                       href="<?php echo $payment->get_recovery_url(); ?>"><?php _e( 'Complete Purchase', 'easy-digital-downloads' ); ?></a>
										<?php endif; ?>
									<?php else: ?>
										<?php $keys[] = $payment->key; ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_<?php echo $payment->key; ?>">
                                            <?php _e( 'View Details and Downloads', 'easy-digital-downloads' ); ?>
                                        </button>
									<?php endif; ?>
                                </td>
								<?php do_action( 'edd_purchase_history_row_end', $payment->ID, $payment->payment_meta ); ?>
                            </tr>
						<?php endforeach; ?>
                    </table>
                </div>
					<?php
					echo edd_pagination(
						array(
							'type'  => 'purchase_history',
							'total' => ceil( edd_count_purchases_of_customer() / 20 ) // 20 items per page
						)
					);
					?>
					<?php do_action( 'edd_after_purchase_history', $payments ); ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
                    <p class="edd-no-purchases p-3"><?php _e( 'You have not made any purchases', 'easy-digital-downloads' ); ?></p>
				<?php endif;
			endif; ?>

        </div>
    </div>
<?php add_action( 'after_view_edd_bought_history', function () { ?>
	<?php if ( is_user_logged_in() ): ?>
		<?php $payments = edd_get_users_purchases( get_current_user_id(), 50, true, 'any' ); ?>
		<?php if ( $payments ) : ?>
			<?php foreach ( $payments as $payment ) : ?>
				<?php $payment = new EDD_Payment( $payment->ID ); ?>
				<?php $ID = $payment->ID; ?>
				<?php $payment_key = $payment->key; ?>
                <?php include WUPP_TPL . 'panel/edd/billings/details.php' ?>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
<?php } ); ?>