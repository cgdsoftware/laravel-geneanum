<?php

namespace FamilyTree365\Geneanum\Traits;

use FamilyTree365\Geneanum\GeneanumService;

trait Geneanum
{

    /**
     * @param $type
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed|null
     */
    public function setUrl($type): mixed
    {
        return match ($type) {
            GeneanumService::SEARCH_TYPE['BURIALS'] => config('geneanum.burials'),
            GeneanumService::SEARCH_TYPE['BAPTISM'] => config('geneanum.baptism'),
            GeneanumService::SEARCH_TYPE['MARIAGE'] => config('geneanum.mariage'),
            default => null,
        };
    }

    /**
     * @param int $code
     * @return bool
     * @throws \GeneanumException
     */
    public function verify(int $code = 404): bool
    {
        if($code >= 200 && $code < 300){
            return true;
        }
        throw new \GeneanumException('Request Invalidated from Geneanum', $code);
    }
}
