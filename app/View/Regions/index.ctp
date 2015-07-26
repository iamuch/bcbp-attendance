<div style="margin-bottom:10px; margin-top:10px">
	<div class="well" style="padding:10px"> 
			<h2 class="text-center">View All Regions </h>
	</div>
</div>

<?php echo $this->Form->create('search',array(
				'url' => '/regions/index',
				'type' => 'get'
			)); ?>
<div class="form-group">
	<div class="col-sm-2">
		<?php echo $this->Form->input('name',['class' => 'form-control', 'label' => false, 'legend' => false, 'default' => (isset($name)) ? $name : '', ]);?>
	</div>
 	<?php echo $this->Form->end(_('search'),['class' => 'btn btn-primary btn-sm', 'value' => 'search', 'id' => 'searchButton']);?>
</div>
<div class="panel-body">
    <table class="table table-bordered table-striped table-hover">
      <thead>
        <tr>
          <th><?php echo __('Name') ?></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach( $regions as $region ){ ?>
	        <tr>
				<td><?php echo $region['Region']['name'] ?></td>
				<td style="text-align:center">
					<?php 
						echo $this->Html->link("Edit",[
								'controller'=>'regions',
								'action'=>'edit',
								$region['Region']['id']
							],
							['class'=>'btn btn-info']
						);
					?>
				</td>
				<td style="text-align:center">
					<?php
						echo $this->Form->create('Region', [
								'controller' => 'regions',
								'action' => 'delete',
								'onSubmit' => "return confirm('Are you sure?');"
						]);
						echo $this->Form->hidden('id', ['value' => $region['Region']['id']]);
						echo $this->Form->submit('Delete',['class' => 'btn btn-danger']);
					?> 
				</td>
	        </tr>
        <?php } ?>
      </tbody>
    </table>
</div>