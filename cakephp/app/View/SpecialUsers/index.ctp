<h1>Users</h1>

<?php echo $this->Html->link('Add User', array('controller' => 'special_users', 'action' => 'add')); ?>

<table>
    <tr>
        <th>Id</th>
        <th>Ldap</th>
        <th>Role</th>
        <th>Action</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

<?php foreach ($special_users as $user): ?>
    <tr>
        <td>
        	<!-- <?php echo $user['SpecialUser']['id']; ?> -->
        	<?php echo $this->Html->link($user['SpecialUser']['id'], array('action' => 'view', $user['SpecialUser']['id']));?>
        </td>
        <td>
            <!-- <?php echo $this->Html->link($user['SpecialUser']['ldap'], array('action' => 'view', $user['SpecialUser']['id']));?> -->
            <?php echo $user['SpecialUser']['ldap']; ?>
        </td>
        <td>
            <!-- <?php echo $this->Html->link($user['SpecialUser']['ldap'], array('action' => 'view', $user['SpecialUser']['id']));?> -->
            <?php echo $user['SpecialUser']['role']; ?>
        </td>
        <td>
        	<?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $user['SpecialUser']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['SpecialUser']['id']));?>
        </td>
    </tr>
<?php endforeach; ?>


</table>