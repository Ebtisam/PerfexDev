<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Get all staff by department
 * @param  string $departmentid Optional
 * @return array
 */
function get_all_staff_by_department($departmentid)
{
    $CI = & get_instance();
    if ($departmentid) {
        $CI->db->where('departmentid', $departmentid);
        $staffids = $CI->db->select('staffid')->from(db_prefix() . 'staff_departments')->get()->result_array();
    }else{
    	$staffids = [];
    }

    return $staffids;
}

/**
 * Get all client by group
 * @param  string $groupid Optional
 * @return array
 */
function get_all_client_by_group($groupid)
{
    $CI = & get_instance();

    if ($groupid) {
        $CI->db->where('groupid', $groupid);
        $clientids = $CI->db->select('customer_id')->from(db_prefix() . 'customer_groups')->get()->result_array();
    }else{
    	$clientids = [];
    }

    return $clientids;
}