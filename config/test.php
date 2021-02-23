<form name="frmSearch" method="post" action="index.php">
	<input type="hidden" id="advance_search_submit" name="advance_search_submit" value="<?php echo $advance_search_submit; ?>">
	<div class="search-box">
		<label class="search-label">With Any One of the Words:</label>
		<div>
			<input type="text" name="search[with_any_one_of]" class="demoInputBox" value="<?php echo $with_any_one_of; ?>"	/>
			<span id="advance_search_link" onClick="showHideAdvanceSearch()">Advance Search</span>
		</div>				
		<div id="advanced-search-box" <?php if(empty($advance_search_submit)) { ?>style="display:none;"<?php } ?>>
			<label class="search-label">With the Exact String:</label>
			<div>
				<input type="text" name="search[with_the_exact_of]" id="with_the_exact_of" class="demoInputBox" value="<?php echo $with_the_exact_of; ?>"	/>
			</div>
			<label class="search-label">Without:</label>
			<div>
				<input type="text" name="search[without]" id="without" class="demoInputBox" value="<?php echo $without; ?>"	/>
			</div>
			<label class="search-label">Starts With:</label>
			<div>
				<input type="text" name="search[starts_with]" id="starts_with" class="demoInputBox" value="<?php echo $starts_with; ?>"	/>
			</div>
			<label class="search-label">Search Keywords in:</label>
			<div>
				<select name="search[search_in]" id="search_in" class="demoInputBox">
					<option value="">Select Column</option>
					<option value="title" <?php if($search_in=="title") { echo "selected"; } ?>>Title</option>
					<option value="description" <?php if($search_in=="description") { echo "selected"; } ?>>Description</option>
				</select>
			</div>
		</div>
		
		<div>
			<input type="submit" name="go" class="btnSearch" value="Search">
		</div>
	</div>
</form>