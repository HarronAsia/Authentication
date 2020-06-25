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
                    {!! Form::open(['route' => ['events.update', $event->id], 'method' => 'put']) !!}
                        @csrf
                        <div class="form-group">
                        {!! Form::label('Thumbnail') !!}
                        {{!! Form::file('thumbnail', $event->thumbnail, ['class' => 'form-control', 'alt' => 'Banner']) !!}}                    
                         
                        @if($errors->has('thumbnail'))
                            <span class="help-block">
                                {!! $errors->first('thumbanail') !!}
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        {!! Form::label('Title') !!}
                        {{!! Form::text('title', $event->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}}                    
                         
                        @if($errors->has('title'))
                            <span class="help-block">
                                {!! $errors->first('title') !!}
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                        {!! Form::label('Detail') !!}
                        {{!! Form::text('detail', $event->detail, ['class' => 'form-control', 'placeholder' => 'Detail']) !!}}                    
                         
                        @if($errors->has('detail'))
                            <span class="help-block">
                                {!! $errors->first('detail') !!}
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                            <input type="submit" class="form-control form-control-lg" class="btn btn-success btn-block btn-lg">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
@endsection