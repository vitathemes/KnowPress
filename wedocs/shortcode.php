<?php if ( $docs ) { ?>

<div class="wedocs-shortcode-wrap c-docs-grid">
    <ul class="wedocs-docs-list col-<?php echo esc_attr($col); ?>">

        <?php foreach ( $docs as $main_doc ) { ?>
            <li class="wedocs-docs-single c-card">
                <h2 class="c-card__title"><?php echo esc_html($main_doc['doc']->post_title); ?></h2>
                <a class="c-card__link" href="<?php echo esc_url(get_permalink( $main_doc['doc']->ID )); ?>" aria-label="<?php echo esc_attr($main_doc['doc']->post_title); ?>"></a>
	            <?php if ( $main_doc['doc']->post_content != "" ) { ?>

                    <div class="c-card__main s-card-main">
			            <p><?php echo esc_html($main_doc['doc']->post_content); ?></p>
                    </div>

	            <?php } else if ( $main_doc['sections'] ) { ?>
                    <div class="c-card__main c-card__main--has-link s-card-main">
                        <ul class="c-card__list wedocs-doc-sections">
                            <?php foreach ( $main_doc['sections'] as $section ) { ?>
                                <li><a href="<?php echo esc_url(get_permalink( $section->ID )); ?>"><?php echo esc_html($section->post_title); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <div class="c-card__footer">
                    <span class="c-card__count"><?php echo count($main_doc['sections']). ' ' . esc_html__('Articles', 'knowpress'); ?></span>
                    <span class="c-card__icon"><svg class="c-card__arrow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1.75em" height="1.75em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 256 256"><path d="M138.343 205.657a8.002 8.002 0 0 1 0-11.314L196.687 136H40a8 8 0 0 1 0-16h156.687l-58.344-58.343a8 8 0 1 1 11.314-11.314l72 72c.026.026.048.055.073.081c.158.162.312.329.456.504c.08.097.15.2.225.301c.08.109.165.215.24.328c.079.116.146.237.218.357c.062.105.128.207.185.315c.065.12.12.244.177.366c.054.114.111.227.16.343c.048.119.088.24.131.36c.045.126.094.25.133.38c.036.12.063.241.093.362c.033.132.07.263.097.397c.028.14.044.28.064.42c.017.119.04.234.051.353a8.052 8.052 0 0 1 0 1.58c-.012.119-.034.234-.05.353c-.02.14-.037.28-.065.42c-.027.134-.064.265-.097.397c-.03.121-.057.243-.093.362c-.04.13-.088.254-.133.38c-.043.12-.083.241-.131.36c-.049.116-.106.229-.16.343c-.058.122-.112.246-.177.366c-.057.108-.123.21-.185.315c-.072.12-.14.24-.217.357c-.076.113-.16.22-.241.328c-.075.1-.145.204-.225.301a8.01 8.01 0 0 1-.464.513c-.023.023-.042.049-.065.072l-72 72a8 8 0 0 1-11.314 0z" /></svg></span>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>

<?php }
