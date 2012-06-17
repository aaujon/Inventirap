<?php include $_SERVER["DOCUMENT_ROOT"].'/Inventirap/phpqrcode/qrlib.php'; ?>

<h1>Category</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nom</th>
    </tr>

    <?php foreach ($categories as $cat): ?>
    <tr>
        <td><?php echo $cat['Category']['id_category']; ?></td>
        <td>
            <?php echo $this->Html->link($cat['Category']['name'],
array('controller' => 'category', 'action' => 'view', $cat['Category']['id_category'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
