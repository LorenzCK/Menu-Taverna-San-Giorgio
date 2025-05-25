<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Taverna Gaita San Giorgio — Menu</title>

    <link rel="stylesheet" href="fonts/pfeffermedieval.css" />
    <link rel="stylesheet" href="resources/bulma.min.css" />

    <script src="https://kit.fontawesome.com/f7930f1730.js" crossorigin="anonymous"></script>

    <link rel="apple-touch-icon" sizes="57x57" href="resources/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="resources/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="resources/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="resources/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="resources/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="resources/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="resources/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="resources/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="resources/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192"  href="resources/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="resources/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="resources/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="resources/favicon-16x16.png" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="manifest" href="manifest.json" />

    <meta name="author" content="Gaita San Giorgio" />
    <meta name="description" content="Menu della Taverna Gaita San Giorgio, aperta durante la manifestazione Mercato delle Gaite a Bevagna (PG)." />

    <meta property="og:image" content="https://menu.gaitasangiorgio.com/menu-taverna-san-giorgio-social-2024.jpg" />
    <meta property="og:title" content="Taverna Gaita San Giorgio — Menu" />

    <script defer src="https://api.pirsch.io/pa.js"
        id="pianjs"
        data-code="ZJn4CAIUmKxkxVjWzrRwt68NsXziBQf9"></script>
</head>

<?php
$content = json_decode(file_get_contents('/data/menu-2024-primavera.json'), false);
$show_closed = DateTime::createFromFormat('Y-m-d', $content->closing)->modify('+1 day') < new DateTime();

$formatter_opening = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d');
$formatter_closing = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d\'&nbsp;\'MMMM');
?>

<body>
    <section class="section">
        <div class="container">
            <h1 class="title is-2">
                Taverna Gaita San&nbsp;Giorgio
            </h1>

            <div class="subtitle is-6">
<?php if($show_closed) { ?>
                La taverna è chiusa.
<?php } else { ?>
                Aperti da <?= $formatter_opening->format(DateTime::createFromFormat('Y-m-d', $content->opening)) ?> a <?= $formatter_closing->format(DateTime::createFromFormat('Y-m-d', $content->closing)) ?>.
<?php } ?>
            </div>

<?php if(!$show_closed) { ?>

            <div class="wide-columns">

    <?php foreach($content->servings as $serving) { ?>

                <div class="block serving">
                    <h2 class="title is-5">
                        <span>
                            <?= $serving->name; ?>
                        </span>
                    </h2>

                    <ol class="menu-list" role="list">

                    <?php
                    foreach($serving->dishes as $dish) {
                        $vegetarian = isset($dish->vegetarian) && $dish->vegetarian ? '&nbsp;<i class="fa-solid fa-leaf vegetarian"></i>' : '';
                        $details = isset($dish->details) ? ' <span class="details">' . $dish['details'] . '</span>' : '';
                        ?>

                        <li>
                            <div class="dish"><?= $dish->name ?><?= $details ?><?= $vegetarian ?><span class="leaders" aria-hidden="true"></span></div>
                            <div class="price">€&nbsp;<span class="units">9</span>,00</div>
                            <?php if(isset($dish->description)) { ?><div class="description"><?= $dish->description ?></div><?php } ?>
                        </li>

                        <?php
                    }
                    ?>

                    </ol>
                </div>

    <?php } ?>

<?php } ?>

            </div>

        </div>

    </section>

    <section class="section">

        <div class="container thin">

            <div class="card">
                <div class="card-content">
                    <h2 class="title is-3">Aperture e prenotazioni</h2>

                    <p class="has-text-centered mt-4">
                        <?php if($show_closed) { ?>
                        <a class="button is-info" href="mailto:info@gaitasangiorgio.com">
                            <span class="icon is-small">
                                <i class="fas fa-solid fa-envelope"></i>
                            </span>
                            <span>Scrivici</span>
                        </a>
                        <?php } else { ?>
                        <a class="button is-info" href="tel:3409320270">
                            <span class="icon is-small">
                                <i class="fas fa-solid fa-phone"></i>
                            </span>
                            <span>Chiamaci per prenotare</span>
                        </a>
                        <?php } ?>
                    </p>

                    <table class="table is-striped is-hoverable is-fullwidth mt-6">
                        <thead>
                            <tr>
                                <th>Giorno</th>
                                <th>Pranzo</th>
                                <th>Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Giovedì 19&nbsp;giugno</td>
                                <td>—</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Venerdì 20&nbsp;giugno</td>
                                <td>—</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Sabato 21&nbsp;giugno</td>
                                <td>12:30</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Domenica 22&nbsp;giugno</td>
                                <td>12:30</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Lunedì 23&nbsp;giugno</td>
                                <td>—</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Martedì 24&nbsp;giugno</td>
                                <td>—</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Mercoledì 25&nbsp;giugno</td>
                                <td>—</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Giovedì 26&nbsp;giugno</td>
                                <td>—</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Venerdì 27&nbsp;giugno</td>
                                <td>—</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Sabato 28&nbsp;giugno</td>
                                <td>12:30</td>
                                <td>19:30</td>
                            </tr>
                            <tr>
                                <td>Domenica 29&nbsp;giugno</td>
                                <td>12:30</td>
                                <td>19:30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>

    <section class="section">

        <div class="container thin">

            <div class="card">
                <div class="card-content">
                    <h2 class="title is-3">Dove siamo?</h2>

                    <p class="mb-2">La nostra taverna si trova in <b>Piazza del Cirone</b> a Bevagna&nbsp;(PG).</p>
                    <p class="mb-2">La puoi raggiungere facilmente da una traversa di Corso Matteotti, in prossimità di Piazza Filippo Silvestri, la piazza centrale di Bevagna.</p>

                    <p>
                        <a href="https://goo.gl/maps/NMM87WJHDqdbE2u87">
                            <img src="mappa-bevagna-taverna-gaita-san-giorgio.jpg" alt="Cartina di Bevagna" />
                        </a>
                    </p>
                </div>
            </div>

        </div>

    </section>
