
	<div class="modal" id="myModal" >
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
                                <div class="modal-header">
                                <h4 style="color: #06367E;">STUDENTS/ FACULTY ACHIVEMENTS</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
		<div class="container card-2 py-3 my-2 px-5">
			<div class="row">
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							
							<label class="form-label">TOTAL NO.OF.DAYS</label>
						</div>
						<div class="col-md-6 ">
							<input type="text" class="form-control" name="adachtndays" id="adachtndays">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">FROM</label>
						</div>
						<div class="col-md-6 ">
							<!-- <input type="date" class="form-control" value="" class="form-control" name="adachfrom" id="adachfrom"> -->
							<div class="input-group">
								<select name="" id="fdateday" class="form-control">
									<?php 
										for($i=1;$i<=31;$i++){
											echo "<option value='$i'>$i</option>";
										}
									?>
								</select>
								<input type="text" id="fdatemonth" class="form-control" value="<?= $monthnum ?>" readonly="readonly".>
								<input type="text" id="fdateyear" class="form-control" value="<?= $yearname ?>" readonly="readonly".>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">TO</label>
						</div>
						<div class="col-md-6 ">
							<!-- <input type="date" class="form-control" min="<?php echo $row['year']; ?>-<?php echo $temp; ?>-01"  max="<?php echo $row['year']; ?>-<?php echo $temp; ?>-31" class="form-control" name="adachto" id="adachto"> -->
							<div class="input-group">
								<select name="" id="tdateday" class="form-control">
									<?php 
										for($i=1;$i<=31;$i++){
											echo "<option value='$i'>$i</option>";
										}
									?>
								</select>
								<input type="text" id="tdatemonth" class="form-control" value="<?= $monthnum ?>" readonly="readonly".>
								<input type="text" id="tdateyear" class="form-control" value="<?= $yearname ?>" readonly="readonly".>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">DURATION</label>
						</div>
						<div class="col-md-6 ">
							<input type="text" class="form-control" name="adachduration" id="adachduration">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">VENUE</label>
						</div>
						<div class="col-md-6 ">
							<input type="text" class="form-control" name="adachvenue" id="adachvenue">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">PARTICIPANT NAME</label>
						</div>
						<div class="col-md-6 ">
							<input type="text" class="form-control" name="adachpname" id="adachpname">
						</div>
					</div>
				</div>
				<input type="hidden" id="adachby" value="<?= $type ?>">
				<!-- <input type="hidden" id> -->
				<!-- <div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6">
							<label class="form-label">ACHIEVMENT BY</label>
						</div>
						<div class="col-md-6">
							<select name="adachby" id="adachby" class="form-control">
								<option value="Student">Student</option>
								<option value="Faculty">Faculty</option>
							</select> 
						</div>
					</div>
				</div> -->
			</div>
		</div>
		<div class="container card-2 py-3 my-2 px-5">
			<h4 class="text-primary mb-4">ABOUT THE ACHIEVMENT</h4>
			<div class="row">
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">TITLE OF THE PROGRAM</label>
						</div>
						<div class="col-md-6 ">
							<input type="text" class="form-control" name="adachprogramtitle" id="adachprogramtitle">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">TITLE OF PAPER ACHIEVMENT</label>
						</div>
						<div class="col-md-6 ">
							<input type="text" class="form-control" name="adachpapertitle" id="adachpapertitle">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-4">
					<div class="row">
						<div class="col-md-6 ">
							<label class="form-label">NATURE OF PARTICIPANT</label>
						</div>
						<div class="col-md-6 ">
							<input type="text" class="form-control" name="adachparticipant" id="adachparticipant">
							<input type="text" hidden class="form-control" value="<?php echo $row['yearid']; ?>" name="adyearid" id="adyearid">
							<input type="text" hidden class="form-control" value="<?php echo $row['monthid']; ?>" name="admonthid" id="admonthid">
						</div>
					</div>
				</div>
				
				
				
			</div>
		</div>

		<div class="container card-2 mb-5">
		<button type="button" class="btn mx-2 w-30 my-4 p-2" data-dismiss="modal" style="float: right;background-color: red; width: 10%; color: white;">CANCLE</button>
			<button type="submit" class="btn mx-2 w-30 my-4" style="float: right;background-color: #26CFE9; width: 10%; color: white;" id="addacheiment">ADD</button>
			
		</div>
</div>
</div>
</div>




		

