<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control', $isFree == 1 ? 'readonly' : '']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('plan_category', 'Plan Category:') !!}
    <select id="plan_category" name="plan_category" class='form-control text-dark' {{$isFree == 1 ? 'readonly' : ''}}>
        @foreach($category as $i => $value)
        <option value="{{$i}}" {{$subscriptionPlan->plan_category == $i  ? 'selected' : ''}}>{{$value}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('plan_paren_categories', 'Parent Plan Category:') !!}
    <select id="plan_parent_category_id" name="plan_parent_category_id" class='form-control text-dark'>
        @foreach($plan_paren_categories as $id => $name)
            <option value="{{ $id }}" {{ old('plan_paren_categories') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6 material }}" >
    {!! Form::label('configuration', 'Configuration Type:') !!}
    <select id="configuration_type" name="configuration_type" class='form-control text-dark'>
        @foreach($configuration as $i => $value)
            <option value="{{$i}}"  {{$subscriptionPlan->configuration_type == $i  ? 'selected' : ''}}>{{$value}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6 materialType {{ @$subscriptionPlan->configuration_type == 1 ? 'hide' : '' }}">
    {!! Form::label('allowed_material', 'Allowed Material:') !!}
    <select id="allowed_material" name="allowed_material[]" multiple="multiple" class='form-control text-dark'>
        @foreach($mdata as $data)
        <?php
        $selected = "";
        if (in_array($data->id, $selectedmdata))
            $selected = 'selected="selected"';
        ?>
        <option value="{{$data->id}}" <?php echo $selected  ?>>{{$data->material_type}}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-sm-6 col-lg-6 customizedType {{ @$subscriptionPlan->configuration_type == 0 ? 'hide' : '' }} {{$isFree == 1 ? 'hide' : ''}}">
    {!! Form::label('pubdata', 'Publisher:') !!}
    <select id="pubdata" name="allowed_publisher[]" multiple="multiple" class='form-control text-dark'>
        @foreach($pubdata as $data)
        <?php
        $selected = "";
        if (in_array($data->id, $selectedpublisher))
            $selected = 'selected="selected"';
        ?>
        <option class="subjectObject" value="{{$data->id}}" <?php echo $selected  ?>>{{$data->publisher}}</option>
        @endforeach
    </select>
</div>

<div class="col-sm-12 p-0 customizedType {{ @$subscriptionPlan->configuration_type == 0 ? 'hide' : '' }} {{$isFree == 1 ? 'hide' : ''}}">
    <div class="form-group col-sm-4 col-lg-4">
        {!! Form::label('genre_id', 'Genre:') !!}
        <select id="genre_id" name="allowed_genres[]" multiple="multiple" class='form-control text-dark genreObject genreload'>
            @foreach($genre as $data)
            <?php
            $selected = "";
            if (in_array($data->id, $selectedgenre))
                $selected = 'selected="selected"';
            ?>
            <option class="genreObject" value="{{$data->id}}" <?php echo $selected  ?>>{{$data->genre_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-4 col-lg-4 customizedType {{$isFree == 1 ? 'hide' : ''}}">
        {!! Form::label('department_id', 'Department:') !!}
        <select id="department_id" name="allowed_department[]" multiple="multiple" class='form-control text-dark deptObject genreload'>
            @foreach($getdept as $data)
            <?php
            $selected = "";
            if (in_array($data->id, $selecteddept))
                $selected = 'selected="selected"';
            ?>
            <option class="deptObject" value="{{$data->id}}" <?php echo $selected  ?>>{{$data->department_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-4 col-lg-4 customizedType {{$isFree == 1 ? 'hide' : ''}}">
        {!! Form::label('subject_id', 'Subject:') !!}
        <select id="subject_id" name="allowed_subject[]" multiple="multiple" class='form-control text-dark subjectObject genreload'>
            @foreach($getsub as $data)
            <?php
            $selected = "";
            if (in_array($data->id, $selectedsub))
                $selected = 'selected="selected"';
            ?>
            <option class="subjectObject" value="{{$data->id}}" <?php echo $selected  ?>>{{$data->subject_name}}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control' ,'placeholder' => 'Enter options separated by commas. Each comma-separated value will be considered as a new option.']) !!}
</div>

<!-- Validity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('validity', 'Validity:') !!}
    <select name="validity" id="validity" class="form-control">
        <option {{ $validity == 7 ? "selected" : "" }} value="7">7</option>
        <option {{ $validity == 30 ? "selected" : "" }} value="30">30</option>
        <option {{ $validity == 90 ? "selected" : "" }} value="90">90</option>
        <option {{ $validity == 180 ? "selected" : "" }} value="180">180</option>
        <option {{ $validity == 365  ? "selected" : "" }} value="365">365</option>
    </select>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'],null, ['class' => 'form-control']) !!}


</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('subscriptionPlans.index') }}" class="btn btn-default">Cancel</a>
</div>

<script>
    let baseUrl = "<?php echo url('/'); ?>";
    $("#configuration_type").on("change", function() {
        var value = $(this).val();
        if (value == 0) {
            $(".customizedType").addClass("hide");
            $(".materialType").removeClass("hide");
        } else {
            $(".customizedType").removeClass("hide");
            $(".materialType").addClass("hide");
        }
    })

    $(document).ready(function() {
        $('#genre_id, #department_id, #subject_id, #pubdata, #allowed_material').select2();
        $("#genre_id").on("change", function() {
            $("#department_id").select2("destroy");
            $.ajax({
                url: baseUrl + "/api/getdepartment/" + $(this).val(),
                type: "get",
                success: function(data) {
                    loader.style.display = "none";
                    let newData = data.data;
                    for (var i in newData) {
                        $("#department_id").append(`<option value="${i}">${newData[i]}</option>`);
                    }
                    $("#department_id").select2();
                },
                error: function(jqXHR, exception) {
                    $("#department_id").html('');
                    $("#department_id").select2();
                }
            });
        });

        $('#department_id').on('change', function() {
            $("#subject_id").select2("destroy");
            $.ajax({
                url: baseUrl + "/api/getsubject/" + $(this).val(),
                type: "get",
                success: function(data) {
                    loader.style.display = "none";
                    let newData = data.data;
                    for (var i in newData) {
                        $("#subject_id").append(`<option value="${i}">${newData[i]}</option>`);
                    }
                    $("#subject_id").select2();
                },
                error: function(jqXHR, exception) {
                    $("#subject_id").html('');
                    $("#subject_id").select2();
                }
            });
        })
    });

    $(window).load(function() {
        var value = $('.material').find(":selected").val();

        if (value == 1) {
            $(".allowedMaterial").addClass("hide");
            $(".genre").removeClass("hide");
        } else {
            $(".allowedMaterial").removeClass("hide");
            $(".genre").addClass("hide");
        }
    })
</script>

<style>
    .p-0 {
        padding: 0;
    }

    .select2 {
        width: 100% !important;
    }
</style>