@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Prescribed Read List
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
				<h4>
				{{ $readList->school->name }}
				</h4>
                <div class="row" >
                    @include('prescribed_reading_lists.show_fields')
                </div>
				<a href="{{ route('prescribedReadingLists.index') }}" class="btn btn-default">Back</a>
            </div>
        </div>
    </div>
@endsection