</body>

<style type="text/css">
html {
    font-size: 16px;
    @media (min-width: 769px) {
        font-size: 18px;
    }
    @media (min-width: 1024px) {
        font-size: 22px;
    }
}
h1, h2, h3, h4 {
    font-family: 'Pfeffer Medieval regular', serif;
}
h1.title {
    margin-bottom: 2.5rem !important;
    @media (min-width: 1408px) {
        margin-bottom: 3rem !important;
        text-align: center;
    }
}
h2.title {
    color: #990000;
}
h2.title span {
    border-bottom: solid 2px #990000;
}
.subtitle {
    @media (min-width: 1408px) {
        text-align: center;
    }
}

.wide-columns {
    column-gap: 3em;
    column-rule: solid 2px #990000;
    @media (min-width: 1408px) {
        column-count: 2;
    }
}
.wide-columns .block {
    break-inside: avoid-column;
}

.container.thin {
    @media (min-width: 1024px) {
        max-width: 1024px !important;
    }
}

ol.menu-list {
    list-style: none;
    margin: 0;
    padding: 0;
}
ol.menu-list li {
    margin: 0 0 0.5rem 0;
    padding: 0;

    display: grid;
    grid-template-columns: auto max-content;
    grid-template-rows: auto auto;
    align-items: end;
}
ol.menu-list li:last-of-type {
    margin: 0;
}
ol.menu-list li .dish {
    position: relative;
    overflow: hidden;

    font-weight: bold;
    margin-right: 6px;
}
ol.menu-list li .dish .vegetarian {
    color: darkgreen;
}
ol.menu-list li .dish .details {
    font-weight: normal;
    font-style: italic;
}
ol.menu-list li .dish .leaders::after {
    position: absolute;
    padding-left: .25ch;
    content: " . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . "
        ". . . . . . . . . . . . . . . . . . . . . . . ";
    text-align: right;
}
ol.menu-list li .price {
    font-size: 0.75rem;
    min-width: 4ch;
    font-variant-numeric: tabular-nums;
    text-align: right;
}
ol.menu-list li .price .units {
    font-size: 1rem;
    font-weight: bold;
}
ol.menu-list li .description {
    font-size: 0.75rem;
}
</style>

</html>

<!-- E la bona pace a vue! 👋 -->
