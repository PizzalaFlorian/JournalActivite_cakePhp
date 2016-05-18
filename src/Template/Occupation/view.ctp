<div class="occupation view large-9 medium-8 columns content">
    <table class="vertical-table">
        <tr>
            <th><?= __('Date de debut') ?></th>
            <td><?= h($occupation->HeureDebut) ?></td>
        </tr>
        <tr>
            <th><?= __('Date de fin') ?></th>
            <td><?= h($occupation->HeureFin) ?></td>
        </tr>
        <tr>
            <th><?= __('Lieu') ?></th>
            <td><?= h($monLieu->NomLieux) ?></td>
        </tr>
        <tr>
            <th><?= __('Activité') ?></th>
            <td><?= h($monActivite->NomActivite) ?></td>
        </tr>
        <tr>
            <th><?= __('Compagnie') ?></th>
            <td><?= h($monCompagnie->NomCompagnie) ?></td>
        </tr>
        <tr>
            <th><?= __('Dispositif') ?></th>
            <td><?= h($monDispositif->NomDispositif) ?></td>
        </tr>

    </table>
</div>