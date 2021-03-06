<?php include ('element/navbar.php'); ?>


<script src="/language/faq-en.js"></script>
<div class="main-container view-faq">
    <section v-cloak id="faq-container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8">
                    <ul class="results-list text-justify">
                        <template v-for="cat in faq.CATEGORIES">

                            <li v-for="q in faq.QUESTIONS[cat]">
                                <h4 v-bind:id="toPermalink(q)">{{ q }}</h4>

                                <template v-for="r in faq.RESPONSES[cat][q]">
                                    <p v-if="linkfy(r)" v-html="linkfy(r)"></p>
                                    <p v-else>
                                        {{ r }}
                                    </p>
                                </template>

                            </li>

                        </template>

<!--                        <li>
                            <h4>¿Cómo funciona?</h4>
                            <p>Creary es la primera aplicación que funciona sobre la blockchain de Crea. En Creary cualquiera puede publicar contenidos digitales y ser recompensado por su trabajo creativo según los votos recibidos por parte de la comunidad.</p>
                            <p>Los usuarios son recompensados con criptomonedas llamadas CREA.<p>
                            <p>De manera continua la blockchain de Crea acuña nuevas monedas que se distribuyen entre todos los participantes. Esto es posible gracias a Proof of Creation, un tipo de algoritmo que emite recompensas en forma de tokens para recompensar el trabajo de creación y curación de contenidos de la plataforma.  Los usuarios que tengan más monedas CREA y que estas estén convertidas en CREA Energy, decidirán dónde se distribuye una mayor parte de las recompensas emitidas por la blockchain. </p>
                            <p>Los usuarios pueden comprar y vender trabajos creativos de cualquier formato multimedia usando CREA.</p>
                            <p>Estos intercambios suceden forma instantánea en una red distribuida sin intermediarios donde los usuarios pueden conectar directamente y evitar tasas o comisiones que encarecen el trabajo creativo de los autores.</p>
                            <p>Creary emite certificados de derechos de autor y licencia de distribución sobre cualquier trabajo digital que se publique. La inmutabilidad de la blockchain permite que cualquier dato que se registre en ella sea prácticamente imposible de manipular o borrar. Esto otorga un poder notarial sobre todo lo que se publica en la red de Crea sin necesidad de una autoridad central.</p>
                        </li>
                        <li>
                            <h4>¿ Por qué Creary es distinto a otras redes sociales convencionales ?</h4>
                            <p>En internet, la mayoría de las red sociales convencionales son centralizadas, esto quiere decir que unos pocos participan del control de la red social, de los contenidos y de la economía. En muchos casos el negocio consiste en vender los datos de los usuarios a terceros que ofrecen publicidad. Sólo unos pocos son accionistas.</p>
                            <p>En Creary creemos que el poder y los beneficios se deberían de diluir entre todos los usuarios que aportan valor a la red. El 100% de los tokens emitidos por la red se distribuyen entre los usuarios de la misma. El sistema de distribución de recompensas está gobernado por la propia comunidad y cualquier usuario puede votar libremente y a tiempo real sobre cómo quiere que evolucione la red de Crea.</p>
                        </li>-->
                    </ul>
                </div>
                <div class="col-md-pull-8 col-md-4">
                    <div class="boxed boxed--border boxed--lg bg--secondary">
                        <div class="sidebar__widget">
                            <template v-for="cat in faq.CATEGORIES">
                                <h5>{{ cat }}</h5>

                                <ul>
                                    <li v-for="q in faq.QUESTIONS[cat]">
                                        <a v-bind:href="'#' + toPermalink(q)">{{ q }}</a>
                                    </li>
                                </ul>

                            </template>


<!--                            <h5>Cuentas</h5>
                            <ul>
                                <li><a href="#">¿Cómo creo una cuenta?</a></li>
                                <li><a href="#">¿Por qué tengo que proporcionar mi correo electrónico?</a></li>
                                <li><a href="#">¿Puedo crear una cuenta de Crea sin un correo electrónico?</a></li>
                                <li><a href="">¿Qué sucede si mi correo electrónico cambia?</a></li>
                                <li><a href="">¿Puedo cambiar mi nombre de usuario?</a></li>
                                <li><a href="">¿Puedo eliminar o desactivar mi cuenta?</a></li>
                            </ul>-->

                        </div>
                    </div>
                </div>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <script src="/js/common/faq.js"></script>
    <?php include ('element/footer.php'); ?>
