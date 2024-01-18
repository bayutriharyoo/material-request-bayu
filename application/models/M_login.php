<?php
 
class M_login extends CI_Model{
    function cek_login($table,$where){     
        return $this->db->get_where($table,$where);
    }

    function cek_users($username,$password)
	{
		$kondisi = array(
			'username' => $username,
			'password' => ($password),
		);

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where($kondisi);
		$this->db->limit(1);
		return $this->db->get();
	} 

    public function rules_user()
    {
        return [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ],
        ];
    }
}