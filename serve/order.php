<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>Taverna Gaita San Giorgio — Ordine online</title>

    <link rel="stylesheet" href="fonts/pfeffermedieval.css" />
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

    <script defer src="https://api.pirsch.io/pa.js"
        id="pianjs"
        data-code="ZJn4CAIUmKxkxVjWzrRwt68NsXziBQf9"></script>
</head>

<?php
$content = json_decode(file_get_contents('/data/menu-2025-mercato.json'), false);
$show_closed = DateTime::createFromFormat('Y-m-d', $content->closing)->modify('+1 day') < new DateTime();

$formatter_opening = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d');
$formatter_closing = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d\'&nbsp;\'MMMM');
?>

<body>
    <section class="section fullwidth">
        <div class="container">
            <h1 class="title is-2">
                Taverna Gaita San&nbsp;Giorgio
            </h1>

<?php if($show_closed) { ?>
            <div class="subtitle is-6">
                La taverna è chiusa.
            </div>
<?php } else { ?>

            <div class="table-container">
                <table class="table is-narrow is-striped is-fullwidth order-table">
                    <tbody>
                    <?php foreach($content->servings as $serving) { ?>
                        <?php if(isset($serving->name)) { ?>
                        <tr class="serving">
                            <td colspan="5">
                                <?= $serving->name ?>
                            </td>
                        </tr>
                        <?php } ?>

                        <?php foreach($serving->dishes as $dish) { ?>
                        <tr class="dish" data-dish-id="<?= $dish->id ?>" data-dish-count="0" data-dish-price="<?= number_format($dish->price, 2, '.', '') ?>">
                            <td><button class="button is-link modifier subtracter">&ndash;</button></td>
                            <td><?= $dish->name ?></td>
                            <td class="price">€&nbsp;<?= number_format($dish->price, 2, ',', '') ?></td>
                            <td class="count">0</td>
                            <td><button class="button is-link modifier adder">+</button></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                        <tr class="total">
                            <td colspan="2" class="desc">Totale:</td>
                            <td class="value">€&nbsp;<span>0,00</span></td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

<?php } ?>
        </div>

    </section>

</body>

<script type="text/javascript">
function recompute() {
    const dishes = document.querySelectorAll('.dish');

    let total = 0.0;
    dishes.forEach(dish => {
        const count = parseInt(dish.dataset.dishCount, 10);
        const price = parseFloat(dish.dataset.dishPrice);
        total += count * price;
    });

    document.querySelector('.total .value span').textContent = total.toFixed(2).replace('.', ',');
}

document.addEventListener('DOMContentLoaded', () => {
    const dishes = document.querySelectorAll('.dish');

    dishes.forEach(dish => {
        dish.querySelector('button.subtracter').addEventListener('click', () => {
            const count = parseInt(dish.dataset.dishCount, 10);

            if (count > 0) {
                dish.dataset.dishCount = count - 1;
                dish.querySelector('.count').textContent = count - 1;

                recompute()
            }
        });
        dish.querySelector('button.adder').addEventListener('click', () => {
            const count = parseInt(dish.dataset.dishCount, 10);

            dish.dataset.dishCount = count + 1;
            dish.querySelector('.count').textContent = count + 1;

            recompute()
        });
    });
});
</script>

</html>

<!-- E la bona pace a vue! 👋 -->
