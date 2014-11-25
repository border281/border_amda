<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 */
class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    function all_users($id)
    {
        $query_users = $this->db->query("SELECT
                                             id,
                                            role_id,
                                            email,
                                            password,
                                            display_name,
                                            if(active=1,'SI','NO') as active,
                                            rfc,
                                            super_admin,
                                            create_for 
                                            FROM am_users 
                                            WHERE create_for = ".$id." ORDER BY email asc;");
        return $query_users;
        
    }//fin all_users
    
    function CreateNewuser($tabla,$datos)
    {
       if($this->db->insert($tabla,$datos))
                {
           return TRUE;
                } else {
                    return FALSE;
                }
    }// fin insert
    function CheckMail($ref)
    {
         $mail = $this->db->query("SELECT email  FROM am_users WHERE email = '".$ref."'");
                             if ($mail->num_rows() > 0)
                                    {
                                        return FALSE;
                                    }else {
                                        return TRUE;

                                    } 
    }
    
    function SelectUser($id)
    {
        $user= $this->db->query("SELECT * FROM am_users WHERE id = '".$id."'");
    if($user->num_rows()>0)
        {
        return $user;
        }else{
            return FALSE;
        }
        
    }
    function UpdateUser()
    {
        $update_user= 'UPDATE am_users as U 
                        SET  U.role_id = "'.$this->input->post('permisos').'",
                             U.email = "'.$this->input->post('email').'",
                             U.password = "'.sha1($this->input->post('password')).'",
                             U.display_name = "'.$this->input->post('username').'",
                             U.active = "'.$this->input->post('active').'",
                             U.rfc = "'.$this->input->post('rfc').'",
                             U.super_admin = "no",
                             U.create_for = "'.$this->input->post('id').'"
                        WHERE U.id = "'.$this->input->post('user_edit').'"';
        $query = $this->db->query($update_user);
        if($query)
            {
            return TRUE;
            }else{
                return FALSE;
            }
                                 
    }                   
}// fin class
