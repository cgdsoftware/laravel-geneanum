<?php

namespace FamilyTree365\Geneanum;

class MariageService extends GeneanumService
{
    /**
     * @param string $_firstNameMale
     * @param string $_lastNameMale
     * @param string $_firstNameFemale
     * @param string $_lastNameFemale
     * @param int $_perPage
     * @param int $_row
     * @param int $_sidx
     * @param int $_page
     * @return mixed
     * @throws GeneanumException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(
        string $_firstNameMale,
        string $_lastNameMale,
        string $_firstNameFemale,
        string $_lastNameFemale,
        int    $_perPage = 100,
        int    $_row = 100,
        int    $_sidx = 100,
        int    $_page = 1,
    ): mixed
    {
        $data = [
            'prenom_homme' => $_firstNameMale,
            'nom_homme' => $_lastNameMale,
            'prenom_femme' => $_firstNameFemale,
            'nom_femme' => $_lastNameFemale,
            'annee_limite' => $_perPage, // 100
            'row' => $_row, // 100
            'sidx' => $_sidx, // 100
            'start' => ($_perPage * $_page) - $_perPage, // 2,
        ];

        return $this->call(self::SEARCH_TYPE['MARIAGE'], $data);
    }
}
