<?php

namespace FamilyTree365\Geneanum;

use FamilyTree365\Geneanum\Traits\Geneanum;

class GeneanumService
{
    use Geneanum;

    public $client;

    const SEARCH_TYPE = [
        'BURIALS' => 'burials',
        'MARIAGE' => 'mariage',
        'BAPTISM' => 'baptism'
    ];

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * @param string $_firstName
     * @param string $_lastName
     * @param int $_perPage
     * @param int $_row
     * @param int $_sidx
     * @param int $_page
     * @return mixed
     * @throws \GeneanumException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchBurials(
        string $_firstName,
        string $_lastName,
        int    $_perPage = 100,
        int    $_row = 100,
        int    $_sidx = 100,
        int    $_page = 1,
    ): mixed
    {
        $data = [
            'prenom' => $_firstName,
            'nom' => $_lastName,
            'annee_limite' => $_perPage, // 100
            'row' => $_row, // 100
            'sidx' => $_sidx, // 100
            'start' => ($_perPage * $_page) - $_perPage, // 2,
        ];

        return $this->search(self::SEARCH_TYPE['BURIALS'], $data);
    }

    /**
     * @param string $_firstName
     * @param string $_lastName
     * @param int $_perPage
     * @param int $_row
     * @param int $_sidx
     * @param int $_page
     * @return mixed
     * @throws \GeneanumException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchBaptism(
        string $_firstName,
        string $_lastName,
        int    $_perPage = 100,
        int    $_row = 100,
        int    $_sidx = 100,
        int    $_page = 1,
    ): mixed
    {
        $data = [
            'prenom' => $_firstName,
            'nom' => $_lastName,
            'annee_limite' => $_perPage, // 100
            'row' => $_row, // 100
            'sidx' => $_sidx, // 100
            'start' => ($_perPage * $_page) - $_perPage, // 2,
        ];

        return $this->search(self::SEARCH_TYPE['BAPTISM'], $data);
    }

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
     * @throws \GeneanumException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function searchMariage(
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

        return $this->search(self::SEARCH_TYPE['MARIAGE'], $data);
    }

    /**
     * @param string $type
     * @param array $data
     * @return mixed
     * @throws \GeneanumException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(string $type, array $data): mixed
    {
        $url = $this->setUrl($type);

        $response = $this->client->request('POST', $url, [
            'query' => $data
        ]);
        if($this->verify($response->getStatusCode())){
            return json_decode($response->getBody(), true);
        }

        throw new \GeneanumException('Something went wrong', 500);

    }

}
