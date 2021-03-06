<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
		<hr>
        <li><?= $this->Html->link(__('Home'), ['prefix' => 'admin', 'controller' => 'Admin', 'action' => 'home']) ?></li>               
        <hr>    
        <!--<li><?//= $this->Html->link(__('Edit Unit'), ['action' => 'edit', $unit->id]) ?> </li>-->
        <li><?= $this->Html->link(__('Edit Unit'), ['action' => 'edit', $unit['id']]) ?> </li>
        <!--<li><?//= $this->Form->postLink(__('Delete Unit'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?> </li>-->
        <li><?= $this->Form->postLink(__('Delete Unit'), ['action' => 'delete', $unit['id']], ['confirm' => __('Are you sure you want to delete # {0}?', $unit['id'])]) ?> </li>
		<hr>
        <li><?= $this->Html->link(__('List Needs'), ['prefix' => 'admin', 'controller' => 'Needs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Need'), ['prefix' => 'admin', 'controller' => 'Needs', 'action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Users'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'add']) ?> </li>
        <hr>        
        <li><?= $this->Html->link(__('List Roles'), ['prefix' => 'admin', 'controller' => 'Roles', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['prefix' => 'admin', 'controller' => 'Roles', 'action' => 'add']) ?> </li>        
        <hr>
        <li><?= $this->Html->link(__('List Products'), ['prefix' => 'admin', 'controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['prefix' => 'admin', 'controller' => 'Products', 'action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Product Categories'), ['prefix' => 'admin', 'controller' => 'ProductCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Category'), ['prefix' => 'admin', 'controller' => 'ProductCategories', 'action' => 'add']) ?> </li>
        <hr>
        <li><?= $this->Html->link(__('List Units'), ['prefix' => 'admin', 'controller' => 'Units', 'action' => 'index']) ?> </li>    
        <li><?= $this->Html->link(__('New Unit'), ['prefix' => 'admin', 'controller' => 'Units', 'action' => 'add']) ?> </li> 
        <hr>
        <li><?= $this->Html->link(__('User Mode'), ['prefix' => '/', 'controller' => 'Needs', 'action' => 'index']) ?></li>                 
		<hr>
        <li><?= $this->Html->link(__('Logout'), ['prefix' => 'admin', 'controller' => 'Users', 'action' => 'logout']) ?></li>         
    </ul>
</div>
<div class="units view large-10 medium-9 columns">
    <!--<h2><?//= h($unit->name) ?></h2>-->
    <h2><?= h($unit['name']) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <!--<p><?//= h($unit->name) ?></p>-->
            <p><?= h($unit['name']) ?></p>
            <h6 class="subheader"><?= __('Abbreviation') ?></h6>
            <!--<p><?//= h($unit->abbreviation) ?></p>-->
            <p><?= h($unit['abbreviation']) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <!--<p><?//= $this->Number->format($unit->id) ?></p>-->
            <p><?= $this->Number->format($unit['id']) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Creation Date') ?></h6>
            <!--<p><?//= h($unit->creation_date) ?></p>-->
            <p><?= h($unit['creation_date']) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-9">
    <h4 class="subheader"><?= __('Related Products') ?></h4>
    <!--<?php //if (!empty($unit->products)): ?>-->
    <?php if (!empty($products)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Product Category Id') ?></th>
            <th><?= __('Unit Id') ?></th>
            <th><?= __('Creation Date') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <!--<?php //foreach ($unit->products as $products): ?>-->
        <?php foreach ($products as $product): ?>
        <tr>
            <!--<td><?//= h($products->id) ?></td>
            <td><?//= h($products->name) ?></td>
            <td><?//= h($products->description) ?></td>
            <td><?//= h($products->product_category_id) ?></td>
            <td><?//= h($products->unit_id) ?></td>
            <td><?//= h($products->creation_date) ?></td>-->

	    <td><?= h($product['p_id']) ?></td>
            <td><?= h($product['p_name']) ?></td>
            <td><?= h($product['p_description']) ?></td>
            <td><?= h($product['p_product_category_id']) ?></td>
            <td><?= h($product['p_unit_id']) ?></td>
            <td><?= h($product['p_creation_date']) ?></td>
            
            <td class="actions">
                <!--<?//= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $products->id]) ?>-->
		<?= $this->Html->link(__('View'), ['controller' => 'Products', 'action' => 'view', $product['p_id']]) ?>
                <!--<?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $products->id]) ?>-->
                <?= $this->Html->link(__('Edit'), ['controller' => 'Products', 'action' => 'edit', $product['p_id']]) ?>
                <!--<?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $products->id], ['confirm' => __('Are you sure you want to delete # {0}?', $products->id)]) ?>-->
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Products', 'action' => 'delete', $product['p_id']], ['confirm' => __('Are you sure you want to delete # {0}?', $product['p_id'])]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
