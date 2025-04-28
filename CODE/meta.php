<!--  Essential META Tags -->
<meta name="author" content="Ronald van Heugten (WaaaghNL)">
<meta property="og:title" content="<?= (isset($idea) ? 'Bekijk het KUT idee van ' . $idea['name'] : $siteTitle); ?>">
<meta name="keywords" content="Ideeën testen,Goed of slecht idee,Ideeën beoordelen,Ideeënvalidatie,Ideeëntest,Goedkeuring van ideeën,Ideeënkeuring,Ideeën beoordelen en rangschikken,Ideeënanalyse,Goede of slechte ideeën herkennen,Ideeënfilter,Ideeënscore,Test je idee,Evaluatie van ideeën,Ideeëncheck,Goed of slecht idee valideren,Ideeën goedkeuren of afwijzen,Herken goede of slechte ideeën,Validatie van ideeën en beoordeling,Check je idee op goedheid of slechtheid,Analyseer en evalueer ideeën,Ideeënvalidatie en -score,Test je ideeën op succes,Ideeënselectie en -beoordeling,Ideeëntesten voor betere resultaten,Ideeënscoring en -classificatie,Ideeënbeoordeling en optimalisatie,Testen van ideeën vooruitgang,Ideeënfeedback en verbetering,Goedkeuring van slimme ideeën,Slechte ideeën vermijden met tests,Ideeënselectie en rendement,Ideeënsucces meten en analyseren,Innovatieve ideeën testen en valideren,Ideeënfiltering voor efficiëntie">
<meta property="og:type" content="app" />
<meta property="og:url" content="<?= $siteBase; ?>">

<meta property="og:description" content="<?= (isset($idea) ? $idea['name'] . " heeft een kut idee. Zie het resultaat!" : 'Heb je een kut idee die je wil checken of je het moet doen? Doe dat hier!'); ?>">
<meta property="og:site_name" content="<?= $siteTitle; ?>">