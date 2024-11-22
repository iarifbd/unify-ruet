<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {


    // Fetch all student or specific student information based on ID
    public function stuinfo($id = null) {
        // If an ID is provided, filter by that ID
        if ($id !== null) {
            $this->db->where('S_Id', $id);
        }

        // Order the results by 'id'
        $this->db->order_by('id', 'ASC');

        // Execute the query on the 'studentinformation' table
        $query = $this->db->get('studentinformation');

        // Return the result as an array
        return $query->result_array();
    }

    public function insertStudent($data) {
        return $this->db->insert('studentinformation', $data); // Insert the student
    }

    public function updateStudent($id, $data) {
        $this->db->where('S_Id', $id);
        return $this->db->update('studentinformation', $data); // Update the student
    }

    public function StuLedg() { 
        $this->db->select('
            S_Id,
            GROUP_CONCAT(DISTINCT gdate ORDER BY gdate ASC SEPARATOR ",") AS DueDates,  
            COUNT(DISTINCT gdate) AS DueDateCount,  
            SUM(CASE WHEN achead = "HC" THEN dr ELSE 0 END) AS HallCharge, 
            SUM(CASE WHEN achead = "HC_DF" THEN dr ELSE 0 END) AS DelayFine,
            SUM(CASE WHEN achead = "HC_P" THEN cr ELSE 0 END) AS Paid,
            SUM(CASE WHEN achead = "HC" THEN dr ELSE 0 END) + 
            SUM(CASE WHEN achead = "HC_DF" THEN dr ELSE 0 END) - 
            SUM(CASE WHEN achead = "HC_P" THEN cr ELSE 0 END) AS Outstanding
        ');
        $this->db->from('studentledger');
        $this->db->group_by('S_Id');
        $this->db->order_by('S_Id', 'ASC');
        $query = $this->db->get();

        // Return the result as an array
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }



    public function StuLedgDetails($id = null) {
       $this->db->select('
            gdate,
            S_Id,
            ldate,
            description,
            status, 
            SUM(CASE WHEN achead = "HC" THEN dr ELSE 0 END) AS HallCharge, 
            SUM(CASE WHEN achead = "HC_DF" THEN dr ELSE 0 END) AS DelayFine,
            SUM(CASE WHEN achead = "HC_P" THEN cr ELSE 0 END) AS Paid,
            COUNT(CASE WHEN status = "Due" THEN 1 ELSE NULL END) AS DueCount
            ');

        $this->db->from('studentledger');
        $this->db->where('S_Id', $id);
        $this->db->group_by('gdate', 'ASC');
        $this->db->order_by('gdate', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
        
    }

    public function accTopSheet($S_Id) {
        $this->db->select('
            gdate,
            S_Id,
            ldate,
            description,
            status, 
            SUM(CASE WHEN achead = "HC" THEN dr ELSE 0 END) AS HallCharge, 
            SUM(CASE WHEN achead = "HC_DF" THEN dr ELSE 0 END) AS DelayFine,
            SUM(CASE WHEN achead = "HC_P" THEN cr ELSE 0 END) AS Paid,
            COUNT(CASE WHEN status = "Due" THEN 1 ELSE NULL END) AS DueCount
            ');
        $this->db->from('studentledger');
        $this->db->where('S_Id', $S_Id);
        //$this->db->group_by('gdate');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function inv_due($S_Id) {
        $this->db->select('
                S_Id, gdate, sum(dr) AS TotalDue
            ');
        $this->db->from('studentledger');
        $this->db->where('S_Id', $S_Id);
        $this->db->where('status', 'Due');
        $this->db->group_by('gdate');
        $this->db->order_by('gdate');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }

    public function CartData($data) {
        if ($this->db->insert_batch('inv_records', $data)) {
            return $this->db->insert_id(); 
        }
        return false; 
    }


}
