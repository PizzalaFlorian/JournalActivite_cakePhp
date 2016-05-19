<?php
	foreach($lieux as $lieu)
    {
        echo "\n".'<option value="'.$lieu->CodeLieux.'">'.$lieu->NomLieux.'</option>';
    }
?>