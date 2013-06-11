<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>
<article id="contact">
    <div class="master-row-one">
        <img src="/images/contactanos.jpg" alt="Contactanos" />
    </div>
    <?php if( $bSent ): ?>
    <div class="success">Gracias tu correo ha sido recibido!</div>
    <?php endif; ?>
    <div class="master-row-two">
        <h2>Dirección</h2>
        <p>Periferico Sur No. 22 Esquina Paseo las Lomas</p>
        <p>Colonia Las Lomas</p>
        <p>C.P. 83293</p>
        <p>Hermosillo, Sonora Mexico</p>
    </div>
    <div class="clearfix master-row-three">
        <div class="slave-column-one">
            <h2>Email</h2>
            <p>ventas@derechatrucks.com</p>
        </div>
        <div class="slave-column-two">
            <h2>Teléfono</h2>
            <p>662 250 18 18</p>
        </div>
    </div>
    <div class="clearfix master-row-four">
        <div class="slave-column-one">
            <?php echo form_open( 'contacto', array( 'id' => 'contact-form' ) ) . "\n"; ?>
                <div class="form-item">
                    <?php echo form_label( 'Nombre', 'name' ) . "\n"; ?>
                    <?php echo form_input( array( 'name' => 'name', 'value' => ! $bSent ? set_value( 'name' ) : '', 'class' => 'form-text', 'id' => 'name' ) ) . "\n"; ?>
                    <?php echo form_error( 'name' ) . "\n"; ?>
                </div>
                <div class="form-item">
                    <?php echo form_label( 'Teléfono', 'telephone' ) . "\n"; ?>
                    <?php echo form_input( array( 'name' => 'telephone', 'value' => ! $bSent ? set_value( 'telephone' ) : '', 'class' => 'form-text', 'id' => 'telephone' ) ) . "\n"; ?>
                    <?php echo form_error( 'telephone' ) . "\n"; ?>
                </div>
                <div class="form-item">
                    <?php echo form_label( 'Email', 'email' ) . "\n"; ?>
                    <?php echo form_input( array( 'name' => 'email', 'value' => ! $bSent ? set_value( 'email' ) : '', 'class' => 'form-text', 'id' => 'email' ) ) . "\n"; ?>
                    <?php echo form_error( 'email' ) . "\n"; ?>
                </div>
                <div class="form-item">
                    <?php echo form_label( 'Comentarios', 'comments' ) . "\n"; ?>
                    <?php echo form_textarea( array( 'name' => 'comments', 'value' => ! $bSent ? set_value( 'comments' ) : '', 'class' => 'form-textarea', 'id' => 'comments' ) ) . "\n"; ?>
                    <?php echo form_error( 'comments' ) . "\n"; ?>
                </div>
                <div class="form-item">
                    <?php echo form_button( array( 'type' => 'submit', 'class' => 'form-submit', 'content' => 'Enviar mensaje' ) ) . "\n"; ?>
                </div>
            <?php echo form_close() . "\n"; ?>
        </div>
        <div class="slave-column-two">
            <iframe width="578" height="418" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?saddr=29.034325,-110.945402&amp;hl=es&amp;sll=29.034311,-110.945338&amp;sspn=0.002983,0.005681&amp;mra=mift&amp;mrsp=0&amp;sz=18&amp;t=m&amp;ie=UTF8&amp;ll=29.034315,-110.945338&amp;spn=0.003921,0.006191&amp;z=17&amp;output=embed"></iframe>
        </div>
    </div>
</article>
<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>