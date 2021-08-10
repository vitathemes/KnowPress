<?php global $post; ?>

<div class="c-feedback s-feedback">
    <div class="wedocs-feedback-wrap wedocs-hide-print">
        <?php /* translators: Modified date */ ?>
        <time itemprop="dateModified" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php printf( esc_html__( 'Updated on %s', 'knowpress' ), esc_html(get_the_modified_date()) ); ?></time>
        <div class="c-feedback__main">
			<?php
			$positive = (int) get_post_meta( $post->ID, 'positive', true );
			$negative = (int) get_post_meta( $post->ID, 'negative', true );
			/* translators: Number of persons who found this article useful */
			$positive_title = $positive ? sprintf( _n( '%d person found this useful',
				'%d persons found this useful',
				$positive,
				'knowpress' ),
				number_format_i18n( $positive ) ) : __( 'No votes yet', 'knowpress' );
			/* translators: Number of persons who found this article not useful */
			$negative_title = $negative ? sprintf( _n( '%d person found this not useful',
				'%d persons found this not useful',
				$negative,
				'knowpress' ),
				number_format_i18n( $negative ) ) : __( 'No votes yet', 'knowpress' );
			?>

			<p><?php esc_html_e( 'Was this article helpful to you?', 'knowpress' ); ?></p>

            <span class="vote-link-wrap">
        <a href="#" class="wedocs-tip positive" data-id="<?php the_ID(); ?>" data-type="positive" title="<?php echo esc_attr( $positive_title ); ?>">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="shape" d="M16 28C22.6274 28 28 22.6274 28 16C28 9.37258 22.6274 4 16 4C9.37258 4 4 9.37258 4 16C4 22.6274 9.37258 28 16 28Z" stroke="#4D5A66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="shape" d="M21.1973 18.9995C20.6701 19.9113 19.9124 20.6683 19.0001 21.1947C18.0879 21.721 17.0532 21.9981 16 21.9981C14.9468 21.9981 13.9122 21.721 12.9999 21.1947C12.0876 20.6684 11.3299 19.9114 10.8027 18.9996" stroke="#4D5A66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="eye" d="M11.5 15C12.3284 15 13 14.3284 13 13.5C13 12.6716 12.3284 12 11.5 12C10.6716 12 10 12.6716 10 13.5C10 14.3284 10.6716 15 11.5 15Z" fill="#4D5A66"/>
                <path class="eye" d="M20.5 15C21.3284 15 22 14.3284 22 13.5C22 12.6716 21.3284 12 20.5 12C19.6716 12 19 12.6716 19 13.5C19 14.3284 19.6716 15 20.5 15Z" fill="#4D5A66"/>
            </svg>
            	        <?php if ( $positive ) { ?>
                            <span class="count"><?php echo esc_html( number_format_i18n( $positive ) ); ?></span>
	                    <?php } ?>
        </a>
        <a href="#" class="wedocs-tip negative" data-id="<?php the_ID(); ?>" data-type="negative" title="<?php echo esc_attr( $negative_title ); ?>">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="shape" d="M16 28C22.6274 28 28 22.6274 28 16C28 9.37258 22.6274 4 16 4C9.37258 4 4 9.37258 4 16C4 22.6274 9.37258 28 16 28Z" stroke="#4D5A66" stroke-width="2" stroke-miterlimit="10"/>
                <path class="shape" d="M21.1973 22C20.6701 21.0883 19.9124 20.3312 19.0002 19.8049C18.0879 19.2786 17.0533 19.0015 16.0001 19.0015C14.9469 19.0015 13.9122 19.2785 12.9999 19.8048C12.0877 20.3311 11.3299 21.0882 10.8028 21.9999" stroke="#4D5A66" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path class="eye" d="M11.5 15C12.3284 15 13 14.3284 13 13.5C13 12.6716 12.3284 12 11.5 12C10.6716 12 10 12.6716 10 13.5C10 14.3284 10.6716 15 11.5 15Z" fill="#4D5A66"/>
                <path class="eye" d="M20.5 15C21.3284 15 22 14.3284 22 13.5C22 12.6716 21.3284 12 20.5 12C19.6716 12 19 12.6716 19 13.5C19 14.3284 19.6716 15 20.5 15Z" fill="#4D5A66"/>
                <path class="eye" d="M11.5 15C12.3284 15 13 14.3284 13 13.5C13 12.6716 12.3284 12 11.5 12C10.6716 12 10 12.6716 10 13.5C10 14.3284 10.6716 15 11.5 15Z" fill="#4D5A66"/>
                <path class="eye" d="M20.5 15C21.3284 15 22 14.3284 22 13.5C22 12.6716 21.3284 12 20.5 12C19.6716 12 19 12.6716 19 13.5C19 14.3284 19.6716 15 20.5 15Z" fill="#4D5A66"/>
            </svg>
            	        <?php if ( $negative ) { ?>
                            <span class="count"><?php echo esc_html( number_format_i18n( $negative ) ); ?></span>
	                    <?php } ?>
        </a>
    </span>
        </div>
    </div>
</div>
