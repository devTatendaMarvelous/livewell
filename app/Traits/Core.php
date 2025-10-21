<?php

namespace App\Traits;

trait Core
{


    function getSpecies(){
        return ['Sheep' ,'Poultry', 'Cattle', 'Pig', 'Goat', 'Dog'];
    }
    function getBreeds()
    {
        $filePath = public_path('breeds.json');
        if (!file_exists($filePath)) {
            return [];
        }

        $jsonData = file_get_contents($filePath);
        $data = json_decode($jsonData, true);
        if ($data === null) {
            return [];
        }

        $result = [];

        foreach ($data as $item) {
            if (empty($item['species']) || !isset($item['breed'])) {
                continue;
            }

            $species = trim($item['species']);
            if ($species === '') {
                continue;
            }

            if (!isset($result[$species])) {
                $result[$species] = [];
            }

            $keySigns = $item['breed'];
            $rawSigns = [];

            if (is_array($keySigns)) {
                $rawSigns = $keySigns;
            } elseif (is_string($keySigns)) {
                $rawSigns = preg_split('/[;,|]+/', $keySigns);
            }

            foreach ($rawSigns as $sign) {
                if (!is_string($sign)) {
                    continue;
                }
                // normalize whitespace and trim
                $s = trim($sign);
                $s = preg_replace('/\s+/', ' ', $s);
                if ($s === '') {
                    continue;
                }

                // use lowercase key for deduplication but preserve first occurrence casing
                $lower = mb_strtolower($s);
                if (!isset($result[$species][$lower])) {
                    $result[$species][$lower] = str_replace(' ', '_', $s);
                }
            }
        }

        // convert per-species maps to indexed arrays preserving first-occurrence casing
        foreach ($result as $sp => $map) {
            $result[$sp] = array_values($map);
        }


        return $result;
    }

    function getAges()
    {
        return [
            "Adult",
            "Neonate",
            "Juvenile",
            "Senior",
            "Calf",
        ];
    }


function getSigns()
{
    $filePath = public_path('signs.json');
    if (!file_exists($filePath)) {
        return [];
    }

    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);
    if ($data === null) {
        return [];
    }

    $result = [];

    foreach ($data as $item) {
        if (empty($item['species']) || !isset($item['key_signs'])) {
            continue;
        }

        $species = trim($item['species']);
        if ($species === '') {
            continue;
        }

        if (!isset($result[$species])) {
            $result[$species] = [];
        }

        $keySigns = $item['key_signs'];
        $rawSigns = [];

        if (is_array($keySigns)) {
            $rawSigns = $keySigns;
        } elseif (is_string($keySigns)) {
            $rawSigns = preg_split('/[;,|]+/', $keySigns);
        }

        foreach ($rawSigns as $sign) {
            if (!is_string($sign)) {
                continue;
            }
            // normalize whitespace and trim
            $s = trim($sign);
            $s = preg_replace('/\s+/', ' ', $s);
            if ($s === '') {
                continue;
            }

            // use lowercase key for deduplication but preserve first occurrence casing
            $lower = mb_strtolower($s);
            if (!isset($result[$species][$lower])) {
                $result[$species][$lower] = str_replace(' ', '_', $s);
            }
        }
    }

    // convert per-species maps to indexed arrays preserving first-occurrence casing
    foreach ($result as $sp => $map) {
        $result[$sp] = array_values($map);
    }


    return $result;
}




    function getSymptoms()

    {
        $filePath = public_path('symptoms.json');
        if (!file_exists($filePath)) {
            return [];
        }

        $jsonData = file_get_contents($filePath);
        $data = json_decode($jsonData, true);
        if ($data === null) {
            return [];
        }

        $result = [];

        foreach ($data as $item) {
            if (empty($item['species']) || !isset($item['symptoms_list'])) {
                continue;
            }

            $species = trim($item['species']);
            if ($species === '') {
                continue;
            }

            if (!isset($result[$species])) {
                $result[$species] = [];
            }

            $keySigns = $item['symptoms_list'];
            $rawSigns = [];

            if (is_array($keySigns)) {
                $rawSigns = $keySigns;
            } elseif (is_string($keySigns)) {
                $rawSigns = preg_split('/[;,|]+/', $keySigns);
            }

            foreach ($rawSigns as $sign) {
                if (!is_string($sign)) {
                    continue;
                }
                // normalize whitespace and trim
                $s = trim($sign);
                $s = preg_replace('/\s+/', ' ', $s);
                if ($s === '') {
                    continue;
                }

                // use lowercase key for deduplication but preserve first occurrence casing
                $lower = mb_strtolower($s);
                if (!isset($result[$species][$lower])) {
                    $result[$species][$lower] = str_replace(' ', '_', $s);
                }
            }
        }

        // convert per-species maps to indexed arrays preserving first-occurrence casing
        foreach ($result as $sp => $map) {
            $result[$sp] = array_values($map);
        }


        return $result;
    }

}
