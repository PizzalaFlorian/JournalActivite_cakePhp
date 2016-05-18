<style>
    div {
        align: center;
    }
</style>
<div>
	<h1>Certification de participation a l'experience</h1>
	<br>
	<h2>Candidat <?php echo $candidat['PrenomCandidat'].' '.$candidat['NomCandidat']; ?></h2>
	<br>
	<p> certifiant que le candidat as participé sur la période du <b><?php echo $debut; ?></b> au 
	<b><?php echo $fin; ?></b>, pour un totale de <b><?= $count ?></b> occupations mentionnée(s)</p>
</div>