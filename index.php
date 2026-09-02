<?php
// index.php — Site institucional do Dr(a). Nome Sobrenome (conteúdo em config/clinica.php)
$cfg = require __DIR__ . '/config/clinica.php';

function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function whats($cfg, $msg = null){
  $msg = $msg ?? $cfg['whatsapp_msg'];
  return 'https://wa.me/' . $cfg['whatsapp_numero'] . '?text=' . rawurlencode($msg);
}

/** Ícones (Lucide) inline como SVG. $class recebe utilitários Tailwind. */
function icon($name, $class = 'size-5'){
  static $map = [
    'sparkles' => '<path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z"/><path d="M20 2v4"/><path d="M22 4h-4"/><circle cx="4" cy="20" r="2"/>',
    'smile' => '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" x2="9.01" y1="9" y2="9"/><line x1="15" x2="15.01" y1="9" y2="9"/>',
    'anchor' => '<path d="M12 6v16"/><path d="m19 13 2-1a9 9 0 0 1-18 0l2 1"/><path d="M9 11h6"/><circle cx="12" cy="4" r="2"/>',
    'layers' => '<path d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z"/><path d="M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12"/><path d="M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17"/>',
    'activity' => '<path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2"/>',
    'gem' => '<path d="M10.5 3 8 9l4 13 4-13-2.5-6"/><path d="M17 3a2 2 0 0 1 1.6.8l3 4a2 2 0 0 1 .013 2.382l-7.99 10.986a2 2 0 0 1-3.247 0l-7.99-10.986A2 2 0 0 1 2.4 7.8l2.998-3.997A2 2 0 0 1 7 3z"/><path d="M2 9h20"/>',
    'sun' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>',
    'droplet' => '<path d="M12 22a7 7 0 0 0 7-7c0-2-1-3.9-3-5.5s-3.5-4-4-6.5c-.5 2.5-2 4.9-4 6.5C6 11.1 5 13 5 15a7 7 0 0 0 7 7z"/>',
    'align' => '<rect width="6" height="14" x="4" y="5" rx="2"/><rect width="6" height="10" x="14" y="7" rx="2"/><path d="M17 22v-5"/><path d="M17 7V2"/><path d="M7 22v-3"/><path d="M7 5V2"/>',
    'shield' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/>',
    'shield-check' => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
    'clipboard-check' => '<rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="m9 14 2 2 4-4"/>',
    'stethoscope' => '<path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 0 0-2 2v4a6 6 0 0 0 12 0V5a2 2 0 0 0-2-2h-1"/><path d="M8 15a6 6 0 0 0 12 0v-3"/><circle cx="20" cy="10" r="2"/>',
    'tooth' => '<path d="M9 2c-2.8 0-5 2.2-5 5 0 1.2.3 2.5.6 3.6.6 2 1 4 1.2 6 .1 1.3.3 2.6.8 3.8.3.7.9 1.6 1.7 1.6.9 0 1.2-1 1.4-1.8.3-1.4.6-2.9.8-4.3.1-.5.5-.9 1-.9s.9.4 1 .9c.2 1.4.5 2.9.8 4.3.2.8.5 1.8 1.4 1.8.8 0 1.4-.9 1.7-1.6.5-1.2.7-2.5.8-3.8.2-2 .6-4 1.2-6C19.7 9.5 20 8.2 20 7c0-2.8-2.2-5-5-5-1.3 0-2.4.5-3 1-.6-.5-1.7-1-3-1z"/>',
    'heart-handshake' => '<path d="M19.414 14.414C21 12.828 22 11.5 22 9.5a5.5 5.5 0 0 0-9.591-3.676.6.6 0 0 1-.818.001A5.5 5.5 0 0 0 2 9.5c0 2.3 1.5 4 3 5.5l5.535 5.362a2 2 0 0 0 2.879.052 2.12 2.12 0 0 0-.004-3 2.124 2.124 0 1 0 3-3 2.124 2.124 0 0 0 3.004 0 2 2 0 0 0 0-2.828l-1.881-1.882a2.41 2.41 0 0 0-3.409 0l-1.71 1.71a2 2 0 0 1-2.828 0 2 2 0 0 1 0-2.828l2.823-2.762"/>',
    'microscope' => '<path d="M6 18h8"/><path d="M3 22h18"/><path d="M14 22a7 7 0 1 0 0-14h-1"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"/>',
    'sofa' => '<path d="M20 9V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v3"/><path d="M2 16a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a2 2 0 0 0-4 0v1.5a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5V11a2 2 0 0 0-4 0z"/><path d="M4 18v2"/><path d="M20 18v2"/><path d="M12 4v9"/>',
    'star' => '<path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/>',
    'phone' => '<path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/>',
    'message-circle' => '<path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/>',
    'map-pin' => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
    'clock' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
    'navigation' => '<polygon points="3 11 22 2 13 21 11 13 3 11"/>',
    'arrow-right' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
    'arrow-down' => '<path d="M12 5v14"/><path d="m19 12-7 7-7-7"/>',
    'menu' => '<path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/>',
    'x' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
    'check' => '<path d="M20 6 9 17l-5-5"/>',
    'quote' => '<path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"/><path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"/>',
    'instagram' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
  ];
  $inner = $map[$name] ?? '';
  return '<svg class="lucide ' . e($class) . '" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $inner . '</svg>';
}

