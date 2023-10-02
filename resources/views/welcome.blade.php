<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistematic Cutex</title>
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Open+Sans:wght@300;400;700&family=Roboto:ital,wght@1,900&family=Square+Peg&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Open+Sans:wght@300;400;700&family=Roboto:ital,wght@1,900&family=Square+Peg&display=swap" rel="stylesheet" />
</head>

<body>
  <header>
    <nav>
      <a href="#Nosotros">Nosotros</a>
      <a href="#Contacto">Contáctanos</a>
      <a href="{{ route('login') }}">Iniciar sesión</a>
    </nav>
    <section class="textos-header">
      <h1>Somos creadores de los mejores articulos en cuero</h1>
    </section>
    <div class="wave" style="height: 150px; overflow: hidden">
      <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%">
        <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff"></path>
      </svg>
    </div>
  </header>
  <main>
    <div class="nosotros">
      <h1 class="texto-nosotros">Bienvenidos a Peleteria Cueros y Color </h1>
      <h1 class="texto-nosotros">Somos lujo Colombiano</h1>
      <div class="tarjetas">
        <div class="tarjeta">
          <div class="contenedor-tarjeta">
            <h4>Misión</h4>
            <p>
              Ser la referencia global en la creación de productos en cuero, fusionando tradición e innovación para inspirar el estilo de vida sofisticado y auténtico de nuestros clientes.
            </p>
          </div>
        </div>
        <div id="Nosotros" class="tarjeta">
          <div class="contenedor-tarjeta">
            <h4>Visión</h4>
            <p>
              "Nuestra misión es articular la elegancia y durabilidad del cuero en productos excepcionales, comprometiéndonos a ofrecer calidad insuperable, diseños vanguardistas y satisfacción total a nuestros clientes, respaldados por un enfoque constante en la excelencia artesanal y la innovación continua.
            </p>
          </div>
        </div>
      </div>
      <br />
      <br />
      <br />
      <br />
      <br />
      <div class="tarjetas">
        <div class="tarjeta">
          <div class="contenedor-tarjeta">
            <h4>Calidad</h4>
            <p>
              Nos comprometemos a garantizar la excelencia en cada detalle, seleccionando los mejores materiales y aplicando una artesanía meticulosa para ofrecer productos en cuero que perduren en el tiempo, reflejando nuestra búsqueda inquebrantable de la máxima calidad y satisfacción del cliente.
            </p>
          </div>
        </div>
        <div class="tarjeta">
          <div class="contenedor-tarjeta">
            <h4>Puntualidad</h4>
            <p>
              Nuestra puntualidad es un valor fundamental; nos esforzamos por cumplir con los plazos de entrega de manera precisa y confiable, asegurando que nuestros clientes disfruten de sus productos en cuero a tiempo, reflejando nuestro compromiso con la confianza y satisfacción del cliente.
            </p>
          </div>
        </div>
        <div class="tarjeta">
          <div class="contenedor-tarjeta">
            <h4>Innovación</h4>
            <p>
              Abrazamos la innovación como motor de nuestro progreso, fusionando la rica tradición del cuero con soluciones vanguardistas. A través de la investigación constante y el diseño creativo, llevamos la innovación al corazón de nuestros productos en cuero, para superar las expectativas de nuestros clientes y liderar la evolución de la industria.
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <br />
  <br />
  <br />
  <br />
  <br />
  <footer>
    <div id="Contacto"class="contenedor-footer">
      <div class="contenedor-foot">
        <h4>Email:</h4>
        <p>peleteria@gmail.com</p>
      </div>
      <div class="contenedor-foot">
        <h4>Cel:</h4>
        <p>3134528956</p>
      </div>
      <div class="contenedor-foot">
        <h4>Dirección:</h4>
        <p>Calle 12 # 23-34 Restrepo, Bogota D.C</p>
      </div>
    </div>
    <h2 class="titulo-final">&copy; Sistematic Cutex</h2>
  </footer>
</body>

</html>