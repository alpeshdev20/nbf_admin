@section('ajaxreq')
{
	/*
	$('#add_app_mat_form').on('submit',function(e){
		e.preventDefault();
		let _form = document.forms['add_app_mat_form'];
		
		for(let i= -1; i<3; i++){
			let n = (i<0)?'':i;
			console.log(_form['genre_id'+n].value)
			console.log(_form['department_id'+n].value)
		}
		views\app_materials
		ajaxreq.blade.php
		create.blade.php
		fields.blade.php
		index.blade.php
	})
	*/
    let baseUrl = "<?php echo url('/'); ?>";
    $('.genreObject').on('change',function(){
		const _this = $(this);
		refreshDepartments(_this.data('index'),_this.val());
    });

    $('.deptObject').on('change', function(){	
		const _this = $(this);
		refreshSubjects(_this.data('index'),_this.val());
    });
	
	
	function refreshDepartments(_index,_genreId,_newValue){
		
		const index = (_index!=undefined)? _index : '';

		const dSel = $("select[name = 'department_id"+ index +"']");
		console.log("select[name = 'department_id"+ index +"']");
		
		if(!dSel)return;
		// empty department select and add new values
		dSel.find('option').remove().end()
		.append('<option value="">None</option>').val('');
		dSel.selectpicker('refresh');
		refreshSubjects(index,null);
		
		if(_genreId && _genreId!=""){
			loader.style.display = "block";
			$.ajax({
				url: baseUrl + "/api/getdepartment/" + _genreId,
				type: "get",
				success: function(data){
					loader.style.display = "none";
					let newData = data.data;
					for(var i in newData) {
					   dSel.append(`<option value="${i}">${newData[i]}</option>`); 
					} 
					//dSel.selectpicker();
					dSel.selectpicker('refresh');
					if(_newValue)dSel.val(_newValue);
				},
				error: function (jqXHR, exception) {
					loader.style.display = "none";
				}
			});
		} 
	}
	
	function refreshSubjects(_index,_departmentId,_newValue){
		
		const index = (_index!=undefined)?_index:'';
		const sSel = $("select[name = 'subject_id"+ index +"']");
		if(!sSel)return;
		
		// empty subject select
		sSel.find('option').remove().end()
		.append('<option value="">None</option>').val('');
		sSel.selectpicker('refresh');
		
		if(_departmentId && _departmentId!=""){
			loader.style.display = "block";
			$.ajax({
				url: baseUrl + "/api/getsubject/" + _departmentId,
				type: "get",
				success: function(data){
					loader.style.display = "none";
					let newData = data.data;
					for(var i in newData) {
						sSel.append(`<option value="${i}">${newData[i]}</option>`); 
					}
					sSel.selectpicker('refresh');
					if(_newValue)sSel.val(_newValue);
				},
				error: function (jqXHR, exception) {
					loader.style.display = "none";
				}
			});
		}
	}


@php

	function e2q($var){
		return ($var!='')?($var):"''";
	}
	function arrayValOrEmpty($array,$key){
		return (array_key_exists($key, $array) && $array[$key]!=null)?$array[$key]:"''";
	}
	$values = array();
	$indeces = ['','0','1','2'];
	if(!is_array($appMaterial))$appMaterial = $appMaterial->toArray();
	foreach($indeces as $i){
		$values['genre_id'.$i] = arrayValOrEmpty($appMaterial, 'genre_id'.$i);
		$values['department_id'.$i] = arrayValOrEmpty($appMaterial, 'department_id'.$i);
		$values['subject_id'.$i] = arrayValOrEmpty($appMaterial, 'subject_id'.$i);
	}
	//dd($values);
@endphp	
	

	
	
}
@endsection
