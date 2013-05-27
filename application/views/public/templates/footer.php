            </section><!--#/main-content-->
        </div><!--#/wrapper-->
        <footer id="main-footer">
            <div class="wrapper">
                <div class="master-row-one">
                    <ul class="clearfix">
                        <li class="first"><a href="/">INICIO</a></li>
                        <li><a href="/quienes-somos">QUIENES SOMOS</a></li>
                        <li><a href="/contacto">CONTACTO</a></li>
                    </ul>
                </div>
                <div class="master-row-two">
                    <p>© <?php echo date( 'Y' ); ?> Derecha Trucks</p>
                </div>
                <div class="master-row-three">
                    <ul class="clearfix">
                        <li class="first"><a href="https://twitter.com/derechatrucks" target="_blank">Twitter</a></li>
                        <li><a href="https://www.youtube.com/user/derechatrucks" target="_blank">YouTube</a></li>
                        <li><a href="https://www.facebook.com/derechat" target="_blank">Facebook</a></li>
                    </ul>
                </div>
                <div class="branding master-row-four">
                    <a href="/">Derecha trucks</a>
                </div>
            </div>
        </footer><!--#/main-footer-->
        <?php if( defined( 'FRONTPAGE' ) ): ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="/js/vendor/jquery.nivo.slider.pack.js"></script>
        <script>$( window ).load(function() { $('#slider').nivoSlider( { directionNav: false } ); });</script>
        <?php endif; ?>
    </body>
</html>
