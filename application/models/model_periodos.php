<?php 
	class model_periodos extends CI_Model{
		
		function __construct(){
			parent::__construct(); //chama o construtor do model
		}
		
		/* EXEMPLO: PEGANDO APENAS UM VALOR
		function getFirstNames(){
			$this->load->database(); //Carrega a database
			$query = $this->db->query('SELECT firstName FROM users');
			
			if($query->num_rows() > 0 ){ //Retorna TRUE se tiver pelo menos 1 resultado
				return $query->result(); //Retorna um array com os resultados
			} else {
				return NULL;
			}
		}*/
		
		//PEGA TODAS AS TAREFAS
		function getPeriodos(){
			$this->load->database(); //Carrega a database
			$query = $this->db->query('SELECT * FROM periodos');
			
			if($query->num_rows() > 0 ){ //Retorna TRUE se tiver pelo menos 1 resultado
				return $query->result(); //Retorna um array com os resultados
			} else {
				return NULL;
			}
		}

		/* EXEMPLO: PEGANDO PELO ID
		function getUser($id){
			$this->load->database(); //Carrega a database
			$query = $this->db->query('SELECT * FROM users WHERE id = ' . $id);

			if($query->num_rows() > 0 ){ //Retorna TRUE se tiver pelo menos 1 resultado
				return $query->result(); //Retorna um array com os resultados
			} else {
				return NULL;
			}
		}*/
		
	}
?>