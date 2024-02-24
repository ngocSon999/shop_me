<?php
namespace App\Http\Services\Impl;

use App\Http\Services\BaseServiceInterface;
use Illuminate\Http\Request;

class BaseService implements BaseServiceInterface
{
    public function getDataBuilder(Request $request, $model = null): array
    {
        $sorts = $request->input('order');
        $Columns = $request->input('columns');

        $start = $request->input('start', 1);
        $length = $request->input('length', 10);
        $page = floor($start / $length) + 1;

        $dataQuery = $model::whereNotNull('id');
        if (isset($request->withRelation)) {
            $withRelation = $request->withRelation;
            $dataQuery->with($withRelation);
        }

        //Loại trừ cột khác với giá trị truyền vào
        if (isset($request->whereExcept)) {
            foreach ($request->whereExcept as $k => $v) {
                if (!empty($v)) {
                    $dataQuery->where($k, '!=', $v);
                }
            }
        }

        foreach ($sorts as $orderSort) {
            $orderSortColumn = $orderSort['column'];
            $dir = $orderSort['dir'];
            $field = $Columns[$orderSortColumn]['data'];
            if (!empty($field) && !empty($dir)) {
                $dataQuery->orderBy($field, $dir);
            }
        }
        // Tìm kiếm trên input search mặc định của Table
        $search = $request->input('search');
        if (isset($request->filter['searchColumns'])) {
            $searchInColumns = $request->filter['searchColumns'];
        }
        if (!empty($search['value']) && !empty($searchInColumns)) {
            $val = $search['value'];
            $dataQuery->where(function ($query) use ($val, $searchInColumns) {
                foreach ($searchInColumns as $column) {
                    $query->orwhere($column, 'like', "%{$val}%");
                }
            });
        }
        // Tìm kiếm với các input bên ngoài datatable
        if (isset($request->filter['inputFields'])) {
            $inputFields = $request->filter['inputFields'];
            $dataQuery->where(function ($query) use ($inputFields) {
                foreach ($inputFields as $key => $value) {
                    if ($value !== null) {
                        $query->where($key, $value);
                    }
               }
            });
        }

        /*
         * Tìm kiếm where like áp dụng khi dùng 1 ô input search ngoài table và khai  báo các cột được phép tìm kiếm
         * 'where_like' => [
                    'name' => $request->keyword,
                    'description' => $request->keyword,
                    'address' => $request->keyword,
                ],
         */
//        if (isset($request->filter['where_like'])) {
//            $inputFields = $request->filter['where_like'];
//            $dataQuery->where(function ($query) use ($inputFields) {
//                foreach ($inputFields as $key => $value) {
//                    if (!empty($value)) {
//                        $query->orwhere($key, 'like', "%${value}%");
//                    }
//                }
//            });
//        }

        // Tìm kiếm theo thời gian
        if (isset($request->filter['start_date'])) {
            $inputFields = $request->filter['start_date'];
            $dataQuery->where(function ($query) use ($inputFields) {
                foreach ($inputFields as $key => $value) {
                    if (!empty($value)) {
                        $query->whereDate($key,'>=', $value);
                    }
                }
            });
        }
        if (isset($request->filter['end_date'])) {
            $inputFields = $request->filter['end_date'];
            $dataQuery->where(function ($query) use ($inputFields) {
                foreach ($inputFields as $key => $value) {
                    if (!empty($value)) {
                        $query->whereDate($key,'<=', $value);
                    }
                }
            });
        }
        // Tìm kiếm theo id
        if (isset($request->filter['where_id'])) {
            $ids = $request->filter['where_id'];
            $dataQuery->where(function ($query) use ($ids) {
                foreach ($ids as $key => $value) {
                    if (!empty($value)) {
                        $query->where($key, $value);
                    }
                }
            });
        }
        // whereHas
        if (isset($request->filter['whereHas'])) {
            $whereHas = $request->filter['whereHas'];
            foreach ($whereHas as $relation => $array) {
                $dataQuery->whereHas($relation, function ($query) use ($array) {
                    if (!empty($array)) {
                        foreach ($array as $k => $val) {
                            if (!empty($val)) {
                                $query->where($k, $val);
                            }
                        }
                    }
                });
            }
        }
        $dataPaginate = $dataQuery->paginate($length, '*', 'lists', $page);
        $recordsTotal = $dataPaginate->total();

        return [
            'data' => $dataPaginate->all(),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsTotal
        ];
    }

    protected function formatDate($date): string
    {
        return date('Y-m-d H:i:s', strtotime($date));
    }
}
