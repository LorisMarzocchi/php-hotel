<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];


$parkingFilter = isset($_GET['parking']) ? $_GET['parking'] : '';
$voteFilter = isset($_GET['vote']) ? $_GET['vote'] : '';

// Array hotel filtrati
$filteredHotels = [];


foreach ($hotels as $hotel) {
    $addHotel = true;

    // Verifica entrambi i filtri
    if (!empty($parkingFilter) && !empty($voteFilter)) {
        if (($parkingFilter == 'Con parcheggio' && !$hotel['parking']) || ($parkingFilter == 'Senza parcheggio' && $hotel['parking']) || ($hotel['vote'] < $voteFilter)) {
            $addHotel = false;
        }
    } else {
        // Verifica filtri singoli
        if (!empty($parkingFilter) && $parkingFilter == 'Con parcheggio' && !$hotel['parking']) {
            $addHotel = false;
        }

        if (!empty($parkingFilter) && $parkingFilter == 'Senza parcheggio' && $hotel['parking']) {
            $addHotel = false;
        }

        if (!empty($voteFilter) && $hotel['vote'] < $voteFilter) {
            $addHotel = false;
        }
    }

    if ($addHotel) {
        $filteredHotels[] = $hotel;
    }
}

// Se nessun filtro è selezionato, mostra tutti gli hotel non filtrati
if (empty($parkingFilter) && empty($voteFilter)) {
    $filteredHotels = $hotels;
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-HOTEL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
</head>

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-size: 1.2rem;
    }

</style>

<body>
    <div class="container mt-5">
    <form action="" method="GET">
        <div>
            <label class="me-2" for="parking">Parking</label>
            <select id="parking" name="parking">
                <option name="" selected>Seleziona</option>
                <option value="Con parcheggio">Con parcheggio</option>
                <option value="Senza parcheggio">Senza parcheggio</option>
            </select>
            <label class="ms-5 me-2" for="vote">Voto</label>
            <input type="number" name="vote" id="vote">

            <button class="btn btn-primary ms-5" type="submit">FILTRA</button>
		</div>
    </form>
        <table class="table mt-5">
            <thead>
                <tr class="table-dark">
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Voto</th>
                    <th scope="col">Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredHotels as $hotel){ ?>
                    <tr>
                        <td><?= $hotel['name'] ?></td>
                        <td><?= $hotel['description'] ?></td>
                        <td><?= $hotel['parking'] ? 'Sì' : 'No' ?></td>
                        <td><?= $hotel['vote'] ?></td>
                        <td><?= $hotel['distance_to_center'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>