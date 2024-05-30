<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PokemonController extends Controller
{    public function show()
    {
        try {
            $client = new Client(['verify' => false]);
            $response = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=100');
            $allPokemons = json_decode($response->getBody(), true)['results'];
            return view('pokemon', ['allPokemons' => $allPokemons]);
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getPokemonData($name)
    {
        try {
            $client = new Client(['verify' => false]);
            $response = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon/' . $name);
            $pokemonData = json_decode($response->getBody(), true);
            return response()->json($pokemonData);
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
