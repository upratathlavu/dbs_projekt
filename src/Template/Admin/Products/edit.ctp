<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                //['action' => 'delete', $product->id],
                ['action' => 'delete', $product_id],
                //['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]
                ['confirm' => __('Are you sure you want to delete # {0}?', $product_id)]
            )
        ?></li>
		<hr>
        <li><?= $this->Html->link(__('Home'), ['prefix' => 'admin', 'controller' => 'Admin', 'action' => 'home']) ?></li>                       
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
<div class="products form large-10 medium-9 columns">
    <!--<?= $this->Form->create($product); ?>-->
    <?= $this->Form->create(); ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('product_category_id', ['options' => $productCategories, 'empty' => '(choose product category)']);
            echo $this->Form->input('unit_id', ['options' => $units, 'empty' => '(choose unit)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
