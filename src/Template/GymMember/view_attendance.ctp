<?php $session = $this->request->session()->read("User"); ?>
<script>
	$(document).ready(function(){
	$("#startDate").datepicker({
		
		dateFormat: '<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>',
		changeMonth: true,
		changeYear: true,
		onSelect: function() {
			var date = $('#startDate').datepicker('getDate');
			
			date.setDate(date.getDate());
			$("#endDate").datepicker("option","minDate", date);  
		}
	}); 
	$("#endDate").datepicker({
		
		
		dateFormat: '<?php echo $this->Gym->dateformat_PHP_to_jQueryUI($this->Gym->getSettings("date_format")); ?>',
		changeMonth: true,
		changeYear: true,
	}); 
});

</script>

<section class="content">
	<br>
	<div class="col-md-12 box box-default">		
		<div class="box-header">
			<section class="content-header">
			  <h1>
				<i class="fa fa-bars"></i>
				<?php echo __("View Attendance");?>
				<small><?php echo __("Member");?></small>
			  </h1>			 
			  <ol class="breadcrumb">
				<a href="<?php echo $this->Gym->createurl("GymMember","memberList");?>" class="btn btn-flat btn-custom"><i class="fa fa-bars"></i> <?php echo __("Member List");?></a>
			  </ol>
			</section>
		</div>
		<hr>
		<div class="box-body">							    
			<?php  
				echo $this->Form->create("",["class"=>"validateForm "]);
			?>
				<input type="hidden" value="<?php echo $session["id"];?>" name="uid">
				<div class="form-group col-md-3">
					<label for="exam_id"><?php echo __("Start Date");?></label>
					<input type="text" name="sdate" class="form-control" value="<?php echo ($view)?$this->Gym->get_db_format(date($this->gym->getSettings("date_format"),strtotime($s_date))):"";?>" id="startDate">
				</div>
				<div class="form-group col-md-3">
					<label for="exam_id"><?php echo __("End Date");?></label>
					<input type="text" name="edate" class="form-control" value="<?php echo ($view)?$this->Gym->get_db_format(date($this->gym->getSettings("date_format"),strtotime($e_date))):"";?>" id="endDate">
				</div>
				<div class="form-group col-md-3 button-possition">
					<label for="subject_id"></label>
					<input type="submit" class="btn btn-flat btn-success" value="<?php echo __("Go");?>" name="view_attendance">
				</div>	
			<?php echo $this->Form->end(); ?>
			
			<div class="clearfix"></div>
			<?php 
			if($view)
			{?>
			<table class="table col-md-12">
			<thead>
				<tr>
					<th width="200px"><?php echo __("Date");?></th>
					<th><?php echo __("Day");?></th>
					<th><?php echo __("Attendance");?></th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if(!empty($data))
				{
					foreach($data as $row)
					{
						$date = $row["attendance_date"]->format("Y-m-d");?>				
						<tr>
							<td><?php echo $this->Gym->get_db_format(date($this->gym->getSettings("date_format"),strtotime($date))); ?></td>
							<td><?php echo date("l",strtotime($date));?></td>
							<td><?php echo $row["status"];?></td>
						</tr>
				<?php }
				}
				 else{
					echo "<tr><td><i>No record found.</i></td></tr>";
				 } ?>
			</tbody>
			</table>
	  <?php } ?>
		</div>			
	</div>
</section>