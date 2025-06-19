<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Taverna Gaita San Giorgio — Menu</title>

    <link rel="stylesheet" href="fonts/pokoljaro.css" />
    <link rel="stylesheet" href="resources/bulma.min.css" />
    <link rel="stylesheet" href="resources/sangiorgio.css" />

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

    <script defer src="https://api.pirsch.io/pa.js" id="pianjs" data-code="ZJn4CAIUmKxkxVjWzrRwt68NsXziBQf9"></script>
</head>

<?php
$content = json_decode(file_get_contents('/data/menu-2025-mercato.json'), false);

$date_opening = DateTime::createFromFormat('Y-m-d', $content->opening);
$date_closing = DateTime::createFromFormat('Y-m-d', $content->closing);

$show_closed = (clone $date_closing)->modify('+1 day') < new DateTime();

$formatter_opening = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d');
$formatter_closing = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d\'&nbsp;\'MMMM');

function formatPrice($price) : string {
    list($price_units, $price_decimals) = explode('.', number_format($price, 2, '.', ''));
    return "<span class=\"units\">$price_units</span>,$price_decimals";
}
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
                Aperti da <?= $formatter_opening->format($date_opening) ?> a <?= $formatter_closing->format($date_closing) ?>.
<?php } ?>
            </div>

<?php if(!$show_closed) { ?>

            <div class="wide-columns">

    <?php foreach($content->servings as $serving) { ?>

                <div class="block serving">
                    <?php if(isset($serving->name)) { ?>
                    <h2 class="title is-5">
                        <span>
                            <?= $serving->name; ?>
                        </span>
                    </h2>
                    <?php } ?>

                    <ol class="menu-list" role="list">

                    <?php
                    foreach($serving->dishes as $dish) {
                        $vegetarian = isset($dish->vegetarian) && $dish->vegetarian ? '&nbsp;<i class="fa-solid fa-leaf vegetarian"></i>' : '';
                        $details = isset($dish->details) ? ' <span class="details">' . $dish->details . '</span>' : '';
                        ?>

                        <li>
                            <div class="dish"><?= $dish->name ?><?= $details ?><?= $vegetarian ?><span class="leaders" aria-hidden="true"></span></div>
                            <div class="price">€&nbsp;<?= formatPrice($dish->price) ?></div>
                            <?php if(isset($dish->description)) { ?><div class="description"><?= nl2br($dish->description) ?></div><?php } ?>
                        </li>

                        <?php
                    }
                    ?>

                    </ol>
                </div>

    <?php } ?>

    <?php if(isset($content->coverCharge->price) && $content->coverCharge->price > 0) { ?>

                <div class="block serving">
                    <ol class="menu-list" role="list">
                        <li>
                            <div class="dish">Coperto<span class="leaders" aria-hidden="true"></span></div>
                            <div class="price">€&nbsp;<?= formatPrice($content->coverCharge->price) ?></div>
                        </li>
                    </ol>
                </div>

    <?php } ?>

<?php } ?>

            </div>

<?php if(false && new DateTime() > $date_opening && !$show_closed) { ?>

            <p class="has-text-centered mt-4">
                <a class="button is-info" href="/ordina">
                    <span class="icon is-small">
                        <i class="fas fa-solid fa-pen"></i>
                    </span>
                    <span>Compila l’ordine online</span>
                </a>
            </p>

<?php } ?>

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
                        oppure
                        <a class="button is-info" href="https://reservation.carbonaraapp.com/Italia/Bevagna/Taverna-San-Giorgio">
                            <span class="icon is-small">
                                <i class="fas fa-solid fa-globe"></i>
                            </span>
                            <span>Prenota online</span>
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

</html>

<!-- E la bona pace a vue! 👋 -->
