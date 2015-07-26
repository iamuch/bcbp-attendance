<div style="margin-bottom:10px; margin-top:10px">
	<div class="well" style="padding:10px"> 
			<h2 class="text-center">View All Services </h>
	</div>
</div>

<?php echo $this->Form->create('search',array(
				'url' => '/services/index',
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
          <th>Name</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach( $services as $service ){ ?>
	        <tr>
				<td><?php echo $service['Service']['name'] ?></td>
				<td style="text-align:center">
					<?php 
						echo $this->Html->link("Edit",[
								'controller'=>'services',
								'action'=>'edit',
								$service['Service']['id']
							],
							['class'=>'btn btn-info']
						);
					?>
				</td>
				<td style="text-align:center">
					<?php
						echo $this->Form->create('Service', [
								'controller' => 'services',
								'action' => 'delete',
								'onSubmit' => "return confirm('Are you sure?');"
						]);
						echo $this->Form->hidden('id', ['value' => $service['Service']['id']]);
						echo $this->Form->submit('Delete',['class' => 'btn btn-danger']);
					?> 
				</td>
	        </tr>
        <?php } ?>
      </tbody>
    </table>
</div>