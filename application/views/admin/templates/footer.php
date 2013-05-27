                <div class="row-fluid">
                    <div id="footer" class="span12">
                        <?php echo date( 'Y' ); ?> &copy; Derecha Trucks
                    </div>
                </div>
            </div>
        </div><!--#content-->
        <?php if( ( isset( $arJS ) ) && sizeof( $arJS ) ): ?>
            <?php foreach( $arJS as $k => $v ): ?>
                <?php if( file_exists( FCPATH . 'js/admin/' . $v . '.js'  ) ): ?>
                    <script src="/js/admin/<?php echo $v; ?>.js"></script>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>