<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>
<article id="contact">
    <div id="banner">
        <img src="/images/contactanos.jpg" alt="Contactanos" />
    </div>
    <?php if( $bSent ): ?>
    <div class="success">Gracias tu correo ha sido recibido!</div>
    <?php endif; ?>
    <div class="clearfix master-row-one">
        <div class="master-column-one">
            <dl>
                <dt>Dirección</dt>
                <dd>Periferico sur esquina boulevard las lomas,<br /> Colonia las lomas (Frente a gasolinera Perisur),<br /> Hermosillo, Sonora Mexico</dd>
                <dt>Teléfono</dt>
                <dd>662 250 18 18</dd>
                <dt>Email</dt>
                <dd>ventas@derechatrucks.com</dd>
            </dl>
        </div>
        <div class="master-column-two">
            <?php echo form_open( 'contacto', array( 'id' => 'contact-form' ) ) . "\n"; ?>
                <div class="clearfix slave-row-one">
                    <div class="form-item slave-column-one">
                        <?php echo form_label( 'Nombre', 'name' ) . "\n"; ?>
                        <?php echo form_input( array( 'name' => 'name', 'value' => ! $bSent ? set_value( 'name' ) : '', 'class' => 'form-text', 'id' => 'name' ) ) . "\n"; ?>
                        <?php echo form_error( 'name' ) . "\n"; ?>
                    </div>
                    <div class="form-item slave-column-two">
                        <?php echo form_label( 'Teléfono', 'telephone' ) . "\n"; ?>
                        <?php echo form_input( array( 'name' => 'telephone', 'value' => ! $bSent ? set_value( 'telephone' ) : '', 'class' => 'form-text', 'id' => 'telephone' ) ) . "\n"; ?>
                        <?php echo form_error( 'telephone' ) . "\n"; ?>
                    </div>
                    <div class="form-item slave-column-three">
                        <?php echo form_label( 'Email', 'email' ) . "\n"; ?>
                        <?php echo form_input( array( 'name' => 'email', 'value' => ! $bSent ? set_value( 'email' ) : '', 'class' => 'form-text', 'id' => 'email' ) ) . "\n"; ?>
                        <?php echo form_error( 'email' ) . "\n"; ?>
                    </div>
                </div>
                <div class="slave-row-two">
                    <div class="form-item">
                        <?php echo form_label( 'Comentarios', 'comments' ) . "\n"; ?>
                        <?php echo form_textarea( array( 'name' => 'comments', 'value' => ! $bSent ? set_value( 'comments' ) : '', 'class' => 'form-textarea', 'id' => 'comments' ) ) . "\n"; ?>
                        <?php echo form_error( 'comments' ) . "\n"; ?>
                    </div>
                </div>
                <div class="slave-row-three">
                    <div class="form-item">
                        <?php echo form_button( array( 'type' => 'submit', 'class' => 'form-submit', 'content' => 'Enviar mensaje' ) ) . "\n"; ?>
                    </div>
                </div>
            <?php echo form_close() . "\n"; ?>
        </div>
    </div>
</article>
<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>