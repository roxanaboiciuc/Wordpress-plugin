<?php

class BitTestModel {
	
	private $nr;
	private $db_conn;
	private $title;
	private $page_body;
	
	public function __construct($a, $b, $c, $d) {
		
		$this->nr = $a;
		$this->db_conn = $b;
		$this->title = $c;
		$this->page_body = $d;
	}
	
	public function get_data() {
		
		$posts = array(
			'sort_order' => 'ASC',
			'sort_column' => 'post_title',	
		);
		
		$results = get_pages($posts);
						
		$filtered_title = trim($this->title);
		$filtered_page_body = trim($this->page_body);
		
		if (!empty($this->title) && !empty($this->page_body)) {
				
			$query = $this->db_conn->prepare("INSERT INTO wp_posts VALUES ($filtered_title, $filtered_page_body)");
		
	
		} else {
			
			$query = $this->db_conn->prepare("SELECT post_title FROM wp_posts WHERE post_type='page' AND post_status = 'publish' ORDER BY post_date DESC");
			
		}
		
		$results = $this->db_conn->get_results($query, OBJECT);
		
		return $results;
		
		}		
	}