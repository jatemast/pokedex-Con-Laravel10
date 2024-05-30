<!DOCTYPE html>
<html>
<head>
    <title>Pokedex</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-image: url('https://i.ibb.co/gj6MtVh/icegif-5810.gif');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: 'Pokemon Solid', sans-serif;
        }

        #pokemonDetails {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }

        #pokemonDetails img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            padding: 20px;
            background-color: white;
        }


        .pokedex-title {
            font-family: 'Pokemon Solid', sans-serif;
            font-size: 3rem;
            color: #3b4cca;
            text-shadow: -1px -1px 0 #ffffff, 1px -1px 0 #ffffff, -1px 1px 0 #ffffff, 1px 1px 0 #ffffff;
        }
    </style>
</head>
<body>
    <h1 class="text-center mb-5 pokedex-title">Pokedex</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <select id="pokemonSelect" class="form-control">
                    @foreach ($allPokemons as $pokemon)
                        <option value="{{ $pokemon['name'] }}">{{ $pokemon['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="pokemonDetails"></div>
    </div>
    <div class="pokeball"></div>

    <script>
        $(document).ready(function() {
            $('#pokemonSelect').change(function() {
                var pokemonName = $(this).val();
                loadPokemonDetails(pokemonName);
            });

            // Carga los detalles del primer Pokémon al cargar la página
            loadPokemonDetails($('#pokemonSelect').val());
        });

        function loadPokemonDetails(pokemonName) {
            $.ajax({
                url: '/pokemon/' + pokemonName,
                type: 'GET',
                success: function(response) {
                    $('#pokemonDetails').html(generatePokemonDetailsHTML(response));
                },
                error: function() {
                    alert('Error al cargar los detalles del Pokémon.');
                }
            });
        }

        function generatePokemonDetailsHTML(pokemonData) {
            var html = '<h2 class="text-capitalize">' + pokemonData.name + '</h2>';
            html += '<div class="rounded-circle p-4 bg-white"><img src="' + pokemonData.sprites.front_default + '" alt="' + pokemonData.name + '" class="img-fluid"></div>';
            html += '<h3>Abilities:</h3><ul class="list-group">';
            pokemonData.abilities.forEach(function(ability) {
                html += '<li class="list-group-item">' + ability.ability.name + '</li>';
            });
            html += '</ul>';
            // Agrega aquí más detalles según tus necesidades

            return html;
        }
    </script>
</body>
</html>
