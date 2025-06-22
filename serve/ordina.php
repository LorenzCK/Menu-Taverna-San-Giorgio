<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>Taverna Gaita San Giorgio — Ordine online</title>

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

    <script defer src="resources/VanillaQR.min.js"></script>
    <script defer src="https://api.pirsch.io/pa.js" id="pianjs" data-code="ZJn4CAIUmKxkxVjWzrRwt68NsXziBQf9"></script>
</head>

<?php
$content = json_decode(file_get_contents('/data/menu-2025-mercato.json'), false);
$show_closed = DateTime::createFromFormat('Y-m-d', $content->closing)->modify('+1 day') < new DateTime();

$formatter_opening = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d');
$formatter_closing = new IntlDateFormatter('it_IT', IntlDateFormatter::FULL, IntlDateFormatter::NONE, 'Europe/Rome', IntlDateFormatter::GREGORIAN, 'cccc d\'&nbsp;\'MMMM');
?>

<body>
    <div id="qr-code-overlay" class="is-hidden">
        <div class="close">
            <a href="#">Chiudi&nbsp;<i class="fa-solid fa-xmark"></i></a>
        </div>

        <div id="qr-code-output" class="output">
        </div>

        <div class="instructions">
            <p>
                Presentare il codice alla cassa interna della Taverna per il pagamento.
            </p>
        </div>
    </div>

    <section class="section pb-2">
        <div class="container">
            <h1 class="title is-2">
                Taverna Gaita San&nbsp;Giorgio
            </h1>

<?php if($show_closed) { ?>
            <div class="subtitle is-6">
                La taverna è chiusa.
            </div>
<?php } else { ?>

        </div>
    </section>
    <section class="section fullwidth pt-2">
        <div class="container">
            <p>Compila la tua comanda e presenta il QR&nbsp;code alla cassa interna della Taverna per il pagamento.</p>
            <p>Se ti servono altre informazioni, <a href="/">consulta il menu completo</a>.</p>

            <div class="table-container mt-5">
                <table class="table is-narrow is-striped is-fullwidth order-table">
                    <tbody>
                        <tr class="dish" data-dish-id="<?= $content->coverCharge->id ?>" data-dish-count="0" data-dish-price="<?= number_format($content->coverCharge->price, 2, '.', '') ?>">
                            <td><button class="button is-link modifier subtracter">&ndash;</button></td>
                            <td class="count">0</td>
                            <td class="name">Numero di persone al tavolo</td>
                            <td class="price">€&nbsp;<?= number_format($content->coverCharge->price, 2, ',', '') ?></td>
                            <td class="has-text-right"><button class="button is-link modifier adder">+</button></td>
                        </tr>

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
                            <td class="count">0</td>
                            <td class="name">
                                <?= $dish->name ?>
                                <?php if(isset($dish->details)) { ?>
                                    <span class="details is-italic is-size-7">—&nbsp;<?= $dish->details ?></span>
                                <?php } ?>
                            </td>
                            <td class="price">€&nbsp;<?= number_format($dish->price, 2, ',', '') ?></td>
                            <td class="has-text-right"><button class="button is-link modifier adder">+</button></td>
                        </tr>
                        <?php } ?>
                    <?php } ?>
                        <tr class="total">
                            <td></td>
                            <td colspan="2" class="desc">Totale:</td>
                            <td class="value">€&nbsp;<span>0,00</span></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="has-text-centered mt-4 public">
                <button class="button is-info is-large" id="show-order">
                    <span class="icon"><i class="fas fa-cash-register"></i></span>
                    <span>Mostra ordine</span>
                </button><br />
                Clicca qui per mostrare l’ordine in cassa e procedere al pagamento.
            </p>

            <p class="has-text-centered mt-4 private is-hidden">
                <button class="button is-info is-large" id="print-order">
                    <span class="icon"><i class="fas fa-calculator"></i></span>
                    <span>Stampa ordine</span>
                </button>
            </p>

            <p class="has-text-centered mt-4 private is-hidden">
                <button class="button is-info is-large" id="reset-order">
                    <span class="icon"><i class="fas fa-rotate"></i></span>
                    <span>Reimposta a 0</span>
                </button>
            </p>

<?php } ?>
        </div>

    </section>

</body>

<script type="text/javascript">
let megaSecretUnlocker = 0;

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('h1.title').addEventListener('click', () => {
        megaSecretUnlocker++;
        if (megaSecretUnlocker >= 8) {
            document.querySelector('h1.title').innerHTML = 'Taverna Gaita San&nbsp;Giorgio — Gestione';
            document.querySelectorAll('.private').forEach(el => {
                el.classList.remove('is-hidden');
            });
        }
    });
});

let latestTotal = 0.0;

function recompute() {
    const dishes = document.querySelectorAll('.dish');

    latestTotal = 0.0;
    dishes.forEach(dish => {
        const count = parseInt(dish.dataset.dishCount, 10);
        const price = parseFloat(dish.dataset.dishPrice);
        latestTotal += count * price;

        dish.querySelector('button.subtracter').disabled = (count <= 0); // Disable subtracter if count is 0
    });

    document.querySelector('.total .value span').textContent = latestTotal.toFixed(2).replace('.', ',');
}

function generatePayload() {
    const dishes = document.querySelectorAll('.dish');
    let payload = '';
    dishes.forEach(dish => {
        const count = parseInt(dish.dataset.dishCount, 10);
        if (count > 0) {
            if(payload != '') {
                payload += '-';
            }

            const id = parseInt(dish.dataset.dishId, 10);
            payload += `${id}x${count}`;
        }
    });

    if(payload == '') {
        alert('Nessun piatto selezionato.');
        return null;
    }

    return payload;
}

document.addEventListener('DOMContentLoaded', () => {
    recompute();

    // Add +/- button event handlers
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

    // Add show order button handler
    document.getElementById('show-order').addEventListener('click', () => {
        const payload = generatePayload();
        if (payload === null) {
            return;
        }

        var qr = new VanillaQR({
            url: "GSG" + payload,
            size: 512,
            colorLight: "#ffffff",
            colorDark: "#000000",
            toTable: false, // Use canvas
            ecclevel: 2,
            noBorder: true,
            // borderSize: 4
        });
        const outputElement = document.getElementById('qr-code-output');
        outputElement.innerHTML = '';
        outputElement.appendChild(qr.domElement);

        document.getElementById('qr-code-overlay').classList.remove('is-hidden');
    });
    document.querySelector('#qr-code-overlay .close a').addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('qr-code-overlay').classList.add('is-hidden');
    });

    // Add print order button handler
    document.getElementById('print-order').addEventListener('click', () => {
        const base = 'https://<?= $_SERVER['SERVER_NAME'] ?><?= dirname($_SERVER["REQUEST_URI"]) ?>print?total=' + latestTotal.toFixed(2).replace(',', '.') + '&payload=';
        // console.log('Base URL: ' + base);

        const payload = generatePayload();
        if (payload === null) {
            return;
        }

        const destination = 'my.bluetoothprint.scheme://' + base + payload;
        // console.log(destination);

        window.location = destination;
    });

    document.getElementById('reset-order').addEventListener('click', () => {
        const dishes = document.querySelectorAll('.dish');
        dishes.forEach(dish => {
            dish.dataset.dishCount = 0;
            dish.querySelector('.count').textContent = 0;
        });

        recompute();
    });
});
</script>

</html>

<!-- E la bona pace a vue! 👋 -->
