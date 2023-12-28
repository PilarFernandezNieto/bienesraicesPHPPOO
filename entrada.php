<?php
require 'includes/funciones.php';
incluirTemplate("header");
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Guía para la decoración de tu hogar</h1>

    <picture>
        <source srcset="build/img/destacada2.webp" type="image/webp">
        <source srcset="build/img/destacada2.jpg" type="image/jpeg">
        <img src="build/img/destacada2.jpg" alt="imagen de la propiedad" loading="lazy">
    </picture>
    <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
    <div class="resumen-propiedad">
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil, tempore ex fuga voluptas sunt,
            distinctio necessitatibus ab nostrum reprehenderit delectus incidunt cupiditate autem a totam quaerat?
            Laboriosam dolore nostrum modi nisi? Modi eum earum blanditiis, placeat, repellendus soluta dignissimos
            ea cupiditate molestiae accusantium nihil iste odio magni amet iusto commodi obcaecati illum nostrum
            possimus illo, eligendi autem! Voluptas ratione eos quo! Id esse tenetur labore voluptas ea
            exercitationem dolorem, architecto quos, vel cupiditate nam ut. Deleniti, quod earum labore eaque magni
            illum deserunt dolores. Iste aspernatur error possimus commodi. Quo officiis neque odio aperiam itaque
            cum animi iure corrupti voluptate!</p>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda eligendi consectetur, omnis aperiam
            quasi inventore repudiandae tempore necessitatibus iusto voluptatem veniam optio totam minus molestias
            accusantium. Fugiat qui nesciunt, earum porro doloribus excepturi repellendus harum a fugit deserunt
            odio quos amet sapiente esse praesentium corrupti autem accusantium voluptates explicabo distinctio.</p>
    </div>
</main>
<?php
incluirTemplate("footer");
?>