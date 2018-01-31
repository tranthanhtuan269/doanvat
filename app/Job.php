<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jobs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'number', 'expiration_date', 'work_time', 'public', 'description', 'requirement', 'benefit', 'time_start', 'city', 'district', 'position', 'experience', 'education', 'job_type', 'work_type', 'salary', 'gender', 'age', 'company', 'vip', 'branches', 'views', 'applied'];

    public function getJob($district, $city, $field, $job_type, $company, $cv, $vip, $from, $number_get){
        $ret_data = [];

            $sql = "SELECT 
                    jobs.id AS id, 
                    jobs.name AS name, 
                    jobs.number AS number, 
                    jobs.views as views, 
                    jobs.applied AS applied, 
                    jobs.expiration_date AS expiration_date, 
                    salaries.name AS salary, companies.logo, 
                    companies.name AS companyname, 
                    cities.name AS city, 
                    districts.name AS district 
                FROM 
                    jobs
                JOIN 
                    companies ON companies.id = jobs.company";
        if($field > 0 && $field < 6){
            $sql .= " JOIN 
                    company_company_types ON companies.id = company_company_types.company";
        }
            $sql .= " JOIN
                    salaries ON salaries.id = jobs.salary
                JOIN
                    cities ON cities.id = companies.city
                JOIN
                    districts ON districts.id = companies.district";

            $sql .= " WHERE 1 = 1";
        if($vip == 1){
            $sql .= " AND jobs.vip = 1";
        }else if($vip == 2){
            $sql .= " AND jobs.vip = 2";
        }

        if($job_type > 0){
            $sql .= " AND jobs.job_type = $job_type";
        }

        if($field > 0 && $field < 6){
            $sql .= " AND company_company_types.company_type = $field";
        }

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }

            $sql .= " ORDER BY jobs.id DESC";
            $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }

    public function getJobNumber($district, $city, $field, $job_type, $company, $cv, $vip){
        $ret_data = [];

            $sql = "SELECT 
                    count(jobs.id) AS number_job
                FROM 
                    jobs
                JOIN 
                    companies ON companies.id = jobs.company";
        if($field > 0 && $field < 6){
            $sql .= " JOIN 
                    company_company_types ON companies.id = company_company_types.company";
        }
            $sql .= " JOIN
                    salaries ON salaries.id = jobs.salary
                JOIN
                    cities ON cities.id = companies.city
                JOIN
                    districts ON districts.id = companies.district";

            $sql .= " WHERE 1 = 1";
        if($vip == 1){
            $sql .= " AND jobs.vip = 1";
        }else if($vip == 2){
            $sql .= " AND jobs.vip = 2";
        }

        if($job_type > 0){
            $sql .= " AND jobs.job_type = $job_type";
        }

        if($field > 0 && $field < 6){
            $sql .= " AND company_company_types.company_type = $field";
        }

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }

        return \DB::select($sql);
    }
}
