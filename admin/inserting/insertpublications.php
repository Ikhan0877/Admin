
<div class="modal" id="myModal">
							<div class="modal-dialog modal-xl">
								<div class="modal-content">
                                <div class="modal-header">
                                <h4 style="color: #06367E;">BOOK / ARTICLE / CHAPTER / PAPER PUBLICATION</h4>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
		<div class="container card-2 py-3 my-2 px-5">
			<div class="row">
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">TITLE OF PUBLISH</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" name="" id="adtitle">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">NAME</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" name="" id="adname">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">DETAILS OF PUBLISHER</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" name="" id="addetail">
						</div>
					</div>
				</div>
				<div class="col-md-6  mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">TYPE</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<!-- <input type="text" class="form-rounded-1" name=""> -->
							<select class="form-control" id="adtype">
                                <option>BOOK</option>
                                <option>CHAPTER</option>
                                <option>PAPER</option>
                                <option>ARTICLE</option>
                            </select>
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">DATE</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<div class="input-group">
								<select name="" id="dateday" class="form-control">
									<?php 
										for($i=1;$i<=31;$i++){
											echo "<option value='$i'>$i</option>";
										}
									?>
								</select>
								<input type="text" id="datemonth" class="form-control" value="<?= $monthnum ?>" readonly="readonly".>
								<input type="text" id="dateyear" class="form-control" value="<?= $yearname ?>" readonly="readonly".>
							</div>
							<!--  -->
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">UGC APPROVAL</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<!-- <input type="text" class="form-control w-100" name=""> -->
							<select name="" id="adugc" class="form-control">
								<option value="Yes">Yes</option>
								<option value="No">No</option>
								<!-- <option value="Applied">Applied</option> -->
							</select>
						</div>
					</div>
				</div>
                <div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">BIBLIOGRAPHY</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" name="" id="adbiblo">
						</div>
					</div>
                </div>
                <div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 ">
							<label class="form-label pl-2">ISBN NO.</label>
						</div>
						<div class="col-md-6 p-0 ">
						<input type="text" hidden class="form-rounded-1" value="<?= $_GET['yearid'] ?>" name="adyearid" id="adyearid">
							<input type="text" hidden class="form-rounded-1" value="<?= $_GET['monthid'] ?>" name="admonthid" id="admonthid">
					
							<input type="text" class="form-control w-100" name="" id="adisbn">
						</div>
					</div>
				</div>
				<div class="col-md-6 mt-2">
					<div class="row">
						<div class="col-md-6 p-0 mt-2">
							<label class="form-label pl-2">VENUE</label>
						</div>
						<div class="col-md-6 p-0 mt-2">
							<input type="text" class="form-control w-100" name="" id="advenue">
						</div>
					</div>
                </div>
           
</div>
		</div>
		
		<div class="container card-2 mb-5">
			<input type="submit" class="btn btn-danger mx-2 my-4 " data-dismiss="modal" value="CANCLE" style="float: right; width: 10%; " name="">
			<button class="btn mx-2 w-30 my-4" style="float: right;background-color: #26CFE9; width: 10%; color: white;" id="addpublish">ADD</button>
        </div>
        
</div>
</div>
</div>