<?php namespace Benhawker\Pipedrive\Library;

use Benhawker\Pipedrive\Exceptions\PipedriveMissingFieldError;

/**
 * Pipedrive Persons Methods
 *
 * Persons are your contacts, the customers you are doing Deals with.
 * Each Person can belong to an Organization.
 * Persons should not be confused with Users.
 *
 */
class Pipelines
{
    /**
     * Hold the pipedrive cURL session
     * @var Curl Object
     */
    protected $curl;

    /**
     * Initialise the object load master class
     */
    public function __construct(\Benhawker\Pipedrive\Pipedrive $master)
    {
        //associate curl class
        $this->curl = $master->curl();
    }

    /**
     * Returns all pipelines
     *
     * @return array returns list of pipelines
     */
    public function getAll()
    {
        $rawRespomse    = $this->curl->get('pipelines');
        $result         = [];

        if (isset($rawRespomse['data'])) {
            return $rawRespomse['data'];
        }

        return [];
    }

    /**
     *
     * return pipeline by name
     * @param $needleName
     *
     * @return mixed
     */
    public function getByName($needleName) {
        $pipelines  = $this->getAll();

        foreach ($pipelines as $aPipeline) {
            if ($aPipeline['name'] == $needleName) {
                return $aPipeline;
            }
        }
    }
}
