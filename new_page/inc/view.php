<?php

class BitTestView {
	
	public static function generate_view($results) {
	
		$output = '<ul>';
		
		$output  = '<form>';
		$output .= 'Nume pagina: <input type="text" name="title" placeholder="Adauga numele paginii">';
		$output .= 'Continut: <input type="text" name="page_body" placeholder="Adauga continut">';
		$output .= '<input type="submit" value="Adauga">';
		$output .= '</form><hr>';
			
	foreach ($results as $result) {
		
		$post = $result->post_title;
		$link = get_permalink($result);
		
		$output .= '<li><a href="'.$link.'">'.$post.'</a></li>';
			
	}
		
		$output .= '</ul><hr>';
		
		return $output;
		
	}

}

