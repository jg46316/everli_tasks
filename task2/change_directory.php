<?php
class Path  {
    
public $currentPath;

    function __construct($path) {
        $this->currentPath = $path;
    } 

    public function cd($newPath) {
       $dir = explode('/', $this->currentPath);
        $cd  = explode('/', $newPath);
        $directory_up = 0;
        foreach($cd as $key => $value){
            if($value == '..'){
                $directory_up += 1;
                unset($cd[$key]);
            }
        }
        
        $directory = '';
        for($i=0; $i<= (count($dir)-1-$directory_up); $i++){
            $directory .= $dir[$i].(($i == (count($dir)-1-$directory_up)) ? '' : '/'); 
        }
        
        $tmp_cd = implode('/',$cd);
        $this->currentPath = $directory.(strlen($tmp_cd)>0 ? '/'.$tmp_cd : '');

        return $this->currentPath;
    }

}

$path = new Path('/a/b/c/d');
echo $path->cd('../x');