<style>
    th {
        font-weight: bold;
    }
    tr {
    	text-align: center;
    }
    #bot{
    	text-align: center;
    }
</style>
<table border="1" cellpadding="1" width="100%">
    <thead>
    <tr>
        <th>
        	<br>
        	<h1>Certification de participation a l'experience du Candidat <?php echo $candidat['PrenomCandidat'].' '.$candidat['NomCandidat']; ?></h1>
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

<p>Certifiant que le candidat as participé sur la période du <b><?php echo $debut; ?></b> au 
<b><?php echo $fin; ?></b>, pour un totale de <b><?= $count ?></b> occupations mentionnée(s)</p>

<p> à la date du <?php echo $annee; ?> - Code génération <?php echo $code; ?></p>