$waLink = whats($cfg);
$mapsQ  = rawurlencode($cfg['maps_query']);
$hasInsta = !empty($cfg['instagram']);

$nav = [
  ['#diferenciais', 'Diferenciais'],
  ['#tratamentos', 'Tratamentos'],
  ['#sobre', 'Sobre'],
  ['#jornada', 'Sua jornada'],
  ['#depoimentos', 'Depoimentos'],
  ['#localizacao', 'Localização'],
];

$ldjson = json_encode([
  '@context' => 'https://schema.org',
  '@graph' => [[
    '@type' => ['Dentist', 'LocalBusiness', 'MedicalBusiness'],
    '@id' => '#clinica',
    'name' => $cfg['clinic'],
    'description' => $cfg['seo_desc'],
    'telephone' => $cfg['phone_raw'],
    'url' => '/',
    'priceRange' => '$$',
    'image' => '/img/hero-dentista.svg',
    'founder' => ['@type' => 'Person', 'name' => $cfg['name'], 'jobTitle' => 'Cirurgião-dentista'],
  ] + ($hasInsta ? ['sameAs' => [$cfg['instagram']]] : []) + [
    'address' => [
      '@type' => 'PostalAddress',
      'streetAddress' => 'Rua Exemplo, 000 - Bairro Exemplo, Centro',
      'addressLocality' => $cfg['city'],
      'addressRegion' => $cfg['state'],
      'addressCountry' => 'BR',
    ],
    'geo' => ['@type' => 'GeoCoordinates', 'latitude' => $cfg['geo_lat'], 'longitude' => $cfg['geo_lng']],
    'aggregateRating' => ['@type' => 'AggregateRating', 'ratingValue' => $cfg['rating_num'], 'reviewCount' => $cfg['reviews'], 'bestRating' => 5],
    'openingHoursSpecification' => [
      ['@type' => 'OpeningHoursSpecification', 'dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'], 'opens' => '08:00', 'closes' => '19:00'],
    ],
    'availableService' => array_map(fn($s) => ['@type' => 'MedicalProcedure', 'name' => $s['title']], $cfg['tratamentos']),
  ]],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= e($cfg['seo_title']) ?></title>
  <meta name="description" content="<?= e($cfg['seo_desc']) ?>" />
  <meta name="author" content="<?= e($cfg['name']) ?>" />
  <meta name="theme-color" content="#0d3b52" />
  <link rel="canonical" href="/" />
  <link rel="icon" href="favicon.ico" sizes="48x48" />
  <link rel="icon" href="img/logo.svg" type="image/svg+xml" />

  <!-- Open Graph -->
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="<?= e($cfg['clinic']) ?>" />
  <meta property="og:title" content="<?= e($cfg['seo_title']) ?>" />
  <meta property="og:description" content="<?= e($cfg['seo_desc']) ?>" />
  <meta property="og:image" content="/img/hero-dentista.svg" />
  <meta property="og:locale" content="pt_BR" />
  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= e($cfg['seo_title']) ?>" />
  <meta name="twitter:description" content="<?= e($cfg['seo_desc']) ?>" />
  <meta name="twitter:image" content="/img/hero-dentista.svg" />

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="css/main.css" />
  <script type="application/ld+json"><?= $ldjson ?></script>
</head>

<body class="min-h-screen bg-background font-sans text-foreground antialiased">

  <!-- Header -->
  <header id="siteHeader" class="fixed inset-x-0 top-0 z-50 transition-all duration-300 py-5">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-5 lg:px-8">
      <a href="#topo" class="group flex min-w-0 items-center gap-3">
        <img src="<?= e($cfg['logo']) ?>" alt="<?= e($cfg['name']) ?>" class="size-11 shrink-0" />
        <span class="min-w-0 leading-tight">
          <span data-brand class="block truncate font-display text-lg font-600 text-primary transition-colors"><?= e($cfg['short']) ?></span>
          <span data-brand-sub class="block truncate text-[0.7rem] font-medium tracking-widest text-muted-foreground uppercase transition-colors"><?= e($cfg['tagline']) ?></span>
        </span>
      </a>

      <nav class="hidden items-center gap-8 xl:flex">
        <?php foreach ($nav as [$href, $label]): ?>
          <a href="<?= e($href) ?>" data-navlink class="text-sm font-medium text-muted-foreground transition-colors hover:text-accent"><?= e($label) ?></a>
        <?php endforeach; ?>
      </nav>

      <div class="flex items-center gap-2">
        <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="hidden items-center gap-2 rounded-full bg-accent px-5 py-2.5 text-sm font-semibold text-accent-foreground shadow-[var(--shadow-soft)] transition-transform hover:scale-[1.04] sm:inline-flex">
          <?= icon('message-circle', 'size-4') ?>Agendar
        </a>
        <button type="button" id="menuToggle" aria-label="Abrir menu" data-menu-btn class="grid size-11 place-items-center rounded-full border border-white/25 text-white transition-colors xl:hidden">
          <span data-menu-open><?= icon('menu', 'size-5') ?></span>
          <span data-menu-close class="hidden"><?= icon('x', 'size-5') ?></span>
        </button>
      </div>
    </div>

    <nav id="mobileMenu" class="mx-5 mt-3 hidden rounded-3xl border border-border bg-background p-4 shadow-[var(--shadow-lift)] xl:hidden">
      <?php foreach ($nav as [$href, $label]): ?>
        <a href="<?= e($href) ?>" class="block rounded-2xl px-4 py-3 text-sm font-medium text-foreground transition-colors hover:bg-secondary" data-close-menu><?= e($label) ?></a>
      <?php endforeach; ?>
      <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="mt-1 block rounded-2xl bg-accent px-4 py-3 text-center text-sm font-semibold text-accent-foreground" data-close-menu>Agendar pelo WhatsApp</a>
    </nav>
  </header>

  <main id="topo">
    <!-- Hero -->
    <section class="relative overflow-hidden" style="background: var(--gradient-deep)">
      <div aria-hidden="true" class="pointer-events-none absolute -top-32 -right-24 size-[40rem] rounded-full bg-aqua/10 blur-3xl"></div>
      <div aria-hidden="true" class="pointer-events-none absolute inset-0 opacity-[0.06]" style="background-image: radial-gradient(circle at 1px 1px, #fff 1px, transparent 0); background-size: 32px 32px;"></div>

      <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-5 pt-36 pb-20 lg:grid-cols-12 lg:gap-8 lg:px-8 lg:pt-44 lg:pb-28">
        <div class="reveal lg:col-span-6">
          <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs font-semibold tracking-wide text-aqua uppercase backdrop-blur">
            <span class="relative flex size-2">
              <span class="absolute inline-flex size-full animate-ping rounded-full bg-aqua opacity-75"></span>
              <span class="relative inline-flex size-2 rounded-full bg-aqua"></span>
            </span>
            Odontologia em Centro · Cidade Exemplo
          </span>

          <h1 class="mt-7 font-display text-4xl leading-[1.05] font-600 tracking-tight text-white text-balance sm:text-5xl lg:text-6xl">
            <?= e($cfg['hero_titulo_1']) ?> <span class="italic text-aqua"><?= e($cfg['hero_titulo_2']) ?></span>
          </h1>
          <p class="mt-6 max-w-xl text-lg leading-relaxed text-white/70">
            <?= e($cfg['hero_subtitulo']) ?>
          </p>

          <div class="mt-9 flex flex-col gap-3 sm:flex-row">
            <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-full bg-accent px-7 py-4 text-base font-semibold text-accent-foreground shadow-[var(--shadow-lift)] transition-transform hover:scale-[1.03]">
              <?= icon('clipboard-check', 'size-5') ?>Agendar Consulta
            </a>
            <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/20 bg-white/5 px-7 py-4 text-base font-semibold text-white backdrop-blur transition-colors hover:bg-white/10">
              <?= icon('message-circle', 'size-5') ?>Falar no WhatsApp
            </a>
          </div>

          <!-- Selo Google -->
          <div class="mt-10 inline-flex items-center gap-4 rounded-2xl border border-white/12 bg-white/5 px-5 py-4 backdrop-blur">
            <div class="text-center">
              <div class="font-display text-3xl font-600 leading-none text-white"><?= e($cfg['rating']) ?></div>
              <div class="mt-1 flex gap-0.5 text-aqua"><?php for($k=0;$k<5;$k++) echo icon('star','size-3.5 fill-aqua'); ?></div>
            </div>
            <div class="h-10 w-px bg-white/15"></div>
            <div class="text-sm leading-snug text-white/70">
              <div class="font-semibold text-white">Nota máxima no Google</div>
              <div><?= e($cfg['reviews']) ?> avaliações de pacientes</div>
            </div>
          </div>
        </div>

        <!-- Composição de imagem assimétrica -->
        <div class="reveal relative lg:col-span-6 lg:pl-10" style="transition-delay:140ms">
          <div class="relative">
            <div class="overflow-hidden rounded-[2.5rem] border border-white/10 shadow-[var(--shadow-lift)]">
              <img src="img/hero-dentista.svg" alt="Dr(a). Nome Sobrenome conversando com uma paciente no consultório" width="1000" height="1150" class="h-full w-full object-cover" />
            </div>
            <div class="absolute -bottom-6 -left-4 flex items-center gap-3 rounded-2xl border border-border bg-background/95 px-5 py-4 shadow-[var(--shadow-lift)] backdrop-blur sm:-left-8">
              <span class="grid size-11 shrink-0 place-items-center rounded-xl text-accent-foreground" style="background: var(--gradient-aqua)"><?= icon('heart-handshake', 'size-5') ?></span>
              <span class="min-w-0">
                <span class="block text-sm font-semibold text-primary">Atendimento humanizado</span>
                <span class="block text-xs text-muted-foreground">Cuidado e escuta em cada consulta</span>
              </span>
            </div>
            <div class="absolute -top-5 right-2 hidden items-center gap-2 rounded-full border border-border bg-background/95 px-4 py-2.5 text-xs font-semibold text-primary shadow-[var(--shadow-soft)] backdrop-blur sm:flex">
              <?= icon('shield-check', 'size-4 text-accent') ?>Biossegurança rigorosa
            </div>
          </div>
        </div>
      </div>

      <a href="#diferenciais" class="relative mx-auto mb-8 hidden w-fit items-center gap-2 px-8 text-xs font-medium tracking-widest text-white/50 uppercase transition-colors hover:text-aqua lg:flex">
        <?= icon('arrow-down', 'size-4') ?>Role para conhecer
      </a>
    </section>

    <!-- Diferenciais -->
    <section id="diferenciais" class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-28">
      <div class="grid gap-8 lg:grid-cols-12 lg:items-end">
        <div class="reveal lg:col-span-5">
          <span class="text-xs font-semibold tracking-[0.2em] text-accent uppercase">Diferenciais</span>
          <h2 class="mt-4 font-display text-4xl font-600 tracking-tight text-primary text-balance sm:text-5xl">Um cuidado pensado nos mínimos detalhes</h2>
        </div>
        <p class="reveal text-lg leading-relaxed text-muted-foreground lg:col-span-6 lg:col-start-7" style="transition-delay:80ms">
          Cada elemento do atendimento existe para transmitir segurança, conforto e confiança — antes, durante e depois do seu tratamento.
        </p>
      </div>

      <div class="mt-14 grid gap-px overflow-hidden rounded-3xl border border-border bg-border sm:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($cfg['diferenciais'] as $i => $r): ?>
          <div class="reveal bg-card" style="transition-delay:<?= ($i % 3) * 80 ?>ms">
            <article class="group flex h-full flex-col gap-5 p-8 transition-colors hover:bg-secondary/50 lg:p-10">
              <div class="flex items-center justify-between">
                <span class="grid size-13 place-items-center rounded-2xl bg-accent-soft text-accent transition-all duration-300 group-hover:scale-110 group-hover:bg-accent group-hover:text-accent-foreground"><?= icon($r['icon'], 'size-6') ?></span>
                <span class="font-display text-4xl font-500 text-secondary"><?= sprintf('%02d', $i + 1) ?></span>
              </div>
              <div>
                <h3 class="font-display text-xl font-600 text-primary"><?= e($r['title']) ?></h3>
                <p class="mt-2.5 text-sm leading-relaxed text-muted-foreground"><?= e($r['desc']) ?></p>
              </div>
            </article>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Tratamentos (blocos alternados imagem + texto) -->
    <section id="tratamentos" class="bg-secondary/50 py-20 lg:py-28">
      <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal mx-auto max-w-3xl text-center">
          <span class="text-xs font-semibold tracking-[0.2em] text-accent uppercase">Tratamentos</span>
          <h2 class="mt-4 font-display text-4xl font-600 tracking-tight text-primary text-balance sm:text-5xl">Do essencial ao mais sofisticado, com o mesmo cuidado</h2>
          <p class="mt-5 text-lg text-muted-foreground">Cada tratamento é planejado individualmente e apresentado com clareza antes de começar.</p>
        </div>

        <div class="mt-16 space-y-16 lg:space-y-24">
          <?php foreach ($cfg['tratamentos'] as $i => $t): $flip = $i % 2 === 1; ?>
            <article class="grid items-center gap-8 lg:grid-cols-2 lg:gap-14">
              <!-- Imagem -->
              <div class="reveal <?= $flip ? 'lg:order-2' : '' ?>">
                <div class="group relative overflow-hidden rounded-[2rem] border border-border shadow-[var(--shadow-soft)]">
                  <span class="absolute top-5 left-5 z-10 grid size-12 place-items-center rounded-2xl bg-background/90 font-display text-lg font-600 text-accent shadow-[var(--shadow-soft)] backdrop-blur"><?= e($t['num']) ?></span>
                  <img src="<?= e($t['img']) ?>" alt="<?= e($t['title']) ?> — Dr(a). Nome Sobrenome" loading="lazy" width="900" height="640" class="aspect-[7/5] h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
                </div>
              </div>
              <!-- Texto -->
              <div class="reveal <?= $flip ? 'lg:order-1' : '' ?>" style="transition-delay:100ms">
                <span class="inline-flex size-12 items-center justify-center rounded-2xl bg-accent-soft text-accent"><?= icon($t['icon'], 'size-6') ?></span>
                <h3 class="mt-5 font-display text-3xl font-600 tracking-tight text-primary"><?= e($t['title']) ?></h3>
                <p class="mt-4 max-w-lg text-base leading-relaxed text-muted-foreground"><?= e($t['desc']) ?></p>
                <a href="<?= e(whats($cfg, 'Olá, Dr(a). Nome Sobrenome! Gostaria de saber mais sobre: ' . $t['title'] . '.')) ?>" target="_blank" rel="noopener noreferrer" class="group mt-6 inline-flex items-center gap-2 text-sm font-semibold text-accent transition-colors hover:text-primary">
                  <span class="grid size-9 place-items-center rounded-full bg-accent text-accent-foreground transition-transform group-hover:scale-110"><?= icon('message-circle', 'size-4') ?></span>
                  Falar no WhatsApp sobre <?= e($t['title']) ?>
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Sobre -->
    <section id="sobre" class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-28">
      <div class="grid items-center gap-12 lg:grid-cols-12 lg:gap-16">
        <div class="reveal lg:col-span-5">
          <div class="relative">
            <div class="overflow-hidden rounded-[2.5rem] shadow-[var(--shadow-lift)]">
              <img src="img/sobre-clinica.svg" alt="Dr(a). Nome Sobrenome em seu consultório" loading="lazy" width="900" height="1080" class="h-full w-full object-cover" />
            </div>
            <div class="absolute -right-4 -bottom-6 rounded-2xl border border-border bg-background px-6 py-5 text-center shadow-[var(--shadow-lift)] sm:-right-8">
              <div class="font-display text-3xl font-600 text-accent"><?= e($cfg['rating']) ?><span class="text-aqua">★</span></div>
              <div class="mt-1 text-xs font-medium text-muted-foreground"><?= e($cfg['reviews']) ?> avaliações</div>
            </div>
          </div>
        </div>

        <div class="reveal lg:col-span-6 lg:col-start-7" style="transition-delay:100ms">
          <span class="text-xs font-semibold tracking-[0.2em] text-accent uppercase"><?= e($cfg['sobre_eyebrow']) ?></span>
          <h2 class="mt-4 font-display text-4xl font-600 tracking-tight text-primary text-balance sm:text-5xl"><?= e($cfg['sobre_titulo']) ?></h2>
          <p class="mt-6 leading-relaxed text-muted-foreground"><?= e($cfg['sobre_p1']) ?></p>
          <p class="mt-4 leading-relaxed text-muted-foreground"><?= e($cfg['sobre_p2']) ?></p>

          <ul class="mt-8 grid gap-3 sm:grid-cols-2">
            <?php foreach ($cfg['sobre_valores'] as $v): ?>
              <li class="flex items-start gap-3 text-sm font-medium text-primary">
                <span class="mt-0.5 grid size-5 shrink-0 place-items-center rounded-full bg-accent text-accent-foreground"><?= icon('check', 'size-3.5') ?></span>
                <?= e($v) ?>
              </li>
            <?php endforeach; ?>
          </ul>

          <dl class="mt-9 grid grid-cols-3 gap-5 border-t border-border pt-8">
            <?php foreach ($cfg['sobre_stats'] as $s): ?>
              <div>
                <dt class="font-display text-3xl font-600 text-primary"><?= e($s['v']) ?></dt>
                <dd class="mt-1 text-xs leading-snug text-muted-foreground"><?= e($s['l']) ?></dd>
              </div>
            <?php endforeach; ?>
          </dl>
        </div>
      </div>
    </section>

    <!-- Jornada do paciente (timeline) -->
    <section id="jornada" class="relative overflow-hidden py-20 lg:py-28" style="background: var(--gradient-deep)">
      <div aria-hidden="true" class="pointer-events-none absolute -bottom-40 -right-32 size-[36rem] rounded-full bg-aqua/10 blur-3xl"></div>
      <div class="relative mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal mx-auto max-w-2xl text-center">
          <span class="text-xs font-semibold tracking-[0.2em] text-aqua uppercase">Sua jornada</span>
          <h2 class="mt-4 font-display text-4xl font-600 tracking-tight text-white text-balance sm:text-5xl">Do primeiro contato ao acompanhamento</h2>
          <p class="mt-5 text-lg text-white/60">Um caminho claro e tranquilo, com você no centro de cada decisão.</p>
        </div>

        <ol class="mt-16 grid gap-8 md:grid-cols-5 md:gap-4">
          <?php foreach ($cfg['jornada'] as $i => $p): ?>
            <li class="reveal group relative" style="transition-delay:<?= $i * 90 ?>ms">
              <?php if ($i < count($cfg['jornada']) - 1): ?>
                <span aria-hidden="true" class="absolute top-7 left-[calc(50%+2.5rem)] hidden h-px w-[calc(100%-3rem)] bg-gradient-to-r from-aqua/40 to-transparent md:block"></span>
              <?php endif; ?>
              <div class="relative flex flex-col items-center text-center md:items-start md:text-left">
                <span class="grid size-14 place-items-center rounded-2xl border border-white/15 bg-white/5 text-aqua backdrop-blur transition-all duration-300 group-hover:scale-110 group-hover:border-aqua/50"><?= icon($p['icon'], 'size-6') ?></span>
                <span class="mt-4 font-display text-sm font-600 tracking-widest text-aqua/70"><?= e($p['n']) ?></span>
                <h3 class="mt-1 font-display text-xl font-600 text-white"><?= e($p['title']) ?></h3>
                <p class="mt-2 text-sm leading-relaxed text-white/55"><?= e($p['desc']) ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        </ol>
      </div>
    </section>

    <!-- Galeria (bento) -->
    <section id="galeria" class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-28">
      <div class="grid gap-8 lg:grid-cols-12 lg:items-end">
        <div class="reveal lg:col-span-6">
          <span class="text-xs font-semibold tracking-[0.2em] text-accent uppercase">Galeria</span>
          <h2 class="mt-4 font-display text-4xl font-600 tracking-tight text-primary text-balance sm:text-5xl">Um ambiente feito para o seu conforto</h2>
        </div>
        <p class="reveal text-lg leading-relaxed text-muted-foreground lg:col-span-5 lg:col-start-8" style="transition-delay:80ms">
          Consultório, recepção e equipamentos pensados para tornar a sua visita tranquila, segura e acolhedora.
        </p>
      </div>

      <div class="mt-14 grid auto-rows-[200px] gap-4 sm:grid-cols-2 lg:auto-rows-[220px] lg:grid-cols-4">
        <?php foreach ($cfg['galeria'] as $i => $g): ?>
          <div class="reveal <?= e($g['span']) ?>" style="transition-delay:<?= ($i % 3) * 80 ?>ms">
            <figure class="group relative h-full overflow-hidden rounded-[1.75rem] border border-border bg-muted shadow-[var(--shadow-soft)]">
              <img src="<?= e($g['img']) ?>" alt="<?= e($g['alt']) ?>" loading="lazy" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" />
              <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-deep/70 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
              <figcaption class="absolute bottom-4 left-4 translate-y-2 text-sm font-semibold text-white opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100"><?= e($g['label']) ?></figcaption>
            </figure>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Depoimentos -->
    <section id="depoimentos" class="bg-secondary/50 py-20 lg:py-28">
      <div class="mx-auto max-w-7xl px-5 lg:px-8">
        <div class="reveal flex flex-col items-center gap-6 text-center">
          <span class="text-xs font-semibold tracking-[0.2em] text-accent uppercase">Depoimentos</span>
          <h2 class="max-w-2xl font-display text-4xl font-600 tracking-tight text-primary text-balance sm:text-5xl">Histórias de quem já confia no consultório</h2>
          <div class="inline-flex items-center gap-3 rounded-full border border-border bg-background px-5 py-3 shadow-[var(--shadow-soft)]">
            <span class="flex gap-0.5 text-aqua"><?php for($k=0;$k<5;$k++) echo icon('star','size-4 fill-aqua'); ?></span>
            <span class="text-sm font-semibold text-primary">Nota <?= e($cfg['rating']) ?></span>
            <span class="text-sm text-muted-foreground">· <?= e($cfg['reviews']) ?> avaliações no Google</span>
          </div>
        </div>

        <div class="mt-14 columns-1 gap-6 sm:columns-2 lg:columns-3">
          <?php foreach ($cfg['depoimentos'] as $i => $t): ?>
            <figure class="reveal surface-card mb-6 break-inside-avoid p-7" style="transition-delay:<?= ($i % 3) * 70 ?>ms">
              <?= icon('quote', 'size-8 text-aqua/40') ?>
              <blockquote class="mt-4 text-[0.95rem] leading-relaxed text-foreground">“<?= e($t['text']) ?>”</blockquote>
              <figcaption class="mt-6 flex min-w-0 items-center gap-3 border-t border-border pt-5">
                <span class="grid size-11 shrink-0 place-items-center rounded-full font-display text-sm font-600 text-accent-foreground" style="background: var(--gradient-aqua)"><?= e($t['initials']) ?></span>
                <span class="min-w-0">
                  <span class="block truncate text-sm font-semibold text-primary"><?= e($t['name']) ?></span>
                  <span class="block truncate text-xs text-muted-foreground"><?= e($t['role']) ?></span>
                </span>
                <span class="ml-auto flex gap-0.5 text-aqua"><?php for($k=0;$k<5;$k++) echo icon('star','size-3 fill-aqua'); ?></span>
              </figcaption>
            </figure>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="mx-auto max-w-7xl px-5 py-20 lg:px-8 lg:py-24">
      <div class="reveal relative overflow-hidden rounded-[2.5rem] px-6 py-16 text-center shadow-[var(--shadow-lift)] lg:px-16 lg:py-24" style="background: var(--gradient-deep)">
        <div aria-hidden="true" class="pointer-events-none absolute -top-24 -left-16 size-96 rounded-full bg-aqua/15 blur-3xl"></div>
        <div aria-hidden="true" class="pointer-events-none absolute -bottom-24 -right-16 size-96 rounded-full bg-accent/20 blur-3xl"></div>
        <div class="relative mx-auto max-w-2xl">
          <span class="flex justify-center gap-0.5 text-aqua"><?php for($k=0;$k<5;$k++) echo icon('star','size-5 fill-aqua'); ?></span>
          <h2 class="mt-6 font-display text-4xl font-600 tracking-tight text-white text-balance sm:text-5xl"><?= e($cfg['cta_titulo']) ?></h2>
          <p class="mx-auto mt-5 max-w-xl text-lg text-white/70"><?= e($cfg['cta_sub']) ?></p>
          <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="mt-10 inline-flex items-center gap-3 rounded-full bg-accent px-9 py-5 text-lg font-semibold text-accent-foreground shadow-[var(--shadow-lift)] transition-transform hover:scale-[1.04]">
            <?= icon('message-circle', 'size-6') ?>Agendar pelo WhatsApp
          </a>
          <p class="mt-5 text-sm text-white/50">Resposta rápida · <?= e($cfg['phone']) ?></p>
        </div>
      </div>
    </section>

    <!-- Localização -->
    <section id="localizacao" class="mx-auto max-w-7xl px-5 pb-20 lg:px-8 lg:pb-28">
      <div class="overflow-hidden rounded-[2.5rem] border border-border shadow-[var(--shadow-soft)]">
        <div class="grid lg:grid-cols-[0.85fr_1.15fr]">
          <div class="reveal bg-card p-8 lg:p-12">
            <span class="text-xs font-semibold tracking-[0.2em] text-accent uppercase">Localização</span>
            <h2 class="mt-4 font-display text-3xl font-600 tracking-tight text-primary sm:text-4xl">Fácil de chegar, em <?= e($cfg['district']) ?></h2>
            <ul class="mt-8 space-y-6 text-sm">
              <li class="flex gap-4">
                <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-accent-soft text-accent"><?= icon('map-pin', 'size-5') ?></span>
                <span class="text-muted-foreground">Rua Exemplo, 000 · Bairro Exemplo<br /><?= e($cfg['district']) ?><br /><?= e($cfg['city']) ?> - <?= e($cfg['state']) ?></span>
              </li>
              <li class="flex gap-4">
                <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-accent-soft text-accent"><?= icon('clock', 'size-5') ?></span>
                <span class="text-muted-foreground"><?= e($cfg['horario_semana']) ?><br /><?= e($cfg['horario_sabado']) ?></span>
              </li>
              <li class="flex gap-4">
                <span class="grid size-11 shrink-0 place-items-center rounded-2xl bg-accent-soft text-accent"><?= icon('phone', 'size-5') ?></span>
                <a href="tel:<?= e($cfg['phone_raw']) ?>" class="font-semibold text-primary hover:text-accent"><?= e($cfg['phone']) ?></a>
              </li>
            </ul>
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?= $mapsQ ?>" target="_blank" rel="noopener noreferrer" class="mt-9 inline-flex items-center gap-2 rounded-full bg-primary px-7 py-4 text-base font-semibold text-primary-foreground transition-transform hover:scale-[1.03]">
              <?= icon('navigation', 'size-5') ?>Como chegar
            </a>
          </div>
          <div class="reveal min-h-[360px]" style="transition-delay:100ms">
            <iframe title="Mapa — <?= e($cfg['clinic']) ?>" src="https://www.google.com/maps?q=<?= $mapsQ ?>&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="h-full min-h-[360px] w-full border-0"></iframe>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Rodapé -->
  <footer class="relative overflow-hidden text-white" style="background: var(--gradient-deep)">
    <div class="mx-auto grid max-w-7xl gap-10 px-5 py-16 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">
      <div class="sm:col-span-2 lg:col-span-1">
        <div class="flex items-center gap-3">
          <img src="<?= e($cfg['logo']) ?>" alt="<?= e($cfg['name']) ?>" class="size-11" />
          <span class="font-display text-xl font-600"><?= e($cfg['short']) ?></span>
        </div>
        <p class="mt-4 max-w-xs text-sm leading-relaxed text-white/60">Odontologia de excelência em Centro, Cidade Exemplo. Tecnologia, atenção aos detalhes e atendimento humanizado.</p>
        <div class="mt-5 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-4 py-2 text-xs">
          <span class="flex gap-0.5 text-aqua"><?php for($k=0;$k<5;$k++) echo icon('star','size-3 fill-aqua'); ?></span>
          <span class="text-white/80"><?= e($cfg['rating']) ?> · <?= e($cfg['reviews']) ?> avaliações</span>
        </div>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-white">Contato</h3>
        <ul class="mt-4 space-y-2.5 text-sm text-white/60">
          <li><a href="tel:<?= e($cfg['phone_raw']) ?>" class="transition-colors hover:text-aqua">Telefone: <?= e($cfg['phone']) ?></a></li>
          <li><a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="transition-colors hover:text-aqua">WhatsApp: <?= e($cfg['phone']) ?></a></li>
          <?php if ($hasInsta): ?>
            <li><a href="<?= e($cfg['instagram']) ?>" target="_blank" rel="noopener noreferrer" class="transition-colors hover:text-aqua">Instagram</a></li>
          <?php endif; ?>
        </ul>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-white">Endereço</h3>
        <p class="mt-4 text-sm leading-relaxed text-white/60">Rua Exemplo, 000<br />Bairro Exemplo · <?= e($cfg['district']) ?><br /><?= e($cfg['city']) ?> - <?= e($cfg['state']) ?></p>
      </div>
      <div>
        <h3 class="text-sm font-semibold text-white">Horário</h3>
        <p class="mt-4 text-sm leading-relaxed text-white/60"><?= e($cfg['horario_semana']) ?><br /><?= e($cfg['horario_sabado']) ?></p>
        <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" class="mt-5 inline-flex items-center gap-2 rounded-full bg-accent px-5 py-3 text-sm font-semibold text-accent-foreground transition-transform hover:scale-[1.04]">
          <?= icon('message-circle', 'size-4') ?>Agendar agora
        </a>
      </div>
    </div>
    <div class="border-t border-white/10 py-6 text-center text-xs text-white/45">
      © <?= date('Y') ?> <?= e($cfg['clinic']) ?>. Todos os direitos reservados.
    </div>
  </footer>

  <!-- Botão flutuante WhatsApp -->
  <a href="<?= e($waLink) ?>" target="_blank" rel="noopener noreferrer" aria-label="Agendar pelo WhatsApp" class="fixed right-5 bottom-5 z-50 inline-flex items-center gap-2 rounded-full bg-whatsapp px-5 py-4 font-semibold text-whatsapp-foreground shadow-[var(--shadow-lift)] transition-transform hover:scale-105">
    <?= icon('message-circle', 'size-6') ?><span class="hidden sm:inline">WhatsApp</span>
  </a>

  <script src="js/app.js"></script>
</body>
</html>
