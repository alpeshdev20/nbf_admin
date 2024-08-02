<script>
window.addEventListener('load', function(){
	let selectedIds = [];
	function checkJQ(){
		if(!window.$)setTimeout(checkJQ, 500)
			else setUp()
	}
	
	function setUp(){
		
		@if (isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 3)
				let pubSelected = $('#teacher_id');
  			@else
			 	let pubSelected = $('#publisher_id');
   			@endif
		
		let spi = pubSelected.val();
		let pbl = $('#pbooklist');
		let si = $('#selected_ids');
		
		function addBookIds(e){
			
			if(e.target.checked){
				// console.log("call c",e.target.value);
				let select_val = parseInt(e.target.value);
				if(selectedIds.indexOf(select_val)==-1)selectedIds.push(select_val)
			}else{
				let val = parseInt(e.target.value);
				let index_val = selectedIds.indexOf(val);
				// console.log("call u",selectedIds.indexOf(val));
				if(selectedIds.indexOf(val)>-1)selectedIds.splice(index_val, 1)
			}
			// console.log("selected val",selectedIds);
			si.val(selectedIds.join("|"))
		}
		
		
		$('#prescriber_id').on('change', function(e){
			$('#prescriber').val($('#prescriber_id option:selected').text());
		})
		

		pubSelected.on('change', function(e){
			//console.log(e.target.selectedIndex, e.target.value)
			getBookList(e.target.value)
		})
		
		let current_id= "";
		function getBookList(id){
			if(!(id && id!=''))return;
			@if (isset(Auth::user()->access->access_role) && Auth::user()->access->access_role == 3)
        		url = '{{ url('teacher-books') }}';
				data = { 'teacher_id': id};
  			@else
        		url = '{{ url('publisher-books') }}';
				data = { 'publisher_id': id};
   			@endif
			$.ajax({
				url: url,
				data: data,
				beforeSend:()=>{
					$('.selectItem').off('click')
					pbl.html('')
				},
			})
			.done(data=>{
				$('#data_list').DataTable().clear().destroy();
				let html = '';//Math.min(data.length, 15)		
				
				let selected_val = <?php if(isset($selected_books)){echo $selected_books;}else{ echo "[]";} ?>;
				
				if(current_id != "" && current_id != id){
					selected_val = [];
					selectedIds=[];
				}
				current_id = id;
				for(let i =0; i< data.length; i++){
					let checked = "";
					if(selected_val.includes(data[i].id))
					{
						checked = 'checked="checked"';
					}
				

					let yearCellContent = '<td>' + data[i].year + '</td>';
					if (<?php echo json_encode(Auth::user()->access->access_role); ?> == 3) {
						yearCellContent = '';
					}


					html+='<tr role="row" class="'+((i%2)?'odd':'even')+'">\
							<td align="center"><input type="checkbox" class="selectItem" value="'+data[i].id+'" '+checked+'></td>\
							<td>' + data[i].book_name + '</td>' +
							yearCellContent +
							'<td></tr>';
				}
				pbl.html(html);
				$('.selectItem').on('click', addBookIds);
				$('#data_list').DataTable({					
					retrieve: true,
					"pageLength": 25,
					lengthMenu: [
						[5,10, 25, 50, -1],
						[5,10, 25, 50, 'All'],
					],
					"columns": [
						{ "width": "3%" },
						null,
						null
					]
				});
				if(selected_val.length > 0)
				{
					// console.log(">>",selected_val);
					for (let index = 0; index < selected_val.length; index++) {
						selectedIds.push(selected_val[index]);
						si.val(selectedIds.join("|"));
					}
				}

			})
			.fail(err=>{
				console.log(err)
			})
			.always(()=>{
				// hide loading indicator
			})
		}
		
		getBookList(spi);
		$('#prescriber').val($('#prescriber_id option:selected').text());
		
	}
	
	
	
	
	
	checkJQ()
})
$(document).ready(function() {
	// $('#data_list').DataTable();	
} );
</script>