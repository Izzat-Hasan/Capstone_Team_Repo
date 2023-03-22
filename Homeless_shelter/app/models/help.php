<?php
class help{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function gethelps(){
        $this->db->query(
            'SELECT *,
            CONCAT_WS(" ",help_name) as name
            FROM help
            ORDER BY help_name'
        );
        $result = $this->db->resultSet();
        return $result;

    }

    public function addhelp($data){
        $this->db->query('INSERT INTO help(help_name, help_email, help_number) VALUES(:help_name,:helpemail,:help_number)');

        $this->db->bind(':helpname', $data['help_name']);
        $this->db->bind(':help_email', $data['help_email']);
        $this->db->bind(':help_number', $data['help_number']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function updatehelp($data){
        $this->db->query('UPDATE help SET help_name= :help_name, help_email= :help_email, help_number= :help_number WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':help_name', $data['help_name']);
        $this->db->bind(':help_email', $data['help_email']);
        $this->db->bind(':help_number', $data['help_number']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function deletehelp($id){
        $this->db->query('DELETE FROM help WHERE id = :id');

        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    Public function gethelpById($id){
        $this->db->query('SELECT
        help.id as id,
        product.product_name as product,
        help.help_name as name,
        help.help_email as email,
        help.help_number as number
        FROM product RIGHT JOIN help ON product.product_id = help.id
        WHERE id = :id
        ');

    $this->db->bind(':id', $id);
    $row = $this->db->single();
    return $row;
    }
}
?>