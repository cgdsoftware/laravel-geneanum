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
     * @param string $type
     * @param array $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function call(string $type, array $data): mixed
    {
        $url = $this->setUrl($type);

        $response = $this->client->request('POST', $url, [
            'query' => $data
        ]);
        if($this->verify($response->getStatusCode())){
            return json_decode($response->getBody(), true);
        }

        throw new GeneanumException('Something went wrong', 500);

    }

}
