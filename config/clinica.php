<?php
/**
 * Configuração do site — Dr(a). Nome Sobrenome
 * Edite AQUI todos os dados e textos. O HTML (index.php) não precisa mudar.
 */
return [
  // ====== Identidade ======
  'name'    => 'Dr(a). Nome Sobrenome',
  'clinic'  => 'Dr(a). Nome Sobrenome',
  'short'   => 'Nome Sobrenome',
  'tagline' => 'Odontologia · Cidade Exemplo',
  'logo'    => 'img/logo.svg',

  // ====== Contato ======
  'phone'           => '(00) 00000-0000',
  'phone_raw'       => '+5500000000000',
  'whatsapp_numero' => '5500000000000',
  'whatsapp_msg'    => 'Olá, Dr(a). Nome Sobrenome! Vim pelo site e gostaria de agendar uma avaliação.',

  // ====== Endereço ======
  'address'    => 'Rua Exemplo, 000 · Bairro Exemplo',
  'district'   => 'Centro',
  'city'       => 'Cidade Exemplo',
  'state'   => 'UF',
  'maps_query' => 'Rua Exemplo, 000, Bairro Exemplo, Centro, Cidade Exemplo · UF',
  'geo_lat'    => 0,
  'geo_lng'    => 0,

  // ====== Avaliações ======
  'rating'     => '5,0',
  'rating_num' => 5.0,
  'reviews'    => 28,

  // ====== Horário ======
  'horario_semana' => 'Seg a Sex · 08h às 19h',
  'horario_sabado' => 'Sábado · sob agendamento',

  // ====== Redes sociais ======
  'instagram' => '',

  // ====== SEO ======
  'seo_title' => 'Dr(a). Nome Sobrenome — Dentista em Cidade Exemplo (Centro) | Odontologia de Excelência',
  'seo_desc'  => 'Consultório do Dr(a). Nome Sobrenome em Centro, Cidade Exemplo. Odontologia com tecnologia, atenção aos detalhes e atendimento humanizado: implantes, facetas, clareamento, ortodontia e mais. Nota 5,0 no Google (28 avaliações). Agende pelo WhatsApp.',

  // ====== Hero ======
  'hero_titulo_1'  => 'Sorrisos saudáveis começam com um atendimento',
  'hero_titulo_2'  => 'de excelência.',
  'hero_subtitulo' => 'Cuidamos da saúde bucal com tecnologia, atenção aos detalhes e um atendimento personalizado para cada paciente.',

  // ====== Diferenciais ======
  'diferenciais' => [
    ['icon' => 'clipboard-check', 'title' => 'Planejamento personalizado', 'desc' => 'Cada plano de tratamento é desenhado sob medida, a partir de uma avaliação minuciosa do seu caso.'],
    ['icon' => 'microscope',      'title' => 'Tecnologia moderna',        'desc' => 'Equipamentos atuais para diagnósticos precisos, procedimentos seguros e resultados previsíveis.'],
    ['icon' => 'heart-handshake', 'title' => 'Atendimento humanizado',     'desc' => 'Escuta atenta e acolhimento em cada etapa — do primeiro contato ao acompanhamento final.'],
    ['icon' => 'sofa',            'title' => 'Ambiente confortável',        'desc' => 'Um espaço tranquilo e acolhedor, pensado para reduzir a ansiedade e receber você bem.'],
    ['icon' => 'shield-check',    'title' => 'Compromisso com a qualidade', 'desc' => 'Protocolos rigorosos de segurança e biossegurança em todos os procedimentos.'],
    ['icon' => 'sparkles',        'title' => 'Resultados naturais',         'desc' => 'Estética que respeita a harmonia do seu rosto, com acabamento discreto e natural.'],
  ],

  // ====== Tratamentos (blocos alternados imagem + texto) ======
  'tratamentos' => [
    ['icon' => 'anchor',   'num' => '01', 'img' => 'img/trat-implantes.svg',    'title' => 'Implantes',              'desc' => 'Reposição de dentes perdidos com raízes de titânio biocompatível. Recuperamos a mastigação, a fala e a estética com resultado firme e natural.'],
    ['icon' => 'layers',   'num' => '02', 'img' => 'img/trat-proteses.svg',     'title' => 'Próteses',               'desc' => 'Próteses fixas e removíveis planejadas para conforto e função. Devolvemos a forma e a naturalidade ao seu sorriso.'],
    ['icon' => 'sun',      'num' => '03', 'img' => 'img/trat-clareamento.svg',  'title' => 'Clareamento Dental',     'desc' => 'Dentes visivelmente mais brancos com protocolo seguro, supervisionado e resultado uniforme, sem agredir o esmalte.'],
    ['icon' => 'gem',      'num' => '04', 'img' => 'img/trat-facetas.svg',      'title' => 'Facetas',                'desc' => 'Design de sorriso sob medida. Corrigimos forma, cor e proporção com lâminas finíssimas e acabamento impecável.'],
    ['icon' => 'align',    'num' => '05', 'img' => 'img/trat-ortodontia.svg',   'title' => 'Ortodontia',             'desc' => 'Aparelhos convencionais, estéticos e alinhadores para posicionar os dentes e equilibrar a mordida com previsibilidade.'],
    ['icon' => 'activity', 'num' => '06', 'img' => 'img/trat-canal.svg',        'title' => 'Tratamento de Canal',    'desc' => 'Endodontia com técnica atual e anestesia eficaz. Aliviamos a dor e preservamos o seu dente natural.'],
    ['icon' => 'droplet',  'num' => '07', 'img' => 'img/trat-limpeza.svg',      'title' => 'Limpeza',                'desc' => 'Profilaxia completa que remove placa e tártaro, prevenindo cáries e gengivite e mantendo o hálito saudável.'],
    ['icon' => 'shield',   'num' => '08', 'img' => 'img/trat-preventiva.svg',   'title' => 'Odontologia Preventiva', 'desc' => 'Acompanhamento periódico e orientação individual para evitar problemas antes que eles apareçam.'],
  ],

  // ====== Jornada do paciente (timeline) ======
  'jornada' => [
    ['n' => '01', 'icon' => 'message-circle', 'title' => 'Primeiro contato',   'desc' => 'Você fala com a gente pelo WhatsApp, tira dúvidas e agenda no melhor horário.'],
    ['n' => '02', 'icon' => 'stethoscope',    'title' => 'Avaliação completa', 'desc' => 'Fazemos um exame minucioso da sua saúde bucal, ouvindo suas queixas e objetivos.'],
    ['n' => '03', 'icon' => 'clipboard-check','title' => 'Plano de tratamento','desc' => 'Apresentamos um plano claro, com prioridades e orçamento, antes de iniciar.'],
    ['n' => '04', 'icon' => 'tooth',          'title' => 'Execução',           'desc' => 'Conduzimos cada etapa com técnica, segurança e o seu conforto sempre em primeiro lugar.'],
    ['n' => '05', 'icon' => 'heart-handshake','title' => 'Acompanhamento',     'desc' => 'Acompanhamos os resultados ao longo do tempo, com manutenção e cuidado contínuo.'],
  ],

  // ====== Galeria (placeholders editáveis) ======
  'galeria' => [
    ['img' => 'img/galeria-consultorio.svg', 'alt' => 'Consultório do Dr(a). Nome Sobrenome', 'label' => 'Consultório', 'span' => 'lg:col-span-2 lg:row-span-2'],
    ['img' => 'img/galeria-recepcao.svg',    'alt' => 'Recepção acolhedora',               'label' => 'Recepção',    'span' => ''],
    ['img' => 'img/galeria-equipamentos.svg','alt' => 'Equipamentos odontológicos modernos','label' => 'Equipamentos','span' => ''],
    ['img' => 'img/galeria-ambiente.svg',    'alt' => 'Detalhes do ambiente',              'label' => 'Ambiente',    'span' => ''],
    ['img' => 'img/galeria-atendimento.svg', 'alt' => 'Atendimento ao paciente',            'label' => 'Atendimento', 'span' => ''],
  ],

  // ====== Depoimentos ======
  'depoimentos' => [
    ['name' => 'Rafael Menezes',   'role' => 'Implante unitário', 'initials' => 'RM', 'text' => 'Fiz um implante com o Dr(a). Nome Sobrenome e o resultado ficou idêntico aos meus outros dentes. Explicou cada etapa com calma e o pós foi muito tranquilo. Recomendo demais.'],
    ['name' => 'Larissa Andrade',  'role' => 'Facetas',           'initials' => 'LA', 'text' => 'Sempre tive vergonha de sorrir. As facetas mudaram completamente meu sorriso, de um jeito natural, sem exagero. Atendimento impecável do começo ao fim.'],
    ['name' => 'Bruno Carvalho',   'role' => 'Clareamento',       'initials' => 'BC', 'text' => 'Ambiente super acolhedor e um cuidado que faz diferença. O clareamento ficou uniforme e sem sensibilidade. Achei o consultório muito organizado e moderno.'],
    ['name' => 'Camila Souza',     'role' => 'Ortodontia',        'initials' => 'CS', 'text' => 'Estou em tratamento ortodôntico e me sinto muito segura. O Dr(a). Nome Sobrenome é atencioso, pontual e sempre tira todas as minhas dúvidas. Nota 10.'],
    ['name' => 'Diego Nascimento', 'role' => 'Tratamento de canal','initials' => 'DN', 'text' => 'Cheguei com muita dor e sai aliviado no mesmo dia. Profissional excelente, mão leve e muito cuidadoso. Virei paciente fixo do consultório.'],
    ['name' => 'Patrícia Lima',    'role' => 'Prótese e limpeza', 'initials' => 'PL', 'text' => 'Atendimento humano de verdade. Me senti acolhida em todas as consultas e o resultado da prótese superou minhas expectativas. Indico de olhos fechados.'],
  ],

  // ====== Sobre ======
  'sobre_eyebrow' => 'Sobre o consultório',
  'sobre_titulo'  => 'Ética, confiança e cuidado individual em cada atendimento',
  'sobre_p1' => 'O consultório do Dr(a). Nome Sobrenome nasceu de uma convicção simples: cada paciente é único e merece ser ouvido antes de ser tratado. Aqui, o atendimento começa pela escuta — entender a sua história, as suas queixas e os seus objetivos para então construir um plano que faça sentido de verdade.',
  'sobre_p2' => 'Trabalhamos com ética e transparência em todas as etapas, apresentando cada procedimento com clareza e apenas o que é necessário para a sua saúde. O compromisso com a atualização constante e com protocolos rigorosos de segurança garante uma experiência confortável, segura e com acompanhamento do início ao fim.',
  'sobre_stats' => [
    ['v' => '5,0', 'l' => 'nota no Google'],
    ['v' => '28',  'l' => 'avaliações de pacientes'],
    ['v' => '100%','l' => 'atendimento personalizado'],
  ],
  'sobre_valores' => [
    'Escuta atenta e plano sob medida',
    'Transparência em cada orçamento',
    'Atualização técnica constante',
    'Biossegurança em todos os passos',
  ],

  // ====== CTA final ======
  'cta_titulo' => 'Seu sorriso merece um cuidado diferenciado.',
  'cta_sub'    => 'Agende uma avaliação e conheça um atendimento pensado para você.',
];
