@extends('layouts.app')
@section('title')
    {{ __('Edit Team') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-2xl">Actualizar Equipo</h4>
                    <form class="form-sample" method="post" action="{{ route('teams.update', Vinkla\Hashids\Facades\Hashids::encode($team->id)) }}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="name">{{ __('Name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded" name="name" id="name"
                                               placeholder="{{ __('Name') }}" value="{{ old('name', $team->name)}}"/>
                                    </div>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="acronym">{{ __('Acronym') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded" name="acronym" id="acronym"
                                               placeholder="{{ __('Acronym') }}" value="{{ old('acronym', $team->acronym) }}"/>
                                    </div>
                                    @error('acronym')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="team">{{ __('Image') }}</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="team" id="team"
                                               class="form-control-file form-control form-input rounded">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div id="preview" class="text-center ml-10 align-center self-center">

                                    </div>
                                    <script type="text/javascript">
                                        document.getElementById("team").onchange = function (e) {
                                            let reader = new FileReader();

                                            reader.readAsDataURL(e.target.files[0]);

                                            reader.onload = function () {
                                                let preview = document.getElementById('preview'),
                                                    image = document.createElement('img');
                                                image.src = reader.result;
                                                image.width = 250;
                                                image.height = 250;
                                                // image.className = "card-img-top"
                                                preview.innerHTML = '';
                                                preview.append(image);
                                            };
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="category">{{ __('Category') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="category" id="category">
                                            <option>Category1</option>
                                            <option>Category2</option>
                                            <option>Category3</option>
                                            <option>Category4</option>
                                        </select>

                                        @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="capitan_id">{{ __('Capitan') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="capitan_id" id="capitan_id">
                                            @foreach($capitans as $capitan)
                                                <option value="{{ $capitan->id }}">{{ $capitan->name }}</option>
                                            @endforeach
                                            @error('capitan_id')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-4">
                                <a class="btn btn-danger" href="{{ route('teams.index') }}">{{ __('Cancel') }}</a>
                            </div>
                            <div class="col-md-9 justify-end flex justify-items-end mr-10">
                                <button class="btn btn-outline-success" type="submit">{{ __('Edit Team') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
