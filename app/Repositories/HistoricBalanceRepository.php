<?php

namespace App\Repositories;

use App\Models\HistoricBalance;
use App\Repositories\BaseRepository;

/**
 * Class HistoricBalanceRepository
 * @package App\Repositories
 * @version August 14, 2020, 4:05 pm UTC
*/

class HistoricBalanceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'amount',
        'type',
        'Description'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HistoricBalance::class;
    }
}
