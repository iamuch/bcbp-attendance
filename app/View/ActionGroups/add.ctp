<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<div style="margin-bottom:10px; margin-top:10px">
			<div class="well" style="padding:10px"> 
					<h2 class="text-center">Add Action Group </h>
			</div>
		</div>
		<div class="panel-body">
			<div id="rootwizard">
				<?php
					echo $this->Form->create('ActionGroup', [
						'novalidate'=> true,
						'class'=>'form-horizontal',
						'inputDefaults'=>[
							'format'=>['before', 'label', 'between', 'input', 'error', 'after'],
								'error'=>[
									'attributes' => ['class' => 'alert alert-danger alert-nopadding text-center']
							],
						]
					]);
				?>
				<div class="form-group">
				<?php echo $this->Form->label('name', 'Name', ['class'=>'col-sm-3 control-label']);?>
					<div class="col-sm-6">
					<?php echo $this->Form->input('name',['class' => 'form-control', 'label' => false, 'legend' => false]);?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-3 control-label"></div>
					<div class="col-sm-6 text-center">
					<?php echo $this->Form->end(_('Submit'), ['class' => 'btn btn-lg btn-block btn-primary']); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<hr>
