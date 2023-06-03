<section class="contact animate__animated animate__slideInUp">
    <div class="contact-item wow slideInRight  animate__animated animate__fadeInTopLeft animate__delay-2s">
        <img src="<?php bloginfo('template_directory') ?>/images/contact-phone.png" alt="" />
        <div class="item-right">
            <p class="name">Liên hệ</p>
            <p class="content">
                <?php echo esc_html(get_field('lien_he', 'option')); ?>
            </p>
        </div>
    </div>
    <div class="contact-item wow slideInRight  animate__animated animate__delay-2s animate__slideInDown">
        <img src="<?php bloginfo('template_directory') ?>/images/contact-email.png" alt="" />
        <div class="item-right">
            <p class="name">Email</p>
            <p class="content">
                <?php echo esc_html(get_field('email_contact', 'option')); ?>

            </p>
        </div>
    </div>
    <div class="contact-item wow slideInRight  animate__animated animate__delay-2s animate__fadeInTopRight">
        <img src="<?php bloginfo('template_directory') ?>/images/contact-address.png" alt="" />
        <div class="item-right">
            <p class="name">Địa chỉ</p>
            <p class="content">
                <?php echo esc_html(get_field('diachi', 'option')); ?>
            </p>
        </div>
    </div>
</section>