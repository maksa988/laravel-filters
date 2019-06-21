<?php

namespace Maksa988\LaravelFilters;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

abstract class Filters
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * Filters constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param $builder
     *
     * @return mixed
     */
    public function apply($builder)
    {
        $this->builder = $builder;

        $this->getFilters()
            ->filter(function($filter) {
                return method_exists($this, $filter);
            })
            ->each(function($filter, $value) {
                $this->$filter($value);
            });

        return $this->builder;
    }

    /**
     * @return Collection
     */
    public function getFilters()
    {
        return collect($this->request->only($this->filters))->filter(function ($item) {
            return ! is_null($item);
        })->flip();
    }
}