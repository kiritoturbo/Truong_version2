<section class="contact">
    <div class="contact-item">
        <img src="<?php bloginfo('template_directory') ?>/images/contact-phone.png" alt="" />
        <div class="item-right">
            <p class="name">Liên hệ</p>
            <p class="content">
                <?php echo esc_html(get_field('lien_he', 'option')); ?>
            </p>
        </div>
    </div>
    <div class="contact-item">
        <img src="<?php bloginfo('template_directory') ?>/images/contact-email.png" alt="" />
        <div class="item-right">
            <p class="name">Email</p>
            <p class="content">
                <?php echo esc_html(get_field('email_contact', 'option')); ?>

            </p>
        </div>
    </div>
    <div class="contact-item">
        <img src="<?php bloginfo('template_directory') ?>/images/contact-address.png" alt="" />
        <div class="item-right">
            <p class="name">Địa chỉ</p>
            <p class="content">
                <?php echo esc_html(get_field('diachi','option')); ?>
            </p>
        </div>
    </div>
</section>