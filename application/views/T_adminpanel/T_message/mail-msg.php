<div class="col-md-12" >

	<p class="page-label">
		<img src="<?php echo getIcon()->home?>"  width="25"> 
		<span>adminpanel / message</span>
	</p>
	
</div>

<div class="col-md-12 table-ticket">   
	
	<div class="widget stacked widget-table action-table">

    	<select class="form-control" id="dataperpage" onChange="return load_table(this)">
			<option>5</option>
			<option>10</option>
			<option>50</option>
			<option>100</option>
			<option>500</option>
		</select>

		<div class="search-form">
			<input type="text" id="search" onKeyup="return load_table(this)" name="search" class="form-control" placeholder="Search ...">
		</div>
		
		<span id="table-result"></span>
				
			
	</div> 
</div>

<div class="col-md-12 page-space"></div>

