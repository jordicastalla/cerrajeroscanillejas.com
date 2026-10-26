=== Cerrajeros Canillejas ===
Requires at least: 6.6
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.3.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Tema hijo de bloques (Full Site Editing) de Prime FSE para Cerrajeros Canillejas.

== Descripción ==

Portada en siete «diapositivas» verticales con estética industrial nocturna:

01 Portada con llamada directa (H1 local y botón tel:+34919932556)
02 Cambio Cerradura
03 Instalación de Cerrojos de Seguridad
04 Reparación de Cierres Metálicos
05 Quiénes Somos (incluye las preguntas frecuentes)
06 Últimas Entradas (bucle de consulta nativo)
07 Contacto

Todo se edita con bloques nativos de Gutenberg desde el Editor del sitio.
No necesita Getwid, Getwid Mega Menu ni ningún otro plugin.

El menú «Servicios» es un submenú nativo (bloque «Submenú») con enlaces a las
secciones 02, 03 y 04 de la portada. Se abre al pasar el ratón o con el botón
de flecha (teclado: Intro / Espacio; Escape lo cierra) y en móvil aparece
desplegado dentro del menú.

Efecto «rodar cilindro»: en pantallas de 900 px de ancho o más, al pasar de una
diapositiva a otra las secciones giran como las caras de un tambor. Lo calcula
assets/js/theme.js a partir de la posición del scroll (no intercepta la rueda, el
teclado ni el tacto) con APIs estándar que también tienen Firefox y Safari (probado
en Chromium). Una diapositiva en reposo queda plana. No se aplica en móvil, en el editor ni si el
sistema tiene activado «reducir movimiento» / «mostrar animaciones: no» (en ese
caso las secciones se desplazan de forma normal).

== Instalación ==

1. Instala y deja instalado (sin modificarlo) el tema padre Prime FSE:
   Apariencia → Temas → Añadir nuevo → buscar «Prime FSE», o subir prime-fse.1.1.2.zip.
2. Comprime la carpeta «cerrajeros-canillejas» en un .zip y súbela en
   Apariencia → Temas → Añadir nuevo → Subir tema. (También puedes copiarla en wp-content/themes/.)
3. Activa «Cerrajeros Canillejas». No actives Prime FSE: el hijo lo usa automáticamente.
4. Ajustes → Lectura: «Tu página de inicio muestra» → «Una página estática».
   Crea (si no existen) una página «Inicio» y una página «Blog»; asigna «Inicio» como portada
   y «Blog» como página de entradas. El blog tendrá así su propia URL (/blog/).
5. Ajustes → Generales: título «Cerrajeros Canillejas», idioma «Español».
6. (Opcional) Apariencia → Editor → Identidad del sitio: sube un icono del sitio si quieres
   sustituir el favicon incluido en el tema.

Prime FSE muestra un aviso para instalar Getwid y otros plugins mediante TGMPA. Este tema hijo
retira ese aviso porque no los necesita. Si algún día quieres usar los patrones del padre,
añade: add_filter( 'cerrajeros_canillejas_hide_parent_patterns', '__return_false' );

== Estructura ==

style.css            Cabecera del tema (Template: prime-fse). No contiene estilos.
theme.json          Paleta, tipografías, escalas de espaciado y estilos globales (versión 3).
functions.php       Carga de los módulos de inc/.
inc/business.php    Datos confirmados del negocio (teléfono, dirección, servicios). Fuente única.
inc/setup.php       Estilos de bloque, categoría de patrones, bloque de migas de pan, avisos.
inc/assets.php      Encola assets/css/theme.css y assets/js/theme.js, precarga fuentes, favicon.
inc/breadcrumbs.php Ruta de migas de pan (bloque visible y BreadcrumbList).
inc/block-enhancements.php  Microdatos FAQ, etiquetas ARIA de menús, tamaños de imágenes.
inc/seo.php         JSON-LD (Locksmith, Service, WebSite, WebPage, BreadcrumbList, BlogPosting)
                    y meta descripción cuando no hay plugin SEO.
templates/          front-page, home, index, archive, search, single, page, 404,
                    page-canvas y page-no-footer-space.
parts/              header, footer (contiene el crédito), simple-header, sidebar,
                    footer-2 y footer-no-space (estos dos reutilizan el pie principal).
patterns/           Las siete diapositivas y componentes reutilizables (categoría
                    «Cerrajeros Canillejas» del insertador).
blocks/breadcrumbs/ Bloque dinámico «Migas de pan».
assets/             CSS, JS, fuentes locales, dibujos técnicos SVG, logotipo e iconos.

== Cómo se editan los patrones ==

La plantilla de portada inserta cada diapositiva con un bloque «Patrón». Al abrirla en
Apariencia → Editor, WordPress convierte cada patrón en bloques normales (grupos, títulos,
párrafos, listas, botones, imágenes, bucle de consulta) que se editan directamente.
Al guardar, la plantilla editada se guarda en la base de datos; los archivos del tema no
cambian. «Restablecer» en el Editor del sitio vuelve a la versión del tema.

Las clases CSS de los bloques (por ejemplo «cc-slide», «cc-callslab») controlan la
composición. Se ven en Avanzado → Clases CSS adicionales; conviene no borrarlas.

== Preguntas frecuentes con microdatos ==

