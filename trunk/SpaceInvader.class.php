<?php
require_once('Avatar.class.php');
class SpaceInvader extends Avatar{

	private $spaceInvaderModel;
	
	public function __construct($size,$colors = null,$filter = null){
		
		$this->spaceInvaderModel = array(array(0,0,1,0,0,0),
							 	array(0,0,0,1,0,0),
							 	array(0,0,1,1,1,1),
							 	array(0,1,1,0,1,1),
							 	array(1,1,1,1,1,1),
							 	array(1,0,1,1,1,1),
							 	array(1,0,1,0,0,0),
							 	array(0,0,0,1,1,0));
		$this->initSize($size);
		$this->image = imagecreate($this->taille_x,$this->taille_y);
		if ($colors == null){
			$this->initColorList();
			$this->checkColors();
		}else{
			$this->primary_color = $colors[0];
			$this->secondary_color = $colors[0];
		}
		
		
		$this->initSpaceInvader();
		
		$this->drawImage($filter);
	}
	public function initColorList(){
		$this->colorList = array(
			imagecolorallocate($this->image,255,0,0), //"red" => 
			imagecolorallocate($this->image,0,255,0), //"green" => 
			imagecolorallocate($this->image,0,0,255), //"blue" => 
			imagecolorallocate($this->image,131,53,130), //"purple" => 
			imagecolorallocate($this->image,255,186,26), //"orange" => 
			imagecolorallocate($this->image,0,0,0), //"black" => 
			imagecolorallocate($this->image,249,237,4), //"yellow" => 
			imagecolorallocate($this->image,217,131,36) //"maroon" => 
		);
	}	
	public function initSize($size){
		$this->taille_x = ($size % 11 != 0 ? intval($size/11) * 11 : $size);
		$this->taille_y = intval($size/11) * 8;
		
		$this->pixel_x = $this->taille_x / 11;
		$this->pixel_y = $this->taille_y / 8;
	}
	
	public function initSpaceInvader(){
		$b = (($this->taille_x/$this->pixel_x)-1);
		for ($x = 0 ; $x <= (($this->taille_x/$this->pixel_x)/2) ; $x++)	{
			for ($y = 0 ; $y < ($this->taille_y/$this->pixel_y) ; $y++) {
				$this->grille[$x][$y] = $this->spaceInvaderModel[$y][$x] == 0 ? $this->primary_color : $this->secondary_color;
				
				if ($b > $this->taille_x/$this->pixel_x/2){
					$this->grille[$b][$y] = $this->spaceInvaderModel[$y][$x] == 0 ? $this->primary_color : $this->secondary_color;
				
				}
			}
			$b--;
		}	
	}	
} 
?>