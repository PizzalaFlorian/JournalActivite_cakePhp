<style>
    th {
        font-weight: bold;
        background-color: #BABABA;
    }
    tr {
    	text-align: center;
    }
    h2{
        text-align: center;
    }
    p{
    	text-align: center;
    	border-bottom: 1px solid black;
    }
</style>
<br>
<br>
<br>
<br>
<br>
<br>
<table border="1" cellpadding="1" width="100%">
    <thead>
    <tr>
        <th>
        	<br>
        	<h1>Certification de participation a l'experience du candidat <?php echo $candidat['PrenomCandidat'].' '.$candidat['NomCandidat']; ?></h1>
        	<br>
        </th>
    </tr>
    </thead>
    <tbody>
   		<tr>
            <td>
            	<br>
				<h2> Numéro Etudiant : <?php echo $codeEtu; ?></h2>
				<br>
			</td>
        </tr>
    </tbody>
</table>

<p>Certifiant que le candidat a participé sur la période du <b><?php echo $debut; ?></b> au 
<b><?php echo $fin; ?></b>,
<br>
pour un total de <b><?= $count ?></b> occupations mentionnée(s)</p>

<p> à la date du <?php echo $annee; ?> - Code génération <?php echo $code; ?></p>
<br>
<br>
<br>
<br>
<br>
<br>
<center><h2> Ce document devra être déposé à l'accueil</h2></center>
