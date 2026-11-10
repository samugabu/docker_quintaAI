<?php

namespace Model;
class PeopleRepository
{
    static function getPeople() : array
    {
        return [
            '1' => [
                'nome' => 'Alan',
                'cognome' => 'Turing',
                'nazionalita' => 'Inglese',
                'anno_nascita' => 1912,
                'immagine' => 'alanturing.webp',
                'desc-img' => 'Foto di Alan Turing, un matematico',
            ],
            '2' => [
                'nome' => 'Ada',
                'cognome' => 'Lovelace',
                'nazionalita' => 'Inglese',
                'anno_nascita' => 1815,
                'immagine' => '',
                'desc-img' => '',
            ],
            '3' => [
                'nome' => 'Grace',
                'cognome' => 'Hopper',
                'nazionalita' => 'Americana',
                'anno_nascita' => 1906,
                'immagine' => '',
                'desc-img' => '',
            ]
        ];
    }

    static function getPeopleByID(int $id): array
    {
        $persone = self::getPeople();
        return $persone[$id];
    }
}