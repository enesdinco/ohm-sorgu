<?php 

namespace flash;

class System{
    public static function filter($val,$tf = false){
        if($tf == false){$val = strip_tags($val);}
        $val = addslashes(trim($val));
        return $val;
    }
	
		public static function sansür($text) {
			$uzunluk = mb_strlen($text, 'UTF-8');
			$yarisi = ceil($uzunluk / 2);

			$baslangic = mb_substr($text, 0, $yarisi, 'UTF-8');
			$sansür = str_repeat('*', $yarisi);
			
			return $baslangic . $sansür;
	}

}

?>