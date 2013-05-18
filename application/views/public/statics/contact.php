<?php require_once FCPATH . 'application/views/public/templates/header.php'; ?>

<section>
    <article>
        <h1>Contacto</h1>
        <?php if( $bSent ): ?>
        <div class="success">Gracias tu correo ha sido recibido!</div>
        <?php endif; ?>
        <h2>Direcci&oacute;n</h2>
        <p>Periferico sur esquina boulevard las lomas, colonia las lomas ( Frente a gasolinera Perisur ), Hermosillo, Sonora Mexico</p>
        <h2>Tel&eacute;fono</h2>
        <p>662 250 18 18</p>
        <h2>Email</h2>
        <p>ventas@derechatrucks.com</p>
        <?php echo form_open( 'contacto', array( 'id' => 'contact-form' ) ) . "\n"; ?>        
            <div class="form-item">
                <?php echo form_label( 'Nombre', 'name' ) . "\n"; ?>
                <?php echo form_input( array( 'name' => 'name', 'value' => ! $bSent ? set_value( 'name' ) : '', 'class' => 'form-text', 'id' => 'name' ) ) . "\n"; ?>
                <?php echo form_error( 'name' ) . "\n"; ?>
            </div>
            <div class="form-item">
                <?php echo form_label( 'Tel&eacute;fono', 'telephone' ) . "\n"; ?>
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
                <?php echo form_button( array( 'type' => 'submit', 'class' => 'form-button', 'content' => 'Enviar mensaje' ) ) . "\n"; ?>
            </div>
        <?php echo form_close() . "\n"; ?>
    </article>
</section>

<?php require_once FCPATH . 'application/views/public/templates/footer.php'; ?>