El patrón «Preguntas frecuentes» usa bloques nativos «Detalles». El grupo contenedor
lleva el estilo de bloque «FAQ (microdatos Schema.org)» y cada pregunta el estilo
«Pregunta frecuente». Al mostrar la página, el tema añade los atributos itemscope /
itemprop de FAQPage, Question y Answer al HTML visible, así que los microdatos siempre
coinciden con el texto que se ve. Para añadir una pregunta, duplica una existente.
Los microdatos no garantizan resultados enriquecidos en Google.

== Datos estructurados y plugins SEO ==

Sin plugin SEO, el tema imprime un único grafo JSON-LD por página y una meta descripción.
Si detecta Yoast SEO, Rank Math, All in One SEO, SEOPress, The SEO Framework, Slim SEO o
Squirrly, deja de imprimir WebSite/WebPage/BreadcrumbList/BlogPosting y la meta descripción,
y solo mantiene en la portada el nodo Locksmith con sus servicios. Filtros disponibles:

cerrajeros_canillejas_output_schema                  (false = sin JSON-LD del tema)
cerrajeros_canillejas_business_schema_with_seo_plugin (false = sin Locksmith si hay plugin SEO)
cerrajeros_canillejas_seo_plugin_active              (forzar la detección)
cerrajeros_canillejas_business                       (datos del negocio)
cerrajeros_canillejas_meta_description

No se publican horarios, coordenadas, código postal, precios ni valoraciones porque no
están confirmados. Sí están confirmados por el negocio la zona de servicio (Canillejas,
San Blas, Simancas, Hellín, Amposta, Arcos, Rosas, Rejas y El Salvador → areaServed) y el servicio de diario y de urgencia;
«urgencia» no implica disponibilidad 24 horas, así que no se publica.

== Blog y canibalización SEO ==

Reparto de intenciones de búsqueda:

* Portada (una sola URL): el negocio y sus tres servicios. Las secciones de servicio
  son anclas (#cambio-cerradura, #cerrojos-seguridad, #cierres-metalicos) de esa
  misma URL, así que no compiten entre sí.
* Blog: búsquedas informativas (cómo, por qué, qué elegir, mantenimiento).

Lo que hace el tema (solo si no hay un plugin SEO activo; con plugin, configúralo allí):

* noindex,follow en archivos de autor, de fecha y de etiqueta, que duplican el listado
  del blog, y los retira del sitemap de WordPress (wp-sitemap.xml).
  Filtros: cerrajeros_canillejas_noindex_archive, cerrajeros_canillejas_noindex_authors,
  cerrajeros_canillejas_noindex_tags.
* Canonical propio en el blog y en las categorías, también en sus páginas 2, 3…
* Meta descripción informativa para el blog, sin «cerrajeros en Canillejas».
* La banda del final de cada entrada no repite «cerrajero en Canillejas» ni la dirección:
  enlaza con texto exacto («Cambio de cerradura», «Instalación de cerrojos de seguridad»,
  «Reparación de cierres metálicos») a las secciones de la portada, que es la página que
  debe posicionar para esas búsquedas.

Pautas para quien escriba en el blog:

* No titules una entrada con la búsqueda comercial de la portada («Cerrajero en
  Canillejas», «Cambio de cerradura en Canillejas»). Mejor preguntas o guías:
  «¿Cuándo conviene cambiar el bombín?», «Cómo saber si un cierre metálico necesita
  revisión».
* No uses como nombre de categoría el nombre de un servicio («Cambio de cerradura»):
  la categoría competiría con la sección de la portada. Usa temas («Guías», «Seguridad
  en casa», «Locales y garajes»).
* En cada entrada, enlaza una vez al servicio relacionado de la portada con su nombre
  exacto.
* Si dos entradas responden a la misma pregunta, fusiónalas en una y redirige la otra.

== Créditos ==

Fuentes (SIL Open Font License 1.1, incluidas en assets/fonts con su licencia):
* Syne — The Syne Project Authors
* Instrument Sans — The Instrument Sans Project Authors
* Space Mono — The Space Mono Project Authors

Dibujos técnicos SVG: creados para este tema.
Logotipo e iconos: derivados del logotipo facilitado por el cliente.

Diseño y desarrollo: Diània — https://www.diania.dev/

== Changelog ==

= 1.3.1 =
* «Quiénes Somos»: «un barrio tranquilo, con alma de pueblo» en lugar de «uno de los barrios más seguros».
* Zona de servicio ampliada a Simancas, Amposta, Arcos y Rejas (texto, FAQ y areaServed).

= 1.3.0 =
* «Rodar cilindro» pasa de CSS (animation-timeline, sin soporte por defecto en Firefox) a
  JavaScript ligero con APIs estándar, y ya no exige 680 px de alto (portátiles de 1366×768).

= 1.2.0 =
* «Quiénes Somos»: la historia de Raúl y Jesús en dos columnas, con «Cómo trabajamos» y las preguntas frecuentes debajo.
* Zona de servicio confirmada (Canillejas, San Blas, Rosas, Hellín, El Salvador): areaServed en el JSON-LD y en la FAQ.
* Servicio de diario y de urgencia en la descripción del negocio (sin horario 24 h).

= 1.1.0 =
* Menú «Servicios» desplegable con enlaces a las secciones 02–04 de la portada.
* Transición «rodar cilindro» entre diapositivas (CSS ligado al scroll, sin bloquear el desplazamiento).
* SEO: noindex en archivos de autor, fecha y etiqueta; sitemap coherente; canonical en blog y categorías;
  meta descripción del blog; banda final de entradas con enlaces internos a los servicios de la portada.

= 1.0.0 =
* Versión inicial.
