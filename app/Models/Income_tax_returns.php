<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Income_tax_returns extends Model {

    use HasFactory;

    //use HasFactory;
    protected $table = 'income_tax_returns';
    protected $fillable = ['created_user_id',
        'itr_financial_year',
        'member_id',
        'first_name',
        'last_name',
        'pan_number',
        'pan_file',
        'father_name',
        'sex',
        'block_no',
        'name_of_Premises',
        'street',
        'locality',
        'city',
        'pin',
        'state',
        'country',
        'mobile',
        'status',
        'resident_status',
        'resident_status_details',
        'aadhaar_number',
        'email_address',
        'income_from_salary',
        'income_from_house',
        'share_transactions',
        'income_from_consultancy',
        'director_in_company',
        'current_status',
        'relationship',
        'relationship_other',
    ];

    public static function getStateRecord($table_name, $datatable_fields, $conditions_array, $search_parmenter, $getfiled, $request, $join_str = array()) {
        //DB::enableQueryLog();
        //console.log($table_name);
        $output = array();
        $data = DB::table($table_name)
                ->select($getfiled);

        if (!empty($join_str)) {
            //$data->where(function($query) use ($join_str) {
            foreach ($join_str as $join) {
                if (!isset($join['join_type'])) {
                    $data->join($join['table'], $join['join_table_id'], '=', $join['from_table_id']);
                } else {
                    $data->join($join['table'], $join['join_table_id'], '=', $join['from_table_id'], $join['join_type']);
                }
            }
            //});
        }
        if (!empty($conditions_array)) {
            $data->Where(function ($query) use ($request, $conditions_array) {
                foreach ($conditions_array as $conditions) {
                    $query->Where($conditions['key'], $conditions['relation'], $conditions['value']);
                }
            });
        }
        if (!empty($search_parmenter)) {
            $data->Where(function ($query) use ($request, $search_parmenter) {
                foreach ($search_parmenter as $conditions) {
                    $query->orWhere($conditions['key'], 'like', '%' . $conditions['value'] . '%');
                }
            });
        }

        if ($request['search']['value'] != '') {
            $data->where(function($query) use ($request, $datatable_fields) {
                for ($i = 0; $i < count($datatable_fields); $i++) {
                    if ($request['columns'][$i]['searchable'] == true) {
                        $query->orWhere($datatable_fields[$i], 'like', '%' . $request['search']['value'] . '%');
                    }
                }
            });
        }
        if (isset($request['order']) && count($request['order'])) {
            for ($i = 0; $i < count($request['order']); $i++) {
                if ($request['columns'][$request['order'][$i]['column']]['orderable'] == true) {
                    $data->orderBy($datatable_fields[$request['order'][$i]['column']], $request['order'][$i]['dir']);
                }
            }
        }
        $count = $data->count();

        $data->skip($request['start'])->take($request['length']);
        //print_r(DB::getQueryLog());exit;
        $output['recordsTotal'] = $count;
        $output['recordsFiltered'] = $count;
        $output['draw'] = $request['draw'];
        $output['data'] = $data->get();
        //$response['perPageCount'] = $i;

        return json_encode($output);
    }

}
