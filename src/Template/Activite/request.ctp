<?php
	foreach($activites as $activite)
    {
        echo "\n".'<option value="'.$activite->CodeActivite.'">'.$activite->NomActivite.'</option>';
    }
?>