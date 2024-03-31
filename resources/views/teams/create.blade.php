@extends('layouts.app')
@section('title')
    {{ __('Create Team') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ __('Create Team') }}
                    </h3>
                    <form class="form-sample" method="post" action="{{ route('teams.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="name">{{ __('Name') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded" name="name" id="name"
                                               placeholder="{{ __('Name') }}" value="{{ old('name')}}"/>
                                    </div>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="slug">{{ __('Slug') }}</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control rounded" name="slug" id="slug"
                                               placeholder="{{ __('slug') }}" value="{{ old('slug')}}"/>
                                    </div>
                                    @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="logo">{{ __('Image') }}</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="logo" id="logo"
                                               class="form-control-file form-control form-input rounded">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <div id="preview" class="text-center ml-10 align-center self-center">

                                    </div>
                                    <script type="text/javascript">
                                        document.getElementById("logo").onchange = function (e) {
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
                            <div class="col-md-6 mb-3">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label"
                                           for="category_id">{{ __('Category') }}</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="category_id" id="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#createUser">
                                    {{ __('Data of the captain') }}
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="createUserLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5"
                                                id="exampleModalLabel">{{ __('Create User') }}</h3>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">

                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                           for="name_user">{{ __('Full Name') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="name_user"
                                                               placeholder="{{ __('Full Name') }}" name="name_user"
                                                               value="{{ old('name_user') }}">
                                                        @error('name_user')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                           for="email">{{ __('Email') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" class="form-control" id="email"
                                                               placeholder="{{ __('Email') }}" name="email"
                                                               value="{{ old('email') }}">
                                                        @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                           for="number">{{ __('Number') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" id="number"
                                                               placeholder="{{ __('Number') }}" name="number"
                                                               value="{{ old('number') }}">
                                                        @error('number')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row mb-3">
                                                    <label class="col-sm-3 col-form-label"
                                                           for="phone">{{ __('Phone') }}</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control"
                                                               id="phone" placeholder="{{ __('Phone') }}" name="phone"
                                                               value="{{ old('phone') }}">
                                                        @error('phone')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 ml-4">
                                <a class="btn btn-danger" href="{{ route('teams.index') }}">{{ __('Cancel') }}</a>
                            </div>
                            <div class="col-md-9 justify-end flex justify-items-end mr-10">
                                <button class="btn btn-success" type="submit">{{ __('Create Team') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
