<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\CriteriaInterface;

class LimitOffsetCriteria implements CriteriaInterface
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply criteria in query repository.
     *
     * @param $model
     * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, \Prettus\Repository\Contracts\RepositoryInterface $repository)
    {
        $limit = $this->request->get('limit', null);
        $page = $this->request->get('page', null);

        if ($limit) {
            $model = $model->limit($limit);
        }

        if ($page && $limit) {
            $skip = ($page - 1) * $limit;
            $model = $model->skip($skip);
        }

        return $model;
    }
}
