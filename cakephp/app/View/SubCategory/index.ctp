<h1>Sub category</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Nom</th>
    </tr>

    <?php foreach ($subCategories as $cat): ?>
    <tr>
        <td><?php echo $cat['SubCategory']['id_category']; ?></td>
        <td>
            <?php echo $this->Html->link($cat['SubCategory']['name'],
array('controller' => 'categorys', 'action' => 'view', $cat['SubCategory']['id_subcategory'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
