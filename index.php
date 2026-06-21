<?php
/**
 * Generador de Enlaces mailto:
 * Construye enlaces de correo con destinatario, copia, asunto y cuerpo.
 */
header('Content-Type: text/html; charset=utf-8');

$enlace = '';
$codigo = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $para     = trim($_POST['para'] ?? '');
    $cc       = trim($_POST['cc'] ?? '');
    $bcc      = trim($_POST['bcc'] ?? '');
    $asunto   = trim($_POST['asunto'] ?? '');
    $cuerpo   = trim($_POST['cuerpo'] ?? '');

    $params = [];
    if ($cc !== '')     $params[] = 'cc=' . rawurlencode($cc);
    if ($bcc !== '')    $params[] = 'bcc=' . rawurlencode($bcc);
    if ($asunto !== '') $params[] = 'subject=' . rawurlencode($asunto);
    if ($cuerpo !== '') $params[] = 'body=' . rawurlencode($cuerpo);

    $enlace = 'mailto:' . rawurlencode($para);
    if ($params) $enlace .= '?' . implode('&', $params);

    $textoVisible = $para ?: 'Escríbenos';
    $codigo = '<a href="' . htmlspecialchars($enlace) . '">' . htmlspecialchars($textoVisible) . '</a>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generador de Enlaces mailto Online Gratis | ConfiguroWeb</title>
<meta name="description" content="Crea enlaces mailto: con destinatario, copia, asunto y cuerpo predefinido. Genera el código HTML listo para pegar. Herramienta de ConfiguroWeb.">
<meta name="keywords" content="generador mailto, enlace correo, html mailto, mailto link builder">
<meta property="og:type" content="website">
<meta property="og:title" content="Generador de Enlaces mailto Online Gratis">
<meta property="og:description" content="Crea enlaces mailto: con destinatario, copia, asunto y cuerpo.">
<link rel="canonical" href="https://demoscweb.com/github/php-generador-mailto/">
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"WebApplication","name":"Generador de Enlaces mailto","applicationCategory":"DeveloperApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"author":{"@type":"Person","name":"ConfiguroWeb","url":"https://configuroweb.com"}}
</script>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
  <h1>📧 Generador de Enlaces mailto:</h1>
  <p class="subtitle">Crea enlaces de correo con asunto y cuerpo predefinido.</p>
</header>
<main>
  <form method="POST">
    <label for="para">Para (email principal):</label>
    <input type="email" name="para" id="para" value="<?php echo htmlspecialchars($_POST['para'] ?? ''); ?>" placeholder="ventas@miempresa.com" required>

    <label for="cc">CC (con copia, opcional):</label>
    <input type="text" name="cc" id="cc" value="<?php echo htmlspecialchars($_POST['cc'] ?? ''); ?>" placeholder="copia@miempresa.com">

    <label for="bcc">BCC (copia oculta, opcional):</label>
    <input type="text" name="bcc" id="bcc" value="<?php echo htmlspecialchars($_POST['bcc'] ?? ''); ?>" placeholder="oculto@miempresa.com">

    <label for="asunto">Asunto:</label>
    <input type="text" name="asunto" id="asunto" value="<?php echo htmlspecialchars($_POST['asunto'] ?? ''); ?>" placeholder="Solicitud de información">

    <label for="cuerpo">Cuerpo del mensaje:</label>
    <textarea name="cuerpo" id="cuerpo" rows="5" placeholder="Hola, me gustaría más información sobre..."><?php echo htmlspecialchars($_POST['cuerpo'] ?? ''); ?></textarea>

    <div class="botones">
      <button type="submit" class="btn-primary">Generar enlace</button>
    </div>
  </form>

  <?php if ($enlace): ?>
    <label>Enlace mailto: (copia y pega en tu navegador para probar)</label>
    <div class="resultado ok"><pre><code id="r-enlace"><?php echo htmlspecialchars($enlace); ?></code></pre></div>

    <label>Código HTML listo para pegar:</label>
    <div class="resultado ok"><pre><code id="r-html"><?php echo htmlspecialchars($codigo); ?></code></pre></div>

    <div class="botones">
      <button type="button" class="btn-secundario" data-copy="r-enlace">📋 Copiar enlace</button>
      <button type="button" class="btn-secundario" data-copy="r-html">📋 Copiar HTML</button>
      <a href="<?php echo htmlspecialchars($enlace); ?>" class="btn-primary enlace-probar">✉️ Probar enlace</a>
    </div>
  <?php endif; ?>

  <section class="info">
    <h2>¿Qué es un enlace mailto:?</h2>
    <p>El esquema <code>mailto:</code> permite crear enlaces que, al hacer clic, abren el cliente de correo del usuario con campos prellenados (destinatario, asunto, cuerpo). Es útil para:</p>
    <ul>
      <li>Botones de contacto en webs estáticas (sin formulario backend).</li>
      <li>Newsletters y firmas de email.</li>
      <li>Facilitar el envío de correos con estructura predefinida.</li>
    </ul>
  </section>
</main>
<footer>
  <p>Desarrollado por <a href="https://configuroweb.com" target="_blank">ConfiguroWeb</a> ·
     <a href="https://appscweb.com/citas/" target="_blank">Sistema de Citas</a> ·
     <a href="https://appscweb.com/negocios/" target="_blank">Gestión de Negocios</a></p>
  <p>&copy; <?php echo date('Y'); ?> ConfiguroWeb</p>
</footer>
<script src="assets/script.js"></script>
</body>
</html>