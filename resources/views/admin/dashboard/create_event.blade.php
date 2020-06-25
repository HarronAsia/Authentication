@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">

                <div class="card-header">

                    <h4 class="modal-title text-light">Add Blog</h4>
                </div>

                <div class="card-body">
                    {!! Form::open(['route' => 'events.store']) !!}
                        @csrf
                        <div class="form-group">
                        {!! Form::label('Thumbnail') !!}
                        {{!! Form::file('thumbnail', null, ['class' => 'form-control', 'placeholder' => 'Thumbnail']) !!}}                    
                         
                        @if($errors->has('thumbnail'))
                            <span class="help-block">
                                {!! $errors->first('thumbanail') !!}
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        {!! Form::label('Title') !!}
                        {{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}}                    
                         
                        @if($errors->has('title'))
                            <span class="help-block">
                                {!! $errors->first('title') !!}
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        {!! Form::label('Detail') !!}
                        {{!! Form::text('detail', null, ['class' => 'form-control', 'placeholder' => 'Detail']) !!}}                    
                         
                        @if($errors->has('detail'))
                            <span class="help-block">
                                {!! $errors->first('detail') !!}
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        {!! Form::label('Publish') !!}
                        {{!! Form::text('is_published',  [1 => 'Publish', 0 => 'Not Punlish'], null, ['class' => 'form-control']) !!}}    
                        </div>

                        <div class="form-group">
                        {{!! Form::submit('Click Me!')!! }}
                        {!! Form::close() !!}  
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
@endsection