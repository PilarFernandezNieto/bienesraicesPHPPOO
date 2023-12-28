<?php
require 'includes/funciones.php';
incluirTemplate("header");
?>
<main class="contenedor seccion">
    <h1>Conoce sobre nosotros</h1>
    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img src="build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
            </picture>
        </div>
        <div class="texto-nosotros">
            <blockquote cite="">
                25 Años de Experiencia
            </blockquote>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore maiores ab quo quas eum
                laboriosam accusamus magni non veniam cum molestiae totam, eaque cumque officiis quae corporis et
                vero, autem commodi blanditiis enim voluptas quod? Veritatis voluptatem laborum nihil officia,
                inventore aliquid maiores quam harum iusto quasi non vitae rerum adipisci quae, at dolorum, tempora
                deserunt? Numquam natus ullam pariatur atque. Incidunt consectetur minima assumenda quasi in soluta
                sit nemo asperiores magni debitis ut et similique eveniet officia exercitationem velit repudiandae
                architecto.</p>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sed id dicta quas numquam, quam sunt
                consequuntur rem, reprehenderit atque, distinctio magnam doloribus pariatur! Quo aliquam excepturi
                error recusandae quis repellendus corporis dolores veniam inventore repellat. Aperiam ducimus
                tempore laborum omnis veritatis quo, tenetur aspernatur, repudiandae neque ea iste recusandae non
                architecto esse!.</p>
        </div>
    </div>
</main>
<section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa beatae eos amet tempore sit. Ad,
                commodi laudantium impedit officia voluptatem, expedita obcaecati repellendus culpa iure
                reprehenderit nobis possimus molestiae quis.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa beatae eos amet tempore sit. Ad,
                commodi laudantium
                impedit officia voluptatem, expedita obcaecati repellendus culpa iure reprehenderit nobis possimus
                molestiae
                quis.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
            <h3>A tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa beatae eos amet tempore sit. Ad,
                commodi laudantium
                impedit officia voluptatem, expedita obcaecati repellendus culpa iure reprehenderit nobis possimus
                molestiae
                quis.</p>
        </div>
    </div>
</section>
<?php
incluirTemplate("footer");
